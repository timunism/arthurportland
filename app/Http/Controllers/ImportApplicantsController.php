<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Imports\ApplicantsImport;
use App\Models\StudentAcademicDetail;
use App\Models\StudentCourseRegistration;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImportApplicantsController extends Controller
{
    public function index() {
        return view('import.applicants');
    }

    public function store(ImportRequest $request)
    {
        $file = $request->file('import_file');
        // Import the data from the file using Maatwebsite's Excel package
        // refer to Imports/ApplicantsImport
        $import_start_time = date('d M Y h:i:s');
        Excel::queueImport(new ApplicantsImport, $file);

        // Log Import
        $data = [
            "effect"=>"Imported",
            "start_time" => $import_start_time,
            "end_time"=> date('d M Y h:i:s')
        ];
        $json = Storage::disk('public')->get('logs/imports.json');
        $json = json_decode($json, true);
        $json[Auth::User()->email.'_'.time()] = $data;

        Storage::disk('public')->put('logs/imports.json', json_encode($json));

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

    public function logsview() {
        if (Auth::User()) {
            if (Auth::User()->access != 'unrestricted') {
                abort(403, 'Access Denied');
            }
        }
        else {
            abort(404, 'Page Not Found');
        }
  
        return view('import.logs.view');
    }
}
