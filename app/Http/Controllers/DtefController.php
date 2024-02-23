<?php

namespace App\Http\Controllers;

use App\Models\ExaminationResult;
use Illuminate\Http\Request;
use App\Models\StudentRegister;
use Illuminate\Support\Facades\Auth;

class DtefController extends Controller
{
    public function index() {
        
    }

    // DTEF STUDENT REGISTRATION
    public function registrations() {
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        if(
            Auth::User()->access == 'examinations' ||
            Auth::User()->access == 'individual'
            ){
            abort(403, 'You are not authorized to view this page');
          }
        return view('dtef.registrations');
    }

    // DTEF NEW STUDENT ADMISSIONS
    public function admissions() {
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        if(
            Auth::User()->access == 'examinations' ||
            Auth::User()->access == 'individual'
            ){
            abort(403, 'You are not authorized to view this page');
          }
        return view('dtef.admissions');
    }

    // DTEF STUDENT RESULTS
    public function results() {
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        if(
            Auth::User()->access == 'individual'
            ){
            abort(403, 'You are not authorized to view this page');
          }
        return view('dtef.results');
    }

    // $registration_id => row id of student register data
    // much secure than using actual student id
    public function editregistration($registration_id) {
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        if(
            Auth::User()->access == 'examinations' ||
            Auth::User()->access == 'individual'
            ){
            abort(403, 'You are not authorized to view this page');
          }
        $student = StudentRegister::where('id', $registration_id)->first();
        return view('dtef.edit.view-registrations', [
            'student_info'=>$student
        ]);
    }

    public function editadmission($admission_id) {
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        if(
            Auth::User()->access == 'examinations' ||
            Auth::User()->access == 'individual'
            ){
            abort(403, 'You are not authorized to view this page');
          }
        $student = StudentRegister::where('id', $admission_id)->first();
        return view('dtef.edit.view-admissions', [
            'student_info'=>$student
        ]);
    }

    public function editresult($admission_id) {
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        if(
            Auth::User()->access == 'individual'
            ){
            abort(403, 'You are not authorized to view this page');
          }
        $student = StudentRegister::where('id', $admission_id)->first();
        $results = ExaminationResult::where('student_id', $student->student_id)->first();
        return view('dtef.edit.view-results', [
            'student_info'=>$student,
            'results'=>$results
        ]);
    }

}
