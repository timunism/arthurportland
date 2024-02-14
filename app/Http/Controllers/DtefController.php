<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentRegister;

class DtefController extends Controller
{
    public function index() {
        
    }

    // DTEF STUDENT REGISTRATION
    public function registrations() {
        return view('dtef.registrations');
    }

    // DTEF NEW STUDENT ADMISSIONS
    public function admissions() {
        return view('dtef.admissions');
    }

    // DTEF STUDENT RESULTS
    public function results() {
        return view('dtef.results');
    }

    // $registration_id => row id of student register data
    // much secure than using actual student id
    public function editregistration($registration_id) {
        $student = StudentRegister::where('id', $registration_id)->first();
        return view('dtef.edit.view-registrations', [
            'student_info'=>$student
        ]);
    }

    public function editadmission($admission_id) {
        $student = StudentRegister::where('id', $admission_id)->first();
        return view('dtef.edit.view-admissions', [
            'student_info'=>$student
        ]);
    }

    public function editresult($admission_id) {
        $student = StudentRegister::where('id', $admission_id)->first();
        return view('dtef.edit.view-results', [
            'student_info'=>$student
        ]);
    }

}
