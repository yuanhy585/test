@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="page-title">
            用户管理
        </div><hr/>

        <div style="margin-bottom: 20px;float: left;">
            <form>
                <div class="form-inline" style="margin-bottom: 10px;">
                    <select class="form-control" name="attr1_id">
                        <option value="0">请选择{{$attribute->attr1_title}}</option>
                        @foreach($attr1s as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control" name="attr2_id">
                        <option value="0">请选择{{$attribute->attr2_title}}</option>
                        @foreach($attr2s as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control" name="attr3_id">
                        <option value="0">请选择{{$attribute->attr3_title}}</option>
                        @foreach($attr3s as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control" name="attr4_id">
                        <option value="0">请选择{{$attribute->attr4_title}}</option>
                        @foreach($attr4s as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control" name="attr5_id">
                        <option value="0">请选择{{$attribute->attr5_title}}</option>
                        @foreach($attr5s as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-inline" style="float:left;">
                    <select class="form-control" name="status_id">
                        @foreach($statuses as $id => $name)
                            <option @if($a['status_id'] == $id) selected @endif value="{{$id}}">
                                {{$name}}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="findByUserName" class="form-control"
                            placeholder="请输入工号/姓名搜索"
                            value="{{isset($a['findByUserName'])?$a['findByUserName']:null}}"/>
                    <button type="submit" class="btn btn-primary">
                        搜索
                    </button>
                </div>
            </form>
        </div>

        <div style="clear: both;margin-bottom: 10px;">
            <a class="btn btn-primary" href="/users/create" >
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