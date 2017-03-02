@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="page-title">
            添加用户
        </div><hr/>

        <div class="form row">
            <form action="/users/store" method="post">
                {{csrf_field()}}

                <div class="col-md-5">
                    用户名:
                    <input class="form-control" name="jobNumber" type="text"
                           style="margin:10px 0;"/>
                    {!! errors_for('jobNumber',$errors) !!}

                    真实姓名：
                    <input class="form-control" name="realName" type="text"
                           style="margin:10px 0;"/>
                </div>
                <div class="col-md-5">
                    角色：
                    <select class="form-control" name="role_id" style="margin:10px 0;">
                        @foreach($roles as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>

                    状态：
                    <select class="form-control" name="status_id" style="margin:10px 0;">
                        @foreach($statuses as $id => $name)
                            <option @if($id == $status_id) selected @endif value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    语言：
                    <select class="form-control" name="language_id" style="margin:10px 0;">
                        @foreach($languages as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>

                    部门：
                    <select class="form-control" name="department_id" style="margin:10px 0;">
                        @foreach($departments as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    邮箱：
                    <input class="form-control" name="email" type="email"
                           style="margin:10px 0;"/>
                    {!! errors_for('email',$errors) !!}

                    密码：
                    <input class="form-control" name="password" type="password"
                           style="margin:10px 0;"/>
                </div>
                <div class="col-md-5">
                    电话：
                    <input class="form-control" name="phone" type="text"
                           style="margin:10px 0;"/>

                    地址：
                    <input class="form-control" name="address" type="text"
                           style="margin:10px 0;"/>
                </div>
                <div class="col-md-5">
                    备注：
                    <input class="form-control" name="notes" type="text"
                           style="margin:10px 0;"/>

                    {{--用户id：--}}
                    {{--<input class="form-control" name="user_id" type="hidden"--}}
                           {{--value="" style="margin:10px 0;"/>--}}
                </div>

                <div class="col-md-10 text-center" style="margin-top:10px;">
                    <button class="btn btn-primary" type="submit" style="margin-right: 50px;">
                        确认
                    </button>
                    <a class="btn btn-danger" href="/users">
                        取消
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop