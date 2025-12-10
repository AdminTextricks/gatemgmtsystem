<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ClassMaster;
use Illuminate\Http\Request;
use App\Models\TeacherMaster;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class TeacherMasterController extends Controller
{
    public function index()
    {
        $data = TeacherMaster::all();

        return view('admin.teachermaster.index', compact('data'));
    }

    // update user(teacher) status 
    public function updatestatus(Request $request, $id = null)
    {
        $teacher = TeacherMaster::find($id);
        $user = User::where('user_id', $teacher->teacher_id)->first();
        $status = $request->status;
        if (!empty($teacher)) {
            $teacher->status = $status;
            $user->status = $status;
            $teacher->save();
            $user->save();
            return response()->json(['success' => true, 'message' => 'Status updated']);
        }
        return response()->json(['success' => false, 'message' => 'User not found']);
    }

    //Teacher form 
    public function teacher_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];
        $userdata = [];

        if (isset($request->id) && !empty($request->id)) {
            $getdata = TeacherMaster::with('class')->where('id', $request->id)->first();
            $userdata = User::where('user_id', $getdata->teacher_id)->first();
        }

        $class = ClassMaster::all();
        return view('admin.teachermaster.action', compact('getdata', 'action', 'class', 'userdata'));
    }

    //Teacher form post request
    public function teacher_post_action(Request $request)
    {
        $action = $request->route()->parameter('action');
        $rules = [
            'teacher_id'   => 'required|unique:teacher_masters,teacher_id,' . $request->edit_id,
            'teacher_name' => 'required',
            'address'      => 'nullable',
            'mobile'       => 'required|numeric',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) use ($request) {
                    $existsInUsers = User::where('email', $value)->where('user_id', '!=', $request->teacher_id)->exists();
                    $existsInTeachers = TeacherMaster::where('email', $value)->where('id', '!=', $request->edit_id)->exists();

                    if ($existsInUsers || $existsInTeachers) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                },
            ],

            'qualification' => 'nullable|string',
            'classification' => 'nullable|string',
            'rci_registration' => 'nullable|string',
            'rci_expiration_date' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'date_of_joining' => 'nullable',
            'proficiency' => 'nullable',
            'class_id' => 'required|numeric|exists:class_masters,id',
            'password' => 'required|string|min:6|confirmed',
        ];

        if ($action == 'Edit') {
            $rules['password'] = ['nullable'];
        }
        $request->validate($rules);
        if (isset($request->edit_id) && !empty($request->edit_id)) {
            $save = TeacherMaster::where('id', $request->edit_id)->first();
            $user = User::where('user_id', $save->teacher_id)->first();
        } else {
            $save = new TeacherMaster();
        }
        $save->teacher_id = $request->teacher_id;
        $save->teacher_name = $request->teacher_name;
        $save->address = $request->address;
        $save->mobile = $request->mobile;
        $save->email = $request->email;
        $save->qualification = $request->qualification;
        $save->classification = $request->classification;
        $save->rci_registration = $request->rci_registration;
        $save->rci_expiration_date = $request->rci_expiration_date;
        // $save->document = $request->document;
        $save->date_of_joining = $request->date_of_joining;
        $save->proficiency = $request->proficiency;
        $save->class_id = $request->class_id;
        if ($request->has('status')) {
            $save->status = $request->status;
        }

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $fileMoved = $file->move(public_path('teacher_documents'), $newFileName);

            if ($fileMoved instanceof \Symfony\Component\HttpFoundation\File\File) {
                $save->document = 'teacher_documents/' . $newFileName;
            } else {
                return back()->with('error', 'File upload failed.');
            }
        }
        $save->save();

        if (!empty($save)) {
            $data = [
                'name' => $save->teacher_name,
                'user_id' => $save->teacher_id,
                'email_verified_at' => now(),
                'role' => 'teacher',
                'status' => $request->status,
            ];
            if (!empty($request->password)) {
                $data['password'] = Hash::make($request->password);
            } else {
                $data['password'] = $user->password;
            }
            User::updateOrCreate(
                ['email' => $request->email],
                $data
            );
        }
        return redirect()->route('teacherlist')->with('success', 'Submitted Successfully...');
    }

    public function delete($id)
    {

        $teachermaster = TeacherMaster::findOrFail($id);
        $user = User::where('user_id', $teachermaster->teacher_id)->first();
        if (!empty($teachermaster->document)) {
            $filePath = public_path($teachermaster->document);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        $teachermaster->delete();
        $user->delete();

        return response()->json(['success' => true, 'message' => 'Teacher deleted successfully.']);
    }
}
