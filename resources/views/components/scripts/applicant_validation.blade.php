<?php 
use App\Models\StudentProfile;
use App\Models\StudentCourseRegistration;
use Illuminate\Support\Facades\Auth;

$applicant_profile = StudentProfile::where('email', Auth::User()->email)->first();

if ($applicant_profile == null) {
    ?>
    <span>Hie, there you haven't applied yet.</span>
    <?php 
}
else {
   $course_registration = StudentCourseRegistration::where('student_profile_id', $applicant_profile->id)->first();
   if ($course_registration != null) {
    if ($course_registration->registration_status == 'pending') {
        ?>
        <x-componable.form-success message="Application Submitted"/>
        <span>Your application is pending approval. Keep checking-in for updates.</span>
        <?php
    }
    else if ($course_registration->registration_status == 'admitted') {
        ?>
        <span>Your application has been admitted <a href="#" class="cursor-pointer font-semibold text-blue-600 underline">Click</a> Here to Begin the Registration Process</span>
        <?php
    }
    else if ($course_registration->registration_status == 'rejected') {
        ?>
        <x-componable.form-error message="Application Rejected"/>
        <span>Unfortunately, your applicant was rejected. Feel free to try again next year.</span>
        <?php
    }
    else if ($course_registration->registration_status == 'waitlisted') {
        ?>
        <x-componable.form-warning message="Application Waitlisted"/>
        <span>Dear applicant, you have been waitlisted. This process can take a while, and does not guarantee admission.</span>
        <?php
    }
   }
}
?>