@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="page-title">
            用户管理
        </div><hr/>

        <div style="margin-bottom: 20px;float: right;">
            <form>
                <div class="form-inline">
                    <input type="text" name="findByUserName" class="form-control"
                            placeholder="请输入工号/姓名搜索"
                            value="{{isset($a['findByUserName'])?$a['findByUserName']:null}}"/>
                    <button type="submit" class="btn btn-primary">
                        搜索
                    </button>
                </div>
            </form>

            <a class="btn btn-primary" href="/users/create"  style="margin: 20px 0 0 170px;">
                添加用户
            </a>
        </div>

        <div class="table">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>用户名</th>
                    <th>姓名</th>
                    <th>角色</th>
                    <th>状态</th>
                    <th>邮箱</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->profile->real_name}}</td>
                        <td>{{$user->role->name}}</td>
                        <td>{{$user->status->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <a class="btn btn-primary" href="/users/{{$user->id}}/edit">编辑</a>
                            <a class="btn btn-danger" href="/users/{{$user->id}}/delete">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {!! $users->appends(['select'=>isset($a)?json_encode($a):""])->render() !!}
        </div>
    </div>
</div>
@stop