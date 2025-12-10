<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CityMatser;
use App\Models\ClassMaster;
use App\Models\StateMatser;
use App\Models\TeacherMaster;
use App\Models\EquipmentMaster;
use App\Models\DisabilityMatser;
use App\Models\StudentAdmission;
use App\Models\StudentDocuments;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $totalStudent = StudentAdmission::count();
        $user = auth()->user();
        // $teacher = TeacherMaster::where('teacher_id', $user->user_id)->first();
        $user_role = auth()->user()->role;
        // if ($user_role == 'teacher' && !empty($teacher->class_id)) {
        //     $classes = Classmaster::withCount('students')
        //         ->where('id', $teacher->class_id)
        //         ->orderBy('class_id')
        //         ->get();
        // } else {
        //     $classes = Classmaster::withCount('students')
        //         ->orderBy('class_id')
        //         ->get();
        // }

        // $totalClass = ClassMaster::count();
        // $classNames = ClassMaster::pluck('class_name')->toArray();
        // $totalDisablity = DisabilityMatser::count();
        // if ($user_role == 'teacher' && !empty($teacher->class_id)) {
        //     $disabilities = DisabilityMatser::withCount(['students as students_count' => function ($query) use ($teacher) {
        //         $query->whereHas('studentdetails', function ($q) use ($teacher) {
        //             $q->where('cur_class_id', $teacher->class_id);
        //         });
        //     }])
        //         ->orderBy('disability_id')
        //         ->get();
        // } else {
        //     $disabilities = DisabilityMatser::withCount('students')
        //         ->orderBy('disability_id')
        //         ->get();
        // }

        // $totalTherapist = TeacherMaster::count();

        $iconMap = [
            'fa-hands-holding-child',
            'fa-child',
            'fa-child-reaching',
            'fa-user-tie',
            'fa-graduation-cap',
            // 'fa-baby',
        ];
        $data = [
            // 'totalState' => $totalState,
        ];


        return view('pages.dashboard', compact('data', 'iconMap',));
    }
}
