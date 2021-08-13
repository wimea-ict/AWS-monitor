<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ManageUsers extends Controller
{
    public function index(){
        $users = User::all();
        $roles = Role::all();
        return view('manage.index');
    }
}
