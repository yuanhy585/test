@extends('layout')

@include('umeditor.head')

@section('js')
<script src="/js/delete.js"></script>
@append

@section('content')
<div class="container">
    <div class="row">
        <div style="float:right;margin-top: 20px;">
            <a href="/discussions" class="btn btn-primary">
                返回
            </a>
        </div>

        <p class="page-title text-center" style="margin-top:80px;font-weight: bold;">
            {{$post->title}}
        </p>
        <p style="margin-top:10px;text-align: center;">
            发布者：{{App\User::where('id',$post->user_id)->first()->name}}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            发布时间：{{$post->created_at}}
        </p>

        <div class="content" style="margin-bottom:100px;">
            {{$post->content}}
        </div>

        @if(Auth::user()->role_id > 1)
            <hr/>
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary" style="margin-right: 50px;">
                编辑
            </a>
            <form action="/post/{{$post->id}}/delete" method="post" style="display: inline;">
                {{csrf_field()}}

                <button type="submit" class="btn btn-danger" onclick="return ifDelete()">
                    删除
                </button>
            </form>
            <hr/>
        @endif

        <div class="comment" style="margin:40px 0;">
                @foreach($comments as $comment)
                <div style="font-size:15px;margin-bottom: 100px;">

                    <div style="width:100%;height:10px;background-color: #ccc;margin-bottom:10px;"></div>

                    <p>
                        <span style="color: red;">
                            {{App\User::where('id',$comment->user_id)->first()->name}}
                        </span>&nbsp;&nbsp;says：
                    </p>

                    <p>{{$comment->comment}}</p>

                    <form action="/user/{{Auth::user()->id}}/comment/{{$comment->id}}" method="post">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger" style="float:right;"
                                onclick="return ifDelete()">
                            删除评论
                        </button>
                    </form>

                    <p style="clear:both;float:right;margin-top:20px;">
                        评论时间：{{$comment->created_at}}
                    </p>
                </div>
                @endforeach
        </div>

        <p style="font-weight: bold;font-size:20px;">评论区</p>

        <form action="/comment/store" method="post" style="margin-top:20px;">
            {{csrf_field()}}

            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="post_id" value="{{$post->id}}">

            {!! errors_for('content',$errors) !!}
            <textarea name="content" id="myEditor" class="form-control"
                style="margin:0;padding:1px;height:240px;"></textarea>

            <button type="submit" class="btn btn-primary" style="margin-top:20px;">
                确定
            </button>
        </form>
    </div>
</div>
@stop