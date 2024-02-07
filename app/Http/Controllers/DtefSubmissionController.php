<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\StudentRegister;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::User()->role == 'admissions' || Auth::User()->role == 'admin') {
            try {
                // you can also use environment variables or configuration files to store the API credentials and URL
                $username = 'sooli@arthurportland.com';
                $password = 'Decatic2021!';
                $url = 'https://tef2.gov.bw/api/post/studentadmissions?_format=hal_json';

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

                // retrieve student data
                $result = StudentRegister::where('id', $id)->first();
                
                // convert data to dictionary
                $data = [
                    'type' => [
                        ['target_id' => 'program_of_study']
                    ],
                    'title' => [
                        ['value' => ' ']
                    ],
                    'id' => [
                        ['value' => $result->national_id]
                    ],
                    'surname' => [
                        ['value' => $result->surname]
                    ],
                    'firstname' => [
                        ['value' => $result->firstname]
                    ],
                    'institution' => [
                        ['value' => $result->institution]
                    ],
                    'institution_program_code' => [
                        ['value' => $result->program_code]
                    ],
                    'program_name' => [
                        ['value' => $result->program_name]
                    ],
                    'program_duration' => [
                        ['value' => $result->program_duration]
                    ],
                    'start_date' => [
                        ['value' => $result->start_date]
                    ],
                    'completion_date' => [
                        ['value' => $result->completion_date]
                    ],
                    'entry_level' => [
                        ['value' => 1]
                    ],
                    'cost' => [
                        ['value' => $result->program_cost]
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
