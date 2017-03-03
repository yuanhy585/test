@extends('layout')

@section('content')
<div class="container">
    <div class="row">
         <div class="page-title">
             用户信息
         </div><hr/>

        <div style="margin-bottom: 20px;">
            <form>
                <div class="form-inline">
                    <input type="text" name="findByUserName" class="form-control"
                            placeholder="请输入工号/姓名搜索"
                            value="{{isset($a['findByUserName'])?$a['findByUserName']:null}}"/>
                    <button class="btn btn-primary" type="submit">
                        搜索
                    </button>
                </div>
            </form>
        </div>

        <div class="table">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>用户名</th>
                    <th>姓名</th>
                    <th>角色</th>
                    <th>状态</th>
                    <th>语言</th>
                    <th>部门</th>
                    <th>邮箱</th>
                    <th>电话</th>
                    <th>地址</th>
                    <th>备注</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{App\Profile::where('user_id',$user->id)->first()->real_name}}</td>
                        <td>{{App\Role::where('id',$user->role_id)->first()->name}}</td>
                        <td>{{App\Status::where('id',$user->status_id)->first()->name}}</td>
                        <td>{{App\Language::where('id',$user->language_id)->first()->name}}</td>
                        <td>{{App\Organization::where('id',$user->organization_id)->first()->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{App\Profile::where('user_id',$user->id)->first()->phone}}</td>
                        <td>{{App\Profile::where('user_id',$user->id)->first()->address}}</td>
                        <td>{{App\Profile::where('user_id',$user->id)->first()->notes}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center">
            {!! $users->appends(['select'=>isset($s)?json_encode($a):null])->render() !!}
        </div>
    </div>
</div>
@stop