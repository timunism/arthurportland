<?php

namespace App\Imports;

use App\Models\StudentProfile;
use App\Models\StudentCourseRegistration;
use App\Models\StudentAcademicDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ApplicantsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Extract data for each model
            $profileData = [
                'fullname' => $row['fullname'],
                'surname' => $row['surname'],
                'country_of_origin' => $row['country_of_origin'],
                'date_of_birth' => $row['date_of_birth'],
                'gender' => $row['gender'],
                'email' => $row['email_address'],
                'phone' => $row['phone'],
                'omang'=> $row['omang'],
                'passport_number' => $row['passport_number'],
                'address' => $row['address'],
                'next_of_kin_phone' => $row['nok_phone'],
                'application_date' => $row['application_date'],
            ];

            // Create and save data in each model
            $studentProfile = StudentProfile::create($profileData);
            $studentProfileID = $studentProfile->id;

            $courseData = [
                'course_id' => $row['course_id'],
                'level_of_entry' => intval($row['level_of_entry']),
                'course_duration' => $row['course_duration'],
                'sponsor' => $row['sponsor'],
                'paper' => $row['paper'],
                'student_id_number'=>$row['student_id_number'],
                'start_date' => $row['start_date'],
                'application_fee_receipt'=>$row['application_fee_receipt'],
                'completion_date' => $row['completion_date'],
                'course_cost' => $row['course_cost'],
            ];

            $academicData = [
                'employer' => $row['employer'],
                'nature_of_work' => $row['nature_of_work'],
                'highest_qualification' => $row['highest_qualification'],
                'qualifications' => $row['qualifications'],
                'school' => $row['university'],
                'senior_school' => $row['senior_school'],
                'documents' => $row['documents'],
            ];

            StudentCourseRegistration::create([
                'student_profile_id' => $studentProfileID,
            ] + $courseData);

            StudentAcademicDetail::create([
                'student_profile_id' => $studentProfileID,
            ] + $academicData);
        }
    }
}
