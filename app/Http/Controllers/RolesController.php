<?php

namespace App\Http\Controllers;
use App\Models\Role;

use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function getRoles()
    {
        $roles = Role::where('status', 'active')
        ->where('visibility', 'visible')->get();
        
        return response()->json($roles);
    }
}
