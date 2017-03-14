@extends('layout')

@include('umeditor.head')

@section('content')
<div class="container">
    <div class="row">
        <div class="page-title">
            新建文章
        </div><hr/>

        <form action="/posts/store" method="post">
            {{csrf_field()}}

            题目：
            <input type="text" name="title" class="form-control" style="margin:10px 0;"/>
            {!! errors_for('title',$errors) !!}

            <p style="margin-top: 50px;">内容：</p>
            {!! errors_for('content',$errors) !!}
            <textarea name="content" id="myEditor" class="form-control"
            style="padding:1px;margin:0;height:240px;"></textarea>

            <button type="submit" class="btn btn-primary" style="margin-top:20px;">
                提交
            </button>
            <a href="/posts" class="btn btn-danger" style="margin:20px 0 0 50px;">
                取消
            </a>
        </form>
    </div>
</div>
@stop