<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\FifthAttribute;
use App\FirstAttribute;
use App\FourthAttribute;
use App\Language;
use App\Organization;
use App\Profile;
use App\Role;
use App\SecondAttribute;
use App\Status;
use App\ThirdAttribute;
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
        $status_id = 2;
        $attribute = Attribute::first();
        $attr1s = FirstAttribute::all();
        $attr2s = SecondAttribute::all();
        $attr3s = ThirdAttribute::all();
        $attr4s = FourthAttribute::all();
        $attr5s = FifthAttribute::all();
        return view('users.create',compact('roles','statuses','languages','departments',
            'status_id','attribute','attr1s','attr2s','attr3s','attr4s','attr5s'));
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
        $user->organization_id = $inputs['department_id'];
        $user->email = $inputs['email'];
        $user->password = bcrypt($inputs['password']);
        $user->save();

        $profile = new Profile();
        $profile->real_name = isset($inputs['realName'])?$inputs['realName']:null;
        $profile->user_id = $user->id;
        $profile->phone = isset($inputs['phone'])?$inputs['phone']:null;
        $profile->address = isset($inputs['address'])?$inputs['address']:null;
        $profile->notes = isset($inputs['notes'])?$inputs['notes']:null;
        $profile->attribute1_id = isset($inputs['attr1_id'])?$inputs['attr1_id']:null;
        $profile->attribute2_id = isset($inputs['attr2_id'])?$inputs['attr2_id']:null;
        $profile->attribute3_id = isset($inputs['attr3_id'])?$inputs['attr3_id']:null;
        $profile->attribute4_id = isset($inputs['attr4_id'])?$inputs['attr4_id']:null;
        $profile->attribute5_id = isset($inputs['attr5_id'])?$inputs['attr5_id']:null;
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
        $attribute = Attribute::first();
        $attr1s = FirstAttribute::all();
        $attr2s = SecondAttribute::all();
        $attr3s = ThirdAttribute::all();
        $attr4s = FourthAttribute::all();
        $attr5s = FifthAttribute::all();
        $attr1_id = Profile::where('user_id',$id)->first()->attribute1_id;
        $attr2_id = Profile::where('user_id',$id)->first()->attribute2_id;
        $attr3_id = Profile::where('user_id',$id)->first()->attribute3_id;
        $attr4_id = Profile::where('user_id',$id)->first()->attribute4_id;
        $attr5_id = Profile::where('user_id',$id)->first()->attribute5_id;
        return view('users.edit',compact('user','roles','statuses','languages','departments',
            'attribute','attr1s','attr2s','attr3s','attr4s','attr5s','attr1_id','attr2_id',
            'attr3_id','attr4_id','attr5_id'));
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
        $user->organization_id = $inputs['department_id'];
        $user->password = isset($inputs['password'])?bcrypt($inputs['password']):$user->password;
        $user->save();

        $profile = Profile::where('user_id',$id)->first();
        $profile->real_name = isset($inputs['realName'])?$inputs['realName']:null;
        $profile->phone = isset($inputs['phone'])?$inputs['phone']:null;
        $profile->address = isset($inputs['address'])?$inputs['address']:null;
        $profile->notes = isset($inputs['notes'])?$inputs['notes']:null;
        $profile->attribute1_id = isset($inputs['attr1_id'])?$inputs['attr1_id']:0;
        $profile->attribute2_id = isset($inputs['attr2_id'])?$inputs['attr2_id']:0;
        $profile->attribute3_id = isset($inputs['attr3_id'])?$inputs['attr3_id']:0;
        $profile->attribute4_id = isset($inputs['attr4_id'])?$inputs['attr4_id']:0;
        $profile->attribute5_id = isset($inputs['attr5_id'])?$inputs['attr5_id']:0;
        $profile->save();

        return redirect('/users');
    }

    public function destroy($id)
    {
        if (Gate::denies('manage_user',Auth::user()))
        {
            return Redirect::back();
        }
        $AM_id = 4;
        $user = User::where('id',$id)->first();
        if($user->role_id == $AM_id)
        {
            return redirect('/users');
        }
        $user->delete();

        return back();
    }
}
