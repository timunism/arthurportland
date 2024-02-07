<?php

namespace App\Http\Controllers;

use App\Models\StudentAcademicDetail;
use App\Models\StudentProfile;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $request->validate([
            'national_id'=>'required|unique:student_profile',
            'email'=>'required|unique:student_profile',
        ]);

        $student_profile = new StudentProfile;
        $student_profile->fullname = $request->input('fullname');
        $student_profile->surname = $request->input('surname');
        $student_profile->gender = $request->input('gender');
        $date = explode("/", $request->input('dob'));
        $student_profile->date_of_birth = date($date[2].'-'.$date[1].'-'.$date[0]);
        $student_profile->email = $request->input('email');
        #$student_profile->sponsor = $request->input('sponsor');
        $student_profile->phone = $request->input('phone');
        $student_profile->address = $request->input('postal_address');
        $student_profile->next_of_kin_phone = $request->input('nok_phone');
        $student_profile->national_id = $request->input('national_id');
        $student_profile->save();

        $current_student = StudentProfile::where('national_id', $request->input('national_id'))->first();
        $student_academic_details = new StudentAcademicDetail;
        $student_academic_details->student_profile_id = $current_student->id;
        $student_academic_details->employer = $request->input('employer');
        $student_academic_details->nature_of_work = $request->input('work');
        $student_academic_details->highest_qualification = $request->input('highest_qualification');
        $student_academic_details->school = $request->input('school');
        $student_academic_details->senior_school = $request->input('senior_school');
        $student_academic_details->documents = $request->input('documents');
        $student_academic_details->save();

        dd('Done');
        #$student_profile->nature_of_work = $request->input('work');
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
}
