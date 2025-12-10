<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EquipmentMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;


class EquipmentMasterController extends Controller
{
    public function index()
    {
        $data = EquipmentMaster::all();

        return view('admin.equipmentmaster.index', compact('data'));
    }


    public function equipment_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];
        if (isset($request->id) && !empty($request->id)) {
            $getdata = EquipmentMaster::where('id', $request->id)->first();
        }
        return view('admin.equipmentmaster.action', compact('getdata', 'action'));
    }

    public function equipment_post_action(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'equipment_id'      => 'required|unique:equipment_masters,equipment_id,' . $request->edit_id,
            'name'              => 'required|',
            'date_of_purchase'  => 'required',
            'description'       => 'required',
            'warranty_status'   => 'required',
            'service_status'    => 'required',
            'image'             => (empty($request->edit_id) ? 'required' : 'nullable') . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'eqp_video'         => (empty($request->edit_id) ? 'required' : 'nullable') . '|mimes:mp4,avi,mov,wmv|max:10240', //max size 10MB

        ]);

        if (isset($request->edit_id) && !empty($request->edit_id)) {
            $save = EquipmentMaster::where('id', $request->edit_id)->first();
        } else {
            $save = new EquipmentMaster();
        }
        $createnewFileName = $img_res = $video_res = '';

        if ($request->hasFile('image')) {
            $filepath = public_path('images');
            if (!file_exists($filepath)) {
                mkdir($filepath, 0755, true);
            }
            $originalName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->image->getClientOriginalExtension();
            $createnewFileName = date('YmdHis') . '_' . $originalName . '.' . $extension;

           $oldFile = $filepath . '/' . ($save->image?$save->image:'NA');
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }

            $img_res = $request->image->move($filepath, $createnewFileName);
            $save->image   = $createnewFileName;

            if (!$img_res) {
                return back()->withErrors(['image' => 'Error occurred in image uploading.']);
            }
        }

        if ($request->hasFile('eqp_video')) {
            $filepath = public_path('videos');
             if (!file_exists($filepath)) {
                mkdir($filepath, 0755, true);
            }
            $originalName = pathinfo($request->eqp_video->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->eqp_video->getClientOriginalExtension();
            $createnewFileName = date('YmdHis') . '_' . $originalName . '.' . $extension;

            $oldVideoFile = $filepath . '/' . ($save->eqp_video? $save->eqp_video:'NA');
            if (file_exists($oldVideoFile)) {
                unlink($oldVideoFile);
            }
            $video_res = $request->eqp_video->move($filepath, $createnewFileName);
            $save->eqp_video  = $createnewFileName;

            if (!$video_res) {
                return back()->withErrors(['eqp_video' => 'Error occurred in video uploading.']);
            }
        } 


        $save->equipment_id     = $request->equipment_id;
        $save->name             = $request->name;
        $save->date_of_purchase = $request->date_of_purchase;
        $save->description      = $request->description;
        $save->warranty_status  = $request->warranty_status;
        $save->service_status   = $request->service_status;

        if ($request->has('status')) {
            $save->status = $request->status;
        }
        $save->save();

        return redirect()->route('equipmentlist')->with('success', 'Submitted Successfully...');
    }

    public function delete($id)
    {
        $equipment = EquipmentMaster::findOrFail($id);
        if (!empty($equipment)) {
            if (!empty($equipment->image)) {
                $filePath = public_path('images/' . $equipment->image);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            if (!empty($equipment->eqp_video)) {
                $filePath = public_path('videos/' . $equipment->eqp_video);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $equipment->delete();
        return response()->json(['success' => true, 'message' => 'Equipment has been deleted successfully.']);
    }
    
}
