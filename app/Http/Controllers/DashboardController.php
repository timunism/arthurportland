<?php

namespace App\Http\Controllers;

use App\Models\StudentRegister;
use App\Models\RegisterFaculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class DashboardController extends Controller
{
    public function index() {
        if (Auth::User() != 'student' && Auth::User() != 'applicant') {
            // Query Students
            $students = StudentRegister::where('student_status', 'active')->paginate(10);
            // Query Access Rights
            $role= Role::where('role', Auth::User()->role)->first();

            if ($role->access == 'records' || $role->access == 'unrestricted') {
                $femaleStudents = studentTotals('male', 'student_status', 'active');
                $maleStudents = studentTotals('female', 'student_status', 'active');
                $hods = 18; // total HODs
                $lecturers = 71; // total Lectures
                $dtefFemale = 45;
                $dtefMale = 20;
                $dtefFailed = 3; // dtef failed submissions
                $dtefSuccessful = ($dtefFemale + $dtefMale) - $dtefFailed; // dtef successful
            }
            else {
                $femaleStudents = 0; // Assign Class Female Students
                $maleStudents = 0; // Assign Class Male Studentss
                $hods = 0; // department HODs
                $lecturers = 0; // department Lecturers
                $dtefFemale = 45; // Class Dtef Female Students
                $dtefMale = 20; // Class Dtef Male Students
                $dtefFailed = 3; // dtef failed submissions
                $dtefSuccessful = ($dtefFemale + $dtefMale) - $dtefFailed; // dtef successful
            }

            return view('dashboard', [
                // access
                'access'=>$role->access,
                // students
                'students'=>$students,
                'femaleStudents'=>$femaleStudents,
                'maleStudents'=>$maleStudents,
                'hods'=>$hods,
                'lecturers'=>$lecturers,
                'dtefMale'=>$dtefMale,
                'dtefFemale'=>$dtefFemale,
                'dtefSuccessful'=>$dtefSuccessful,
                'dtefFailed'=>$dtefFailed,
            ]);
        }
        else if (Auth::User()->role == 'student') {
            // retrieve student information from register table
            // retrieve student courses information from courses table
            // pass retrieved information to dashboard

            return view('dashboard');
        }
    }
}

// FUNCTIONS

// Totals the specified column in RegisterStudent model
function studentTotals($gender, $column, $target) {
    $total = StudentRegister::where($column, $target)
            ->where('gender', $gender)->paginate()->total();
    return $total;
}

function facultyRetriever($column, $target, $total){
    if ($total == true) {
        $data = RegisterFaculty::where($column, $target)->paginate()->total();
    }
    else {
        $data = RegisterFaculty::where($column, $target)->paginate();
    }
    return $data;
}