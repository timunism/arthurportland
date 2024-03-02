<?php

namespace App\Imports;

use App\Models\ExaminationResult;
use App\Models\StudentProfile;
use App\Models\StudentCourseRegistration;
use App\Models\StudentAcademicDetail;
use App\Models\StudentCourse;
use App\Models\StudentRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ApplicantsImport implements ToCollection, WithHeadingRow, ShouldQueue, WithChunkReading
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            try {
                // First Stage The Data
                $profileData = [
                    'fullname' => trim($row['fullname']),
                    'surname' => trim($row['surname']),
                    'country_of_origin' => trim($row['country_of_origin']),
                    'date_of_birth' => trim($row['date_of_birth']),
                    'gender' => trim($row['gender']),
                    'email' => trim($row['email_address']),
                    'phone' => trim($row['phone']),
                    'omang'=> trim($row['omang']),
                    'passport_number' => trim($row['passport_number']),
                    'address' => trim($row['address']),
                    'next_of_kin_phone' => trim($row['nok_phone']),
                    'application_date' => trim($row['application_date']),
                    'imported'=>'yes',
                ];

                $courseData = [
                    'course_id' => trim($row['course_id']),
                    'level_of_entry' => intval($row['level_of_entry']),
                    'course_duration' => trim($row['course_duration']),
                    'sponsor' => trim($row['sponsor']),
                    'paper' => trim($row['paper']),
                    'student_id_number'=>trim($row['student_id_number']),
                    'start_date' => trim($row['start_date']),
                    'application_fee_receipt'=>trim($row['application_fee_receipt']),
                    'completion_date' => trim($row['completion_date']),
                    'course_cost' => trim($row['course_cost']),
                ];

                $academicData = [
                    'employer' => trim($row['employer']),
                    'nature_of_work' => trim($row['nature_of_work']),
                    'highest_qualification' => trim($row['highest_qualification']),
                    'qualifications' => trim($row['qualifications']),
                    'school' => trim($row['university']),
                    'senior_school' => trim($row['senior_school']),
                    'documents' => trim($row['documents']),
                ];
            } catch (\Throwable $th) {
                abort(403, 'Error Parsing File');
            }

            try {
                // update if alread exists
                $student = StudentProfile::where('email', trim($row['email_address']))->first();
                if ($student) {
                    // Then Create Profile
                    $studentProfile = $student->update($profileData);
                    $studentProfileID = $student->id;

                    // Link profile to the following insertions
                    $studentCourseRegistration = 
                        StudentCourseRegistration::where('student_profile_id', $studentProfileID)->first();
                    
                    $studentCourseRegistration->update($courseData);

                    $studentAcademicDetail = StudentAcademicDetail::where('student_profile_id', $studentProfileID)->first();
                    $studentAcademicDetail->update($academicData);
                }
                else {
                    // Then Create Profile
                    $studentProfile = StudentProfile::create($profileData);
                    $studentProfileID = $studentProfile->id;

                    // Link profile to the following insertions
                    $student_course_registration = StudentCourseRegistration::create([
                        'student_profile_id' => $studentProfileID,
                    ] + $courseData);

                    StudentAcademicDetail::create([
                        'student_profile_id' => $studentProfileID,
                    ] + $academicData);

                    if (trim($row['student_id_number'] != '')) {
                        $course = StudentCourse::where('id', $student_course_registration->course_id)->first();
                        
                        StudentCourseRegistration::where('student_profile_id', $studentProfileID)
                            ->update(['registration_status'=>'admitted']);
                        StudentRegister::create([
                            'student_profile_id' => $studentProfileID,
                            'student_id' => trim($row['student_id_number']),
                            'tr_number'=>trim($row['omang']),
                            'program_code'=>$course->course_code,
                            'program_description'=>$course->course_name,
                            'year_of_study'=>$student_course_registration->level_of_entry,
                            'start_date'=>'2024-08-11',
                            'student_status'=>trim($row['student_status']),
                            'accomodation_status'=>'off',
                            'campus'=>'Gaborone',
                            'tr_number'=>trim($row['tr_number']),
                            'end_date'=>'2024-12-01',
                            'date_of_registration'=>'2024-02-12',
                            'subjects_enrolled'=>str_replace(';', ' ', $student_course_registration->paper),
                            'credit_enrolled'=>4,
                            'number_of_modules'=>4,
                            'passed'=>0,
                            'failed'=>0,
                            'sponsor'=>$student_course_registration->sponsor,
                            'accomodation_status'=>'off',
                            'campus'=>'Gaborone',
                        ]);
                        ExaminationResult::create([
                            'student_id'=>trim($row['student_id_number']),
                            'subjects_enrolled'=>str_replace(';', ' ', $student_course_registration->paper),
                            'result'=>trim($row['result']),
                            'pending'=>trim($row['pending']),
                            'to_write'=>trim($row['to_write']),
                            'outcome'=>trim($row['outcome']),
                        ]);
                    }
                }
            } catch (\Throwable $th) {
                dd($th);
                //abort(403, 'Error Inserting Data to Tables');
            }
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
