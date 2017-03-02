<?php

namespace App\Http\Controllers;

use App\User;
use Redirect, Gate, Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReportController extends Controller
{
    public function user()
    {
        if (Gate::denies('check_report',Auth::user()))
        {
            return Redirect::back();
        }

        $users = User::all();
        return view('reports.user',compact('users'));
    }
}
