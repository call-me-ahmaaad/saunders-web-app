<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class EmployeeController extends Controller
{
    public function web_index(){
        return view('dashboard1', [
            "employees" => User::all(),
        ]);
    }
}
