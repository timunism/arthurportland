<?php

namespace App\Http\Controllers;

use App\Models\ExaminationResult;
use App\Models\StudentAcademicDetail;
use App\Models\StudentCourseRegistration;
use Illuminate\Support\Facades\Http;
use App\Models\StudentRegister;
use Illuminate\Support\Facades\Auth;

class DtefResultController extends Controller {

    # entry() is a function for running a request, one entry at a time
    # bulk() is for bulk requests

     // this function uses entry() to run bulk submissions
    public function bulk() {
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
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
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        $register = StudentCourseRegistration::where('student_profile_id', $id)
        ->join('student_courses',
          'student_course_registration.course_id', '=', 'student_courses.id')
        ->join('student_profile',
          'student_course_registration.student_profile_id', '=', 'student_profile.id')
        ->first();

        $results = StudentRegister::where('student_profile_id', $id)
        ->join('examination_results',
            'student_register.student_id', '=', 'examination_results.student_id')
        ->first();

        // retrieve student data
        $modules = $register->paper;
        $modules = str_replace(';', ',', $modules);

        if (Auth::User()->access == 'admissions' || Auth::User()->role == 'admin') {
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
                        ['value' => $register->national_id]
                    ],
                    'tr' => [
                        ['value' => $register->tr_number]
                    ],
                    'names' => [
                        ['value' => $register->fullname]
                    ],
                    'surname' => [
                        ['value' => $register->surname]
                    ],
                    'study_year' => [
                        ['value' => intval($register->start_date)]
                    ],
                    'study_semester' => [
                        ['value' => 1]
                    ],
                    'modules'=>[
                        ['value' => $modules]
                    ],
                    'results'=>[
                        ['value' => $results->result]
                    ],
                    'status'=>[
                        ['value'=>$results->outcome]
                    ]

                ];

                // Use the defined client instance to send the post request
                $response = $client->post($url, $data);

                if ($response->successful()) {
                    // Do something with the successful response
                    StudentRegister::where('id', $register->id)
                        ->update(['dtef_result'=>'successful']);
                } else {
                    // Do something with the failed response
                    StudentRegister::where('id', $register->id)
                    ->update(['dtef_result'=>'failed']);
                }

                // Return the response or a boolean value indicating the success or failure of the operation
                return $response ?? false;

            }
            // Catch any errors and return them as JSON
             catch (\Throwable $error) {
                $message = [
                    "api"=>"dtef-results",
                    "Error"=>$error->getMessage(),
                    "Timestamp"=>date("Y:M:D:H:i:s")
                ];
                return $message;
            }
        }
        else {
            $message = [
                "api"=>"dtef-results",
                "user"=>Auth::User()->email,
                "alert"=>"You are not authorized to perform this request",
                "timestamp"=>date("Y:M:D:H:i:s")
            ];
            return $message;
        }
    }

}
