<?php

namespace App\Http\Controllers;

use App\Models\StudentAcademicDetail;
use App\Models\StudentCourseRegistration;
use Illuminate\Support\Facades\Http;
use App\Models\StudentRegister;
use Illuminate\Support\Facades\Auth;

// Refers to DTEF Admissions
class DtefSubmissionController extends Controller {

    # entry() is a function for running a request, one entry at a time
    # bulk() is for bulk requests

     // this function uses entry() to run bulk submissions
    public function bulk() {
        $students = StudentRegister::all();
        $ids = [];
        
        foreach ($students as $student) {
            # push student id to array
            array_push($ids, $student->id);
        }

        # dict to dump results
        $submitEntry = [];

        # post request via entry(), for each id
        foreach ($ids as $id) {
            $submitEntry[$id] = $this->entry($id);
        }
        return $submitEntry;
    }

    // request function
    public function entry($id) {
        $register = StudentCourseRegistration::where('student_profile_id', $id)
        ->join('student_courses',
          'student_course_registration.course_id', '=', 'student_courses.id')
        ->join('student_profile',
          'student_course_registration.student_profile_id', '=', 'student_profile.id')
        ->first();

        $student_academic_detail = StudentAcademicDetail::where('student_profile_id', $id)->first();

        // retrieve student data
        $modules = $register->paper;
        $modules = str_replace(';', ',', $modules);

        if (Auth::User()->role == 'admissions' || Auth::User()->role == 'admin') {
            try {
                // you can also use environment variables or configuration files to store the API credentials and URL
                $username = 'sooli@arthurportland.com';
                $password = 'Decatic2021!';
                $url = 'https://tef2.gov.bw/api/post/studentregistration?_format=hal_json';

                // Using Laravel HTTP client to retrieve the token from the Dtef API site
                $tokenResponse = Http::withOptions([
                    'verify' => false,
                ])
                ->get('https://tef2.gov.bw/rest/session/token');
                $tokenResponse = $tokenResponse->body();

                // Using Laravel HTTP client to create a single instance
                $client = Http::withBasicAuth($username, $password)
                    ->withHeaders([
                        'X-CSRF-Token' => $tokenResponse, // Using retrieved API token
                        'Content-Type' => 'application/hal+json',
                    ])
                    ->withOptions(([
                        'verify' => false
                ]));
                
                // convert data to dictionary
                $data = [
                    'id' => [
                        ['value' => $register->omang]
                    ],
                    'names' => [
                        ['value' => $register->fullname]
                    ],
                    'surname' => [
                        ['value' => $register->surname]
                    ],
                    'prog_name' => [
                        ['value' => $register->course_name]
                    ],
                    'prog_code' => [
                        ['value' => $register->course_code]
                    ],
                    'inst' => [
                        ['value' => "Arthur Portland College"]
                    ],
                    'campus' => [
                        ['value' => "Off Campus"]
                    ],
                    'accomo' => [
                        ['value' => "off"]
                    ],
                    'study_year' => [
                        ['value' => $register->study_year]
                    ],
                    'study_semester' =>[
                        ['value' => 1]
                    ],
                    'sem_start_date' => [
                        ['value' => $register->sem_start_date]
                    ],
                    'sem_end_date' => [
                        ['value' => $register->sem_end_date]
                    ],
                    'modules'=>[
                        ['value' => $register->paper]
                    ]

                ];

                // Use the defined client instance to send the post request
                $response = $client->post($url, $data);

                if ($response->successful()) {
                    // Do something with the successful response
                } else {
                    // Do something with the failed response
                }

                // Return the response or a boolean value indicating the success or failure of the operation
                return $response ?? false;

            }
            // Catch any errors and return them as JSON
             catch (\Throwable $error) {
                $message = [
                    "Error"=>$error->getMessage(),
                    "Timestamp"=>date("Y:M:D:H:i:s")
                ];
                return $message;
            }
        }
        else {
            $message = [
                "user"=>Auth::User()->email,
                "alert"=>"You are not authorized to perform this request",
                "timestamp"=>date("Y:M:D:H:i:s")
            ];
            return $message;
        }
    }

}
