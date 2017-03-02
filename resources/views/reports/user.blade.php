@extends('layout')

@section('content')
<div class="container">
    <div class="row">
         <div class="page-title">
             用户信息
         </div><hr/>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>实名</th>
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
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->profile->real_name}}</td>
                        <td>{{$user->role->name}}</td>
                        <td>{{$user->status->name}}</td>
                        <td>{{$user->language->name}}</td>
                        <td>{{$user->organization->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->profile->phone}}</td>
                        <td>{{$user->profile->address}}</td>
                        <td>{{$user->profile->notes}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop