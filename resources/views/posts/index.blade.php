@extends('layout')

@section('js')
<script src="/js/delete.js"></script>
@append

@section('content')
<div class="container">
    <div class="row">
        <div class="page-title">
            文章管理
        </div><hr/>

        <a href="/posts/create" class="btn btn-primary"
           style="margin:10px;float: right;">
            添加文章
        </a>

        <div class="form">
            <form class="form">
                <div class="form-inline" style="float:right;margin:10px 0;clear: both;">
                    <input type="text" name="findByPostName" class="form-control"
                           placeholder="请输入文章题目搜索"
                           value="{{isset($a['findByPostName'])?$a['findByPostName']:""}}"/>
                    <input type="text" name="findByUserName" class="form-control"
                           placeholder="请输入发布者名字搜索"
                           value="{{isset($a['findByUserName'])?$a['findByUserName']:""}}"/>
                    <button type="submit" class="btn btn-primary">
                        搜索
                    </button>
                </div>
            </form>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>题目</th>
                <th>创建者</th>
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
                        <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">
                            编辑
                        </a>
                        <form action="/user/{{Auth::user()->id}}/posts/{{$post->id}}/delete" method="post" style="display:inline;">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-danger" onclick="return ifDelete()">
                                删除
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer text-center">
        {!! $posts->appends(['select'=>isset($a)?json_encode($a):""])->render() !!}
    </div>
</div>
@stop