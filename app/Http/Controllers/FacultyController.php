<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FacultyApplicationRequest;
use App\Models\FacultyProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        if (Auth::User()->access != 'admissions' && Auth::User()->access != 'unrestricted') {
            abort(403, 'You are not authorized to view this page');
        }
        return view('faculty.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * In validation, 'unique' uses the original database table name
     */
    public function store(FacultyApplicationRequest $request){
        $omang = null;
        $passport_number = null;
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        if ($request->input('omang') != null) {
            $request->validate([
                'country_of_origin'=>'required',
                'omang'=>'required|unique:faculty_profile',
                'email'=>'required|unique:faculty_profile|unique:users',
                'phone'=>'required|unique:faculty_profile',
            ]);
            $omang = $request->input('omang');

        }
        else {
            $request->validate([
                'country_of_origin'=>'required',
                'passport_number'=>'required|unique:faculty_profile',
                'email'=>'required|unique:faculty_profile|unique:users',
                'phone'=>'required|unique:faculty_profile',
            ]);
            $passport_number = $request->input('passport_number');
        }

        $faculty_profile = new FacultyProfile;
        $faculty_profile->fullname = $request->input('fullname');
        $faculty_profile->surname = $request->input('surname');
        $faculty_profile->title = $request->input('title');
        $faculty_profile->gender = $request->input('gender');
        $faculty_profile->omang = $omang;
        $faculty_profile->passport_number = $passport_number;
        $faculty_profile->country_of_origin = $request->input('country_of_origin');
        $faculty_profile->date_of_birth = $request->input('dob');
        $faculty_profile->email = $request->input('email');
        $faculty_profile->phone = $request->input('phone');
        $faculty_profile->address = $request->input('address');
        $faculty_profile->role = $request->input('role');
        $faculty_profile->department = $request->input('department');
        $faculty_profile->save();

        $data = [
            'alert'=>'Your application has been sent, you will be notified via email, as soon as it is approved.'
        ];

        return $data;
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
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        if (
            Auth::User()->access != 'admissions' &&
            Auth::User()->access != 'unrestricted'
            ) {
                abort(403, 'Unauthorized Request');
        }
        $faculty_profiles = FacultyProfile::where('faculty_profile.id', $id)
        ->join('departments', 
        'faculty_profile.department', '=', 'departments.id')
        ->join('student_courses',
        'student_courses.course_name', '=', 'departments.department_name')->first();

        try {
            $profile_user = User::where('email', $faculty_profiles->email)->first();
        } catch (\Throwable $th) {
            $profile_user = null;
        }
        return view('faculty.edit', [
            'faculty_info'=>$faculty_profiles,
            'profile_user'=>$profile_user
        ]);
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
