<?php

namespace App\Http\Controllers;

use App\User;
use Redirect, Gate, Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReportController extends Controller
{
    public function user(Request $request)
    {
        if (Gate::denies('check_report',Auth::user()))
        {
            return Redirect::back();
        }

        $inputs = $request->has('select')?json_decode($request->input('select'),true):$request->all();

        $users = User::where(function($query) use ($inputs){
            if(isset($inputs['findByUserName'])){
                $query->where('name','LIKE','%'.$inputs['findByUserName'].'%');
            }
        })
            ->orWhereHas('profile', function ($in) use ($inputs){
            if(isset($inputs['findByUserName'])){
                $in->where('real_name','LIKE','%'.$inputs['findByUserName'].'%');
            }
        })
            ->paginate(10);

        $a = $inputs;

        return view('reports.user',compact('users','a'));
    }
}
