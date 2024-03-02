<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LogatronController extends Controller
{
    public function index(){

    }
    public function delete(Request $request){
        if (Auth::User()->role != 'admin') {
            abort(403, 'You are not authorized to delete log files');
        }
        
        // Retrieve LogFile
        $json = Storage::disk('public')->get('logs/'.$request->input('logfile'));
        $json = json_decode($json, true);
        
        // Delete Entry
        if (array_key_exists($request->input('entry'), $json)) {
            unset($json[$request->input('entry')]);
        }
        // Return JSON
        Storage::disk('public')->put('logs/'.$request->input('logfile'), json_encode($json));

        return redirect()->route($request->input('dispatcher').'.logsview');
    }
}
