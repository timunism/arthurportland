<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\StudentAcademicDetail;
use App\Models\StudentCourse;
use App\Models\StudentCoursePaper;
use App\Models\StudentProfile;
use DateTime;
use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $request;
    public $date_of_birth = "";
    public $course;
    public $application_fee_receipt_dir;
    public $academic_transcript_dir;
    public $papers = "";

    public function index()
    {
        return view('apply.index');
    }

    public function standard() {
        return view('apply.standard');
    }

    public function chatbot() {
        return view('apply.chatbot');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApplicationRequest $request)
    {
        $request->validate([
            'national_id'=>'required|unique:student_profile',
            'email'=>'required|unique:student_profile',
            'application_fee_receipt'=> 'required|image|mimes:jpg,png,jpeg|max:2048',
            'academic_transcript'=> 'required|file|mimes:pdf|max:2048'
        ]);
        $this->pushProfile($request);

        return view('dashboard', ['alert'=>'true']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function pushProfile($request) {
        // Pre-processing
        // Database insertions occur via ManageTransations, uses an anonymous
        // function to execute the task. So in order to access request within the function i have to move
        // it to a global scope
        $this->request = $request;
        // Reformat Date of Birth for MySQl Database
        $raw_date = str($request->input('dob'));

        // Handle files
        # application receipt
        $this->application_fee_receipt_dir = date('Ymdhis').Auth::User()->id.'.'.$request->application_fee_receipt->extension();
        $request->application_fee_receipt->storeAs('public/application_fee_receipts', $this->application_fee_receipt_dir);

        # academic transcripts
        $this->academic_transcript_dir = date('Ymdhis').Auth::User()->id.'.'.$request->academic_transcript->extension();
        $request->academic_transcript->storeAs('public/academic_transcripts', $this->academic_transcript_dir);

        // moving these to global scope as well
        $this->date_of_birth = date($raw_date);
        $this->course = StudentCourse::where('id', $request->input('course'))->first();

        // retrieve papers
        # first count total number of recorded papers
        $total_papers = StudentCoursePaper::all();
        $total_papers = count($total_papers);

        // then find the requested papers, in the range of the total count
        for ($i=0; $i < $total_papers+1; $i++) {
            // for each iteration check to see if a request exists
            $current_paper_request = $request->input('paper_'.$i);
            if ($current_paper_request){
                // if true, retrieve the paper name from the database
                $paper = StudentCoursePaper::where('id', $i)->first();
                // append to the paper column for course registrations
                $this->papers = $this->papers.$paper->paper_name.';';
            }
        }
        DB::transaction(function () {
            $profileId = DB::table('student_profile')->insertGetId([
                'fullname' => $this->request->input('fullname'),
                'surname' => $this->request->input('surname'),
                'gender' => $this->request->input('gender'),
                'date_of_birth' => $this->date_of_birth,
                'email' => $this->request->input('email'),
                'phone' => $this->request->input('phone'),
                'address' => $this->request->input('postal_address'),
                'next_of_kin_phone' => $this->request->input('nok_phone'),
                'national_id' => $this->request->input('national_id'),
            ]);
    
            DB::table('student_academic_details')->insert([
                'student_profile_id' => $profileId,
                'employer' => $this->request->input('employer'),
                'nature_of_work' => $this->request->input('work'),
                'highest_qualification' => $this->request->input('highest_qualification'),
                'school' => $this->request->input('school'),
                'senior_school' => $this->request->input('senior_school'),
                'qualifications' => $this->request->input('qualifications'),
                'documents' => $this->academic_transcript_dir
            ]);
    
            DB::table('student_course_registration')->insert([
                'student_profile_id' => $profileId,
                'course_id' => $this->request->input('course'),
                'level_of_entry'=>$this->request->input('level_of_entry'),
                'sponsor'=>$this->request->input('sponsor'),
                'application_fee_receipt'=>$this->application_fee_receipt_dir,
                'paper'=>$this->papers
            ]);
        });
    }
}
