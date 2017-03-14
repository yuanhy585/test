@extends('layout')

@include('umeditor.head')

@section('content')
<div class="container">
    <div class="row">
        <div class="page-title">
            更改文章
        </div><hr/>

        <form action="/posts/{{$post->id}}/update" method="post">
            {{csrf_field()}}

            标题：
            <input type="text" name="title" class="form-control"
                   style="margin:10px 0;" value="{{$post->title}}" />
            {!! errors_for('title',$errors) !!}

            <p style="margin-top:50px;">内容：</p>
            {!! errors_for('content',$errors) !!}
            <textarea name="content" class="form-control" id="myEditor"
                style="margin:0;padding:1px;height:240px;">{{$post->content}}</textarea>

            <button type="submit" class="btn btn-primary" style="margin-top:20px;">
                确认
            </button>
            <a href="/posts" class="btn btn-danger" style="margin:20px 0 0 50px;">
                取消
            </a>
        </form>
    </div>
</div>
@stop