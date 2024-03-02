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
    public $profile_id;

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
            "effect"=>"Imported Students",
            "start_time" => $import_start_time,
            "end_time"=> date('d M Y h:i:s')
        ];
        $json = Storage::disk('public')->get('logs/.imports-YChdyIOAkduVCYsuOPsk192K');
        $json = json_decode($json, true);
        $json[Auth::User()->email.'_'.time()] = $data;

        Storage::disk('public')->put('logs/.imports-YChdyIOAkduVCYsuOPsk192K', json_encode($json));

        return view('applications.index');
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
