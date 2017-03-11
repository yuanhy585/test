@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="page-title">
            新闻管理
        </div><hr/>

        <a href="/news/create" class="btn btn-primary"
           style="margin-bottom: 10px;float:right;">
            新建新闻
        </a>

        <div class="table">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>标题</th>
                    <th>发布用户</th>
                    <th>姓名</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->title}}</td>
                        <td>{{App\User::where('id',$post->user_id)->first()->name}}</td>
                        <td>{{App\Profile::where('user_id',$post->user_id)->first()->real_name}}</td>
                        <td>{{$post->created_at}}</td>
                        <td>
                            <a href="" class="btn btn-primary">编辑</a>
                            <a href="" class="btn btn-success">发布</a>
                            <a href="" class="btn btn-danger">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop