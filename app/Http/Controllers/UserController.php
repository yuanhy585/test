<?php

namespace App\Http\Controllers;

use App\Language;
use App\Organization;
use App\Profile;
use App\Role;
use App\Status;
use App\User;
use Redirect,Gate,Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if(Gate::denies('manage_user',Auth::user()))
        {
            return Redirect::back();
        }
        $inputs = $request->has('select')?json_decode($request->input('select'),true):$request->all();
        $users = User::where(function($query) use ($inputs){
            if (isset($inputs['findByUserName'])){
                $query->where('name','LIKE','%'.$inputs['findByUserName'].'%');
            }
        })
        ->orWhereHas('profile', function($in) use ($inputs){
            if (isset($inputs['findByUserName'])){
                $in->where('real_name','LIKE','%'.$inputs['findByUserName'].'%');
            }
        })
        ->paginate(10);

        $a = $inputs;
        return view('users.index',compact('users','a'));
    }

    public function create()
    {
        if(Gate::denies('manage_user',Auth::user()))
        {
            return Redirect::back();
        }
        $roles = Role::all()->pluck('name','id');
        $statuses = Status::all()->pluck('name','id');
        $languages = Language::all()->pluck('name','id');
        $departments = Organization::all()->pluck('name','id');
        return view('users.create',compact('roles','statuses','languages','departments'));
    }

    public function store(Request $request)
    {
        if(Gate::denies('manage_user',Auth::user()))
        {
            return Redirect::back();
        }
        $inputs = $request->all();

        //邮箱过滤用户
        $user = User::where('email',$inputs['email'])->first();

        //工号检查用户
        $jobNumbers = User::all()->pluck('name')->toArray();

        if ($user)
        {
            return Redirect::back()->withInput()->withErrors(['email'=>'该邮箱已注册，请使用新邮箱地址']);
        }

        $user = new User();
        if(in_array($inputs['jobNumber'],$jobNumbers))
        {
            return Redirect::back()->withInput()->withErrors(['jobNumber'=>'该用户工号已存在，请使用未使用工号']);
        }
        $user->name = $inputs['jobNumber'];
        $user->role_id = isset($inputs['role_id'])?$inputs['role_id']:"1";
        $user->status_id = $inputs['status_id'];
        $user->language_id = isset($inputs['language_id'])?$inputs['language_id']:"1";
        $user->department_id = $inputs['department_id'];
        $user->email = $inputs['email'];
        $user->password = bcrypt($inputs['password']);
        $user->save();

        $profile = new Profile();
        $profile->real_name = isset($inputs['realName'])?$inputs['realName']:null;
        $profile->user_id = $user->id;
        $profile->phone = isset($inputs['phone'])?$inputs['phone']:null;
        $profile->address = isset($inputs['address'])?$inputs['address']:null;
        $profile->notes = isset($inputs['notes'])?$inputs['notes']:null;
        $profile->save();

        return redirect('/users');
    }

    public function edit($id)
    {
        if (Gate::denies('manage_user',Auth::user()))
        {
            return Redirect::back();
        }
        $user = User::where('id',$id)->first();
        $roles = Role::all()->pluck('name','id');
        $statuses = Status::all()->pluck('name','id');
        $languages = Language::all()->pluck('name','id');
        $departments = Organization::all()->pluck('name','id');
        return view('users.edit',compact('user','roles','statuses','languages','departments'));
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('manage_user',Auth::user()))
        {
            return Redirect::back();
        }
        $inputs = $request->all();
        $user = User::where('id',$id)->first();
        $user->role_id = isset($inputs['role_id'])?$inputs['role_id']:"1";
        $user->status_id = $inputs['status_id'];
        $user->language_id = isset($inputs['language_id'])?$inputs['language_id']:"1";
        $user->department_id = $inputs['department_id'];
        $user->password = $inputs['password'];
        $user->save();

        $profile = Profile::where('user_id',$id)->first();
        $profile->real_name = isset($inputs['realName'])?$inputs['realName']:null;
        $profile->phone = isset($inputs['phone'])?$inputs['phone']:null;
        $profile->address = isset($inputs['address'])?$inputs['address']:null;
        $profile->notes = isset($inputs['notes'])?$inputs['notes']:null;
        $profile->save();

        return redirect('/users');
    }

    public function destroy($id)
    {
        if (Gate::denies('manage_user',Auth::user()))
        {
            return Redirect::back();
        }
        $user = User::where('id',$id)->first();
        $user->delete();

        return back();
    }
}
