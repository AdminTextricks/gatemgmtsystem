<?php

namespace App\Http\Controllers\Student;


use Carbon\Carbon;
use App\Models\CityMatser;
use Endroid\QrCode\QrCode;
use App\Models\ClassMaster;
use App\Models\StateMatser;
use Illuminate\Http\Request;
use App\Models\StudentDomain;
use App\Models\TeacherMaster;
use App\Models\StudentTherapy;
use Endroid\QrCode\Color\Color;
use App\Models\DisabilityMatser;
use App\Models\StudentAdmission;
use App\Models\StudentDocuments;
use App\Models\StudentDisability;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\Builder\Builder;
use App\Http\Controllers\Controller;
use Endroid\QrCode\Writer\PngWriter;

class StudentAdmissionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $disabilitymaster = DisabilityMatser::select('id', 'disability_name')->where('status', 1)->get();

        if ($user->role === 'teacher') {
            $teacherclass = TeacherMaster::where('teacher_name', $user->name)->value('class_id');
            $data = StudentAdmission::with('cur_class:id,class_name')
                ->with('city:id,city_name')
                ->with('disability:id,disability_name')
                ->with('student_documents')
                ->with('student_domains:student_id,domain_name,description')
                ->with('student_therapy:student_id,cur_class_id,therapy_name,description')
                ->with('student_disability:student_id,disability_id')
                ->where('cur_class_id', $teacherclass)
                ->where('status', 1)
                ->orderByRaw('CAST(enroll_number AS UNSIGNED) DESC')
                ->get();
        } else {
            $data = StudentAdmission::with('cur_class:id,class_name')
                ->with('city:id,city_name')
                ->with('disability:id,disability_name')
                ->with('student_documents')
                ->with('student_domains:student_id,domain_name,description')
                ->with('student_therapy:student_id,cur_class_id,therapy_name,description')
                ->with('student_disability:student_id,disability_id')
                ->where('status', 1)
                ->orderByRaw('CAST(enroll_number AS UNSIGNED) DESC')
                // ->where('id', 18)
                ->get();
        }


        return view('student.studentadmission.index', compact('data', 'disabilitymaster'));
    }

    public function student_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];
        $sessions = [];
        $studentCity = '';
        $therapies = [];
        $domains = [];
        $disabilities = [];

        for ($year = 2024; $year <= date('Y'); $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }

        $classMaster =  ClassMaster::select('id', 'class_id', 'class_name')
            ->where('status', 1)
            ->get();
        $cityMaster = CityMatser::select('id', 'city_name', 'own_city')
            ->where('status', 1)
            ->get();
        $stateMaster = StateMatser::select('id', 'state_name', 'own_state')
            ->get();

        $disabilityMatser = DisabilityMatser::select('id', 'disability_name')
            ->where('status', 1)
            ->get();
        if (isset($request->id) && !empty($request->id)) {
            $getdata = StudentAdmission::where('id', $request->id)->first();
            $therapies = StudentTherapy::select('id', 'therapy_name', 'description')->where('student_id', $getdata->id)->where('cur_class_id', $getdata->cur_class_id)->get();
            $domains = StudentDomain::select('id', 'domain_name', 'description')->where('student_id', $getdata->id)->where('cur_class_id', $getdata->cur_class_id)->get();
            $studentCity = CityMatser::select('id', 'city_name')->where('id', $getdata->city_id)->first();
            $disabilities = StudentDisability::where('student_id', $getdata->id)->get()->pluck('disability_id')->toArray();
            // $disability=DisabilityMatser::whereIn('id', $disabilities??[])->pluck('disability_name')->implode(', ');

        }

        return view('student.studentadmission.action', compact('getdata', 'action', 'classMaster', 'cityMaster', 'disabilityMatser', 'stateMaster', 'sessions', 'studentCity', 'therapies', 'domains', 'disabilities'));
    }

    public function get_cities(Request $request, $id = null)
    {
        $data = [];
        $data = CityMatser::where('state_id', $id)->get()->toArray();
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function get_domains_therapies(Request $request, $id = null, $class = null)
    {
        if (isset($id) && !empty($id)) {
            $therapies = StudentTherapy::select('id', 'therapy_name', 'description')->where('student_id', $id)->where('cur_class_id', $class)->get();
            $domains = StudentDomain::select('id', 'domain_name', 'description')->where('student_id', $id)->where('cur_class_id', $class)->get();
        }

        return response()->json([
            'success' => true,
            'domains' => $domains,
            'therapies' => $therapies,
        ]);
    }

    public function student_post_action(Request $request)
    {

        $request->validate([
            'enroll_number' => 'required|unique:student_admissions,enroll_number,' . $request->edit_id,
            'session' => 'required',
            'admission_date'    => 'required',
            'adm_class_id'      => 'required|numeric|exists:class_masters,id',
            'cur_class_id'      => 'required|numeric|exists:class_masters,id',
            'student_name'      => 'required',
            'type'              => 'required',
            'fathers_name'      => 'required',
            'mothers_name'      => 'required',
            'c_address'         => 'nullable',
            'p_address'         => 'nullable',
            'state_id'          => 'required|numeric|exists:state_matsers,id',
            'city_id'           => 'required|numeric|exists:city_matsers,id',
            'mobile'        => 'required',
            'sex'           => 'required|in:Male,Female',
            'dob'           => 'required',
            'age'           => 'nullable',
            'disability_id' => 'required|exists:disability_matsers,id',
            'unique_identity_no'    => 'required',
            'aadhar_no'             => 'nullable',
            'pedigree_status'       => 'nullable',
            'status'                => 'nullable',
            'domain_name'           => 'nullable',
            'domain_description'    => 'nullable',
            'therapy_name'          => 'nullable',
            'therapy_description'   => 'nullable',
            'vocational_and_skill_training' => 'nullable',
            'special_achievements'          => 'nullable',
        ]);

        if (isset($request->edit_id) && !empty($request->edit_id)) {
            $save = StudentAdmission::where('id', $request->edit_id)->first();
        } else {
            $save = new StudentAdmission();
        }

        $save->enroll_number    = $request->enroll_number;
        $save->session        = $request->session;
        $save->admission_date   = Carbon::parse($request->admission_date)->format('Y-m-d');
        $save->cur_class_id     = $request->cur_class_id;
        $save->adm_class_id     = $request->adm_class_id;
        $save->student_name     = $request->student_name;
        $save->type             = $request->type;
        $save->fathers_name     = $request->fathers_name;
        $save->mothers_name     = $request->mothers_name;
        $save->c_address          = $request->c_address;
        $save->p_address          = $request->p_address;
        $save->state_id          = $request->state_id;
        $save->city_id          = $request->city_id;
        $save->mobile           = $request->mobile;
        $save->sex              = $request->sex;
        $save->dob              = $request->dob;
        $save->age              = $request->age;
        $save->unique_identity_no = $request->unique_identity_no;
        $save->aadhar_no        = $request->aadhar_no;
        $save->status        = $request->status;
        $save->pedigree_status        = $request->pedigree_status;
        $save->vocational_and_skill_training = $request->vocational_and_skill_training;
        $save->special_achievements          = $request->special_achievements;
        if ($request->has('status')) {
            $save->status = $request->status;
        }
        $save->save();
        $new_student_id = $save->id;
        dd($save);

        if (!empty($new_student_id)) {
            // StudentDomain::where('student_id', $new_student_id)->delete();

            if (isset($request->domain_description) && !empty($request->domain_description)) {
                StudentDomain::where('student_id', $new_student_id)->delete();
            foreach ($request->domain_description as $index => $description) {
                    StudentDomain::updateOrCreate(
                        [
                            'student_id' => $new_student_id,
                            'cur_class_id' => $save->cur_class_id,
                            'domain_name' => $request->domain_name[$index],
                        ],
                        [
                            'description' => $description,
                        ]
                    );
                }
            }
            if (isset($request->therapy_description) && !empty($request->therapy_description)) {
                StudentTherapy::where('student_id', $new_student_id)->delete();
            foreach ($request->therapy_description as $index => $description) {
                    StudentTherapy::updateOrCreate(
                        [
                            'student_id' => $new_student_id,
                            'cur_class_id' => $save->cur_class_id,
                            'therapy_name' => $request->therapy_name[$index],
                        ],
                        [
                            'description' => $description,
                        ]
                    );
                }
            }

            if (isset($request->disability_id) && !empty($request->disability_id)) {
                StudentDisability::where('student_id', $new_student_id)->delete();
                foreach ($request->disability_id as $index => $disability) {
                    StudentDisability::create([
                        'student_id'    => $new_student_id,
                        'disability_id' => $disability,
                    ]);
                }
            }



            if (!isset($request->edit_id) && empty($request->edit_id)) {
                $filePath = $this->generateColorful($save->id);
                $save->qrcode = $filePath;
                $save->save();
                return redirect()->route('student_documents', ['action' => 'Add', 'student_id' => $save->id])->with('success', 'Submitted Successfully...');
            }
            //$encodedId = encrypt($save->id);     
            return redirect()->route('studentlist')->with('success', 'Submitted Successfully...');
        }
    }


    public function student_documents(Request $request)
    {
        $action = $request->route()->parameter('action');
        //$id = decrypt($request->route()->parameter('id'));
        $student_id = $request->route()->parameter('student_id');
        $getdata = $documentData = [];
        $classMaster =  ClassMaster::select('id', 'class_id', 'class_name')
            ->where('status', 1)
            ->get();

        if (isset($request->student_id) && !empty($request->student_id)) {
            $getdata = StudentAdmission::where('id', $student_id)->first();
            $documentData = StudentDocuments::where('student_admissions_id', $request->student_id)->first();
        }

        return view('student.studentadmission.documents', compact('getdata', 'action', 'classMaster', 'documentData'));
    }

    public function student_post_documents(Request $request)
    {
        $request->validate([
            'student_id'                => 'required|exists:student_admissions,id',
            'image'                     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'aadhar_image'              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'birth_certificate_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'disability_certificate_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'medical_certificate_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'udid_certificate_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'transfer_certificate_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'doc_prescription' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'other_document_1'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'other_document_2'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $StudentDocuments = StudentDocuments::where('student_admissions_id', $request->student_id)->first();

        if (empty($StudentDocuments)) {

            $StudentDocuments = new StudentDocuments();
        }

        $StudentDocuments->student_admissions_id     = $request->student_id;

        $documents = [
            'image' => 'image',
            'aadhar_image' => 'aadhar_image',
            'birth_certificate_image' => 'birth_certificate_image',
            'disability_certificate_image' => 'disability_certificate_image',
            'medical_certificate_image' => 'medical_certificate_image',
            'udid_certificate_image' => 'udid_certificate_image',
            'transfer_certificate_image' => 'transfer_certificate_image',
            'doc_prescription' => 'doc_prescription',
            'other_document_1' => 'other_document_1',
            'other_document_2' => 'other_document_2',
        ];

        foreach ($documents as $field => $attribute) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $extension = $file->getClientOriginalExtension();
                $originalName = $file->getClientOriginalName();
                $filenameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);
                $newFileName = time() . '_' . str_replace(' ', '_', $filenameWithoutExt) . '.' . $extension;

                // Move file to the designated directory
                $fileMoved = $file->move(public_path('student_documents'), $newFileName);

                if (!$fileMoved) {
                    return back()->withErrors([$field => 'Error occurred while uploading ' . str_replace('_', ' ', $field) . '.']);
                } else {
                    $StudentDocuments->$attribute = $newFileName;
                }
            }
        }

        $StudentDocuments->save();
        return redirect()->route('studentlist')->with('success', 'Document Uploaded Successfully...');
    }

    public function delete($id)
    {
        $classmaster = StudentAdmission::findOrFail($id);
        $classmaster->delete();
        return response()->json(['success' => true, 'message' => 'Class deleted successfully.']);
    }


    public function getStudentDetails(Request $request, $id)
    {
        $id = base64_decode($id);
        $disabilitymaster = DisabilityMatser::select('id', 'disability_name')->where('status', 1)->get();
        $data = StudentAdmission::with('cur_class:id,class_name')
            ->with('city:id,city_name')
            ->with('disability:id,disability_name,disability_id')
            ->with('student_documents')
            ->with('student_domains:student_id,domain_name,description')
            ->with('student_therapy:student_id,cur_class_id,therapy_name,description')
            ->with('student_disability:student_id,disability_id')
            ->where('id', $id)
            ->first();
        $therapies = StudentTherapy::with('class:id,class_name')->where('student_id', $id)->get()->groupBy('cur_class_id');
        $domains = StudentDomain::with('class:id,class_name')->where('student_id', $id)->get()->groupBy('cur_class_id');
        if (!empty($data)) {
            return view('student.studentadmission.student_details', compact('data', 'therapies', 'domains', 'disabilitymaster'));
        } else {
            return view('student.studentadmission.student_no_details');
        }
    }

    public function generateColorful($id)
    {
        $qrCodeImage = 'qrcodes/' . $id . '_' . time() . '_qr.png';
        $base_url = url('/');
        $URL = $base_url . '/student_details/' . base64_encode($id);
        // Create the QR code with content
        $qrCode = new QrCode($URL);
        // Initialize PNG writer
        $writer = new PngWriter();
        $qrImage = $writer->write($qrCode);

        // Define file path to save in public/qrcodes folder
        $filePath = public_path($qrCodeImage);

        // Ensure the directory exists
        if (!file_exists(public_path('qrcodes'))) {
            mkdir(public_path('qrcodes'), 0755, true);
        }

        // Save the QR code to the file
        file_put_contents($filePath, $qrImage->getString());

        return $qrCodeImage;
        // return response()->json(['message' => 'Colorful QR Code generated successfully!', 'path' => $filePath]);
    }


    public function student_filter(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];
        $classMaster =  ClassMaster::select('id', 'class_id', 'class_name')
            ->where('status', 1)
            ->get();
        $disabilityMatser = DisabilityMatser::select('id', 'disability_name')
            ->where('status', 1)
            ->get();

        return view('student.studentadmission.students_report', compact('action', 'classMaster', 'disabilityMatser'));
    }

    public function fetchStudents(Request $request)
    {
        $user = auth()->user();
        if ($user->role === 'teacher') {
            $teacherclass = TeacherMaster::where('teacher_name', $user->name)->value('class_id');
            $query = StudentAdmission::query()->where('cur_class_id', $teacherclass);
        } else {
            $query = StudentAdmission::query();
        }

        $hasFilters = false;

        if ($request->has('start_date') && !empty($request->start_date) && $request->has('end_date') && !empty($request->end_date)) {
            $query->whereBetween('admission_date', [$request->start_date, $request->end_date]);
            $hasFilters = true;
        }

        if ($request->has('enroll_number') && !empty($request->enroll_number)) {
            $query->where('enroll_number', 'like', '%' . $request->enroll_number . '%');
            $hasFilters = true;
        }
        if ($request->has('city_id') && !empty($request->city_id)) {
            $query->where('city_id', $request->city_id);
            $hasFilters = true;
        }
        // if ($request->has('state_id') && !empty($request->state_id)) {
        //     $query->where('state_id', $request->state_id);
        //     $hasFilters = true;
        // }
        if ($request->has('disability_id') && !empty($request->disability_id)) {
            $query->where('disability_id', $request->disability_id);
            $hasFilters = true;
        }
        if ($request->has('cur_class_id') && !empty($request->cur_class_id)) {
            $query->where('cur_class_id', $request->cur_class_id);
            $hasFilters = true;
        }
        if ($request->type) {
            $query->where('type', $request->type);
            $hasFilters = true;
        }

        if (!$hasFilters) {
            return response()->json([]);
        }

        $students = $query->with(['cur_class', 'adm_class', 'city', 'state', 'disability', 'student_documents'])->get();



        return response()->json($students);
    }

    public function pendingfee()
    {

        $user = auth()->user();
        $disabilitymaster = DisabilityMatser::select('id', 'disability_name')->where('status', 1)->get();

        if ($user->role === 'teacher') {
            $teacherclass = TeacherMaster::where('teacher_name', $user->name)->value('class_id');
            $data = StudentAdmission::with('cur_class:id,class_name')
                ->with('city:id,city_name')
                ->with('disability:id,disability_name')
                ->with('student_documents')
                ->with('student_domains:student_id,domain_name,description')
                ->with('student_therapy:student_id,cur_class_id,therapy_name,description')
                ->with('student_disability:student_id,disability_id')
                ->where('cur_class_id', $teacherclass)
                ->orderByRaw('CAST(enroll_number AS UNSIGNED) DESC')
                ->get();
        } else {
            $data = StudentAdmission::with('cur_class:id,class_name')
                ->with('city:id,city_name')
                ->with('disability:id,disability_name')
                ->with('student_documents')
                ->with('student_domains:student_id,domain_name,description')
                ->with('student_therapy:student_id,cur_class_id,therapy_name,description')
                ->with('student_disability:student_id,disability_id')
                ->orderByRaw('CAST(enroll_number AS UNSIGNED) DESC')
                // ->where('id', 18)
                ->get();
        }


        return view('student.studentadmission.pendingfee', compact('data', 'disabilitymaster'));
    }

    public function archivedstudents(Request $request)
    {
        $user = auth()->user();
        $disabilitymaster = DisabilityMatser::select('id', 'disability_name')->where('status', 1)->get();
        $data = [];
        if ($user->role === 'admin') {
            $data = StudentAdmission::with('cur_class:id,class_name')
                ->with('city:id,city_name')
                ->with('disability:id,disability_name')
                ->with('student_documents')
                ->with('student_domains:student_id,domain_name,description')
                ->with('student_therapy:student_id,cur_class_id,therapy_name,description')
                ->with('student_disability:student_id,disability_id')
                ->orderByRaw('CAST(enroll_number AS UNSIGNED) DESC')
                ->where('status', 0)
                ->get();
        }
        return view('student.studentadmission.archivedstudents', compact('data', 'disabilitymaster'));
    }
}
