<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\StudentRegister;

class DtefResultsPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
    public function postToAPI()
    {
        $results = StudentRegister::all();

        foreach ($results as $result) {
            $passport_number = $result->passport_number;
            $surname = $result->surname;
            $firstname = $result->firstname;
            $program_name = $result->program_name;
            $program_code = $result->program_code;
            $program_duration = $result->program_duration;
            $start_date = $result->start_date;
            $completion_date = $result->completion_date;
            $program_cost = $result->program_cost;
            $level_of_entry = $result->level_of_entry;
            $student_id = $result->student_id;
            $institution = $result->institution;

            // Fetch the token to insert in header
            $tsite = 'https://tef2.gov.bw/rest/session/token';

            $tokenResponse = \Illuminate\Support\Facades\Http::get($tsite);
            $token = $tokenResponse->body();

            // Sending the data to the API provided
            $url = "https://tef2.gov.bw/api/post/studentadmissions?_format=hal_json";

            $headers = [
                "X-CSRF-Token" => $token,
                "Content-Type" => "application/hal+json",
            ];

            $username = "sooli@arthurportland.com";
            $password = "Decatic2021!";

            $data = [
                "type" => [
                    ["target_id" => "program_of_study"]
                ],
                "title" => [
                    ["value" => " "]
                ],
                "id" => [
                    ["value" => $passport_number]
                ],
                "surname" => [
                    ["value" => $surname]
                ],
                "firstname" => [
                    ["value" => $firstname]
                ],
                "institution" => [
                    ["value" => $institution]
                ],
                "institution_program_code" => [
                    ["value" => $program_code]
                ],
                "program_name" => [
                    ["value" => $program_name]
                ],
                "program_duration" => [
                    ["value" => $program_duration]
                ],
                "start_date" => [
                    ["value" => $start_date]
                ],
                "completion_date" => [
                    ["value" => $completion_date]
                ],
                "entry_level" => [
                    ["value" => $level_of_entry]
                ],
                "cost" => [
                    ["value" => $program_cost]
                ]
            ];

            $response = \Illuminate\Support\Facades\Http::withHeaders($headers)
                ->withBasicAuth($username, $password)
                ->post($url, $data);

            $responseData = $response->json();
        }
    }
}
