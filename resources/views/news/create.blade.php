@extends('layout')

@section('content')

    @include('umeditor.head')

<div class="container">
    <div class="row">
        <div class="page-title">
            创建新闻
        </div><hr/>

        <div class="row">
            <form action="/news/store" method="post" role="form">
                {{csrf_field()}}

                <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
                标题：
                <input type="text" name="title" class="form-control"
                       style="margin:10px 0;"/>
                {!! errors_for('title',$errors) !!}

                <p style="margin:50px 0 10px;">内容：</p>

                {!! errors_for('content',$errors) !!}
                <textarea id="myEditor" name="content" class="form-control" style="width:100%;height:240px;padding:0;margin:0;"></textarea>

                <button type="submit" class="btn btn-primary"
                        style="margin-top: 20px;">
                    提交
                </button>
                <a href="/news" class="btn btn-danger" style="margin: 20px 0 0 30px;">
                    取消
                </a>
            </form>
        </div>
    </div>
</div>
@stop