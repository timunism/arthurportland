<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationChatbotController extends Controller
{
    public function index() {
        return view('application.chatbot');
    }
}
