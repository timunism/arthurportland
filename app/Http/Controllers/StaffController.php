<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StaffApplicationRequest;
use App\Models\StaffProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
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
        return view('staff.index');
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
    public function store(StaffApplicationRequest $request){
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
                'omang'=>'required|unique:staff_profile',
                'email'=>'required|unique:staff_profile|unique:users',
                'phone'=>'required|unique:staff_profile',
            ]);
            $omang = $request->input('omang');

        }
        else {
            $request->validate([
                'country_of_origin'=>'required',
                'passport_number'=>'required|unique:staff_profile',
                'email'=>'required|unique:staff_profile|unique:users',
                'phone'=>'required|unique:staff_profile',
            ]);
            $passport_number = $request->input('passport_number');
        }

        $staff_profile = new StaffProfile;
        $staff_profile->fullname = $request->input('fullname');
        $staff_profile->surname = $request->input('surname');
        $staff_profile->title = $request->input('title');
        $staff_profile->gender = $request->input('gender');
        $staff_profile->omang = $omang;
        $staff_profile->passport_number = $passport_number;
        $staff_profile->country_of_origin = $request->input('country_of_origin');
        $staff_profile->date_of_birth = $request->input('dob');
        $staff_profile->email = $request->input('email');
        $staff_profile->phone = $request->input('phone');
        $staff_profile->address = $request->input('address');
        $staff_profile->role = $request->input('role');
        $staff_profile->department = $request->input('department');
        $staff_profile->save();

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
        $staff_profiles = StaffProfile::where('staff_profile.id', $id)
        ->join('departments', 
        'staff_profile.department', '=', 'departments.id')
        ->join('student_courses',
        'student_courses.course_name', '=', 'departments.department_name')->first();

        try {
            $profile_user = User::where('email', $staff_profiles->email)->first();
        } catch (\Throwable $th) {
            $profile_user = null;
        }
        return view('staff.edit', [
            'staff_info'=>$staff_profiles,
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
