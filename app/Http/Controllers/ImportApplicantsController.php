<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Imports\ApplicantsImport;
use App\Models\StudentAcademicDetail;
use App\Models\StudentCourseRegistration;
use App\Models\StudentProfile;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class ImportApplicantsController extends Controller
{

    public function index() {
        return view('import.applicants');
    }
public function store(ImportRequest $request)
{
    $file = $request->file('import_file');
    // Import the data from the file using Maatwebsite's Excel package
    Excel::import(new ApplicantsImport, $file);

    return view('applications.index');
}

// Located at ApplicationTable
public function delete($id)
    {
        DB::beginTransaction();

        try {
            // Delete the student profile record
            StudentProfile::find($id)->delete();

            // Delete the associated student course registration record
            StudentCourseRegistration::where('student_id', $id)->delete();

            // Delete the associated student academic detail record
            StudentAcademicDetail::where('student_id', $id)->delete();

            // Commit the database transaction
            DB::commit();

            // Refresh the page to show the updated table
            return redirect()->refresh();
        } catch (\Exception $e) {
            // Rollback the database transaction if any error occurs
            DB::rollback();

            // Throw the exception back to the caller
            throw $e;
        }
    }
}
