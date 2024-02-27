<?php

namespace App\Http\Controllers;

use App\Models\FacultyProfile;
use App\Models\StudentRegister;
use App\Models\RegisterFaculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\StudentCourseRegistration;

class DashboardController extends Controller
{
    public function index() {
        // For Realtime Deactivations
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        if (Auth::User()->role != 'applicant' && Auth::User()->role != 'student') {
            // Query Students
            $students = StudentRegister::where('student_status', 'active')->paginate(10);
            // Query Access Rights
            $role= Role::where('role', Auth::User()->role)->first();

            if ($role->access == 'records' || 
                $role->access == 'unrestricted' ||
                $role->access == 'admissions' ||
                $role->access == 'examinations') {
                $femaleStudents = studentTotals('male', 'student_status', 'active');
                $maleStudents = studentTotals('female', 'student_status', 'active');

                // Male Staff
                $maleStaff = FacultyProfile::where('approval', 'approved')
                        ->where('gender', 'male')->count();
                // Female Staff
                $femaleStaff = FacultyProfile::where('approval', 'approved')
                        ->where('gender', 'female')->count();
                // total examinations officers
                $exam_officers = FacultyProfile::where('approval', 'approved')
                        ->where('role', 'examinations_officer')->count();
                // total edmissions officers
                $admission_officers = FacultyProfile::where('approval', 'approved')
                        ->where('role', 'admissions_officer')->count(); 
                // total edmissions officers
                $academic_registrars = FacultyProfile::where('approval', 'approved')
                        ->where('role', 'academic_registrar')->count();         
                $dtefFemale = StudentRegister::where('gender', 'female')
                        ->where('sponsor', 'dtef')->count();
                $dtefMale = StudentRegister::where('gender', 'male')
                        ->where('sponsor', 'dtef')->count();

                // dtef register submissions
                $dtefRegisterFailed = StudentRegister::where('sponsor', 'dtef')
                        ->where('dtef_register', 'failed')->count();
                $dtefRegisterSuccessful = StudentRegister::where('sponsor', 'dtef')
                        ->where('dtef_register', 'successful')->count();
                $dtefRegisterPending = StudentRegister::where('sponsor', 'dtef')
                        ->where('dtef_register', 'pending')->count();
                    
                // dtef results submissions
                $dtefResultsFailed = StudentRegister::where('sponsor', 'dtef')
                        ->where('dtef_result', 'failed')->count();
                $dtefResultsSuccessful = StudentRegister::where('sponsor', 'dtef')
                        ->where('dtef_result', 'successful')->count();
                $dtefResultsPending = StudentRegister::where('sponsor', 'dtef')
                        ->where('dtef_result', 'pending')->count(); 
                
                return view('dashboard', [
                        // access
                        'access'=>$role->access,
                        // students
                        'students'=>$students,
                        'femaleStudents'=>$femaleStudents,
                        'maleStudents'=>$maleStudents,
                        'maleStaff'=>$maleStaff,
                        'femaleStaff'=>$femaleStaff,
                        'academic_registrars'=>$academic_registrars,
                        'exam_officers'=>$exam_officers,
                        'admissions_officers'=>$admission_officers,
                        'dtefMale'=>$dtefMale,
                        'dtefFemale'=>$dtefFemale,
                        # DTEF Register
                        'dtefRegisterPending'=>$dtefRegisterPending,
                        'dtefRegisterSuccessful'=>$dtefRegisterSuccessful,
                        'dtefRegisterFailed'=>$dtefRegisterFailed,
                        # DTEF Results
                        'dtefResultsPending'=>$dtefResultsPending,
                        'dtefResultsSuccessful'=>$dtefResultsSuccessful,
                        'dtefResultsFailed'=>$dtefResultsFailed,
                ]);
            }

        else {
            return ["Alert"=>"You're not yet authorized to access the Dashboard."];
        }

        }
        else if (Auth::User()->role == 'student' || Auth::User()->role == 'applicant') {
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

function retrieveStaff(){
    $staff = FacultyProfile::where('approval', 'approved')
            ->join('users',
                'faculty_profile.email', '=', 'users.email'
            )->get();
    return $staff;
}