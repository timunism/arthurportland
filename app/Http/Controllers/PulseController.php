<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PulseController extends Controller
{
    public function index(){
        if (Auth::user()->role == 'admin') {
            return view('pulse');
        }
        else {
            return redirect()->route('dashboard');
        }
    }
}
