<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentRegister;

class DtefController extends Controller
{
    public function index() {
        return view('dtef.index');
    }

    // $registration_id => row id of student register data
    // much secure than using actual student id
    public function edit($registration_id) {
        $student = StudentRegister::where('id', $registration_id)->first();
        return view('dtef.view', [
            'student_info'=>$student
        ]);
    }

}
