@extends('layout')

@section('content')

    @include('umeditor.head')

<div class="container">
    <div class="row">
        <div class="page-title">
            新闻编辑
        </div><hr/>

        <form action="/news/{{$post->id}}/update" method="post">
            {{csrf_field()}}

            标题:
            <input type="text" name="title" class="form-control"
                   value="{{$post->title}}" style="margin:10px 0;">
            {!! errors_for('title',$errors) !!}

            <p style="margin:50px 0 10px;">内容：</p>
            {!! errors_for('content',$errors) !!}
            <textarea id="myEditor" name="content" class="form-control"
                      style="padding:0;margin:0;height:240px;">{{$post->content}}</textarea>

            <button type="submit" class="btn btn-primary" style="margin-top:20px;">
                确认
            </button>
            <a href="/news" class="btn btn-danger" style="margin:20px 0 0 50px;">
                取消
            </a>
        </form>
    </div>
</div>
@stop