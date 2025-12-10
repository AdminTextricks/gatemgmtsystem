<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentDomain;
use App\Models\StudentVideos;
use App\Models\StudentTherapy;
use App\Models\StudentAdmission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentVideosController extends Controller
{
    public function therapyvideo_list()
    {
        $user = Auth::user();
        $data = StudentVideos::with('students:id,enroll_number,student_name,cur_class_id')->get();
        return view('student.studentvideos.index', compact('data', 'user'));
    }

   
    public function therapyvideo_gallary()
    {
        $user = Auth::user();
        $student_ids = explode(',', $user->student_id);
        $data = StudentAdmission::with('student_videos')->whereIn('id', $student_ids)->get();

        return view('student.studentvideos.gallary', compact('data', 'user'));
    }

    public function therapyvideo_action(Request $request, $id = null)
    {
        $action = $request->route()->parameter('action');
        $students = StudentAdmission::select('id', 'student_name', 'enroll_number', 'cur_class_id')->get();

        $getdata = [];


        if (isset($request->id) && !empty($request->id)) {
            $getdata = StudentVideos::where('id', $request->id)->first();
            // $getdata=StudentVideos::with('students')->where('id', $id)->first();
        }
        return view('student.studentvideos.action', compact('getdata', 'action', 'students'));
    }

    public function therapyvideo_action_post(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'student_admissions_id' => 'required|exists:student_admissions,id',
            'therapy_name'          => 'required',
            'cur_class'          => 'required',
            'domain_name'          => 'nullable',
            'video'             => (empty($request->edit_id) ? 'required' : 'nullable') . '|mimes:mp4,avi,mov,wmv|max:10240', //max size 10MB
            'description'          => 'nullable',
            'status'          => 'required',
        ]);

        if (!empty($request->edit_id)) {
            $existingvideo = StudentVideos::where('id', $request->edit_id)->first();
        }

        $video_res = $newVideoName = '';
        if ($request->hasFile('video')) {
            $video = $request->video;
            $filepath = public_path('videos/student_video/');
            if (!file_exists($filepath)) {
                mkdir($filepath, 0755, true);
            }
            $extension = $video->getClientOriginalExtension();
            $originalName = pathinfo($video->getClientOriginalName(), PATHINFO_FILENAME);
            $newVideoName = date('YdmHis') . '_' . $originalName . '.' . $extension;
            if (!empty($request->edit_id) && !empty($existingvideo->video)) {
                $oldVideoFile = $filepath . '.' . $existingvideo->video;
                if (file_exists($oldVideoFile)) {
                    unlink($oldVideoFile);
                }
            }

            $video_res = $request->video->move($filepath, $newVideoName);
            $validated['video'] = $newVideoName;

            if (!$video_res) {
                return back()->withErrors(['video' => 'Error occurred in video uploading.']);
            }
        }

        StudentVideos::updateOrCreate(
            ['id' => $request->edit_id],
            $validated
        );

        return redirect()->route('therapyvideo.list')->with(['success' => 'Video Uploaded Successfully!!!']);
    }

    public function delete($id)
    {
        $studentvideo = StudentVideos::findOrFail($id);
        if (!empty($studentvideo)) {
            if (!empty($studentvideo->video)) {
                $filePath = public_path('videos/student_video/' . $studentvideo->video);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $studentvideo->delete();
        return response()->json(['success' => true, 'message' => 'Video has been deleted successfully.']);
    }
}
