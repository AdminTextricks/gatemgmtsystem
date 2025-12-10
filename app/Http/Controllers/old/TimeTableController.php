<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TimeTable;
use App\Models\ClassMaster;
use Illuminate\Http\Request;
use App\Models\StudentAdmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TimeTableController extends Controller
{
    public function index()
    {
        $data = TimeTable::with('class')->get();
        return view('admin.timetablemaster.index', compact('data'));
    }


    public function timetable_action(Request $request, $action, $id = null)
    {
        $classMaster =  ClassMaster::select('id', 'class_id', 'class_name')
            ->where('status', 1)
            ->get();

        $getdata = '';

        if (isset($request->id) && !empty($request->id)) {
            $getdata = TimeTable::where('id', $request->id)->first();
        }
        return view('admin.timetablemaster.action', compact('getdata', 'action', 'classMaster'));
    }

    public function timetable_post_action(Request $request)
    {

        $rules = [
            'class_masters_id'    => 'required|exists:class_masters,id',
            'short_description'    => 'nullable',
            'document'             => (empty($request->edit_id) ? 'required' : 'nullable') . '|mimes:pdf|max:4096',
            'status'      =>  'required|in:0,1',
        ];

        $request->validate($rules);

        if (isset($request->edit_id) && !empty($request->edit_id)) {
            $save = TimeTable::where('id', $request->edit_id)->first();
        } else {
            $save = new TimeTable();
        }
        $createnewFileName = $img_res = '';
        // Check if the image file is present
        if ($request->hasFile('document')) {
            $filepath = public_path('teacher_documents/');
            if (!file_exists($filepath)) {
                mkdir($filepath, 0755, true);
            }
            $image = $request->document;
            $extension = $image->getClientOriginalExtension();
            $image_name = $image->getClientOriginalName();
            $getfilenamewitoutext = pathinfo($image_name, PATHINFO_FILENAME); // get the file name without extension
            $createnewFileName = time() . '_' . str_replace(' ', '_', $getfilenamewitoutext) . '.' . $extension; // create new random file name

            if (!empty($request->edit_id) && !empty($request->document)) {
                $oldDocument = $filepath . '/' . $save->document;;
                if (File::exists($oldDocument)) {
                    unlink($oldDocument);
                }
            }
            $img_res = $request->document->move(public_path('teacher_documents/'), $createnewFileName);
            $save->document = $createnewFileName;
        }

        if (!empty($request->document) && !$img_res) {
            return back()->withErrors(['image' => 'Error occurred in document uploading.']);
        }
        $save->class_masters_id   = $request->class_masters_id;
        $save->status      = $request->status;
        $save->short_description      = $request->short_description;
        $save->save();
        return redirect()->route('timetablelist')->with('success', 'Submitted Successfully...');
    }

    public function delete($id)
    {
        $timetable = TimeTable::findOrFail($id);

        $timetable->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }
}
