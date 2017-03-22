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

                    {{--主要就是下面这个表单（现在规定只有超级管理员可以删除所有帖子及评论，--}}
                    {{--管理员或者老师可以删除自己创建的帖子及评论，学员只可以删除自己评论），然后在下面--}}
                    {{--可以来个if判断，可以像下面这么写，--}}
                    {{--if((Auth::user()->role_id > 3//这个是超级管理员可以删除所有帖子)--}}
                    {{--|| (Auth::user()->id == $post->user_id //这个表示管理员可以删除所有自己创建的帖子下的评论)--}}
                    {{--|| (Auth::user()->id == $comment->user_id //这个表示评论者可以删除自己的评论))--}}

                    @if(Auth::user()->role_id > 3
                    || (Auth::user()->id == $post->user_id)
                    || (Auth::user()->id == $comment->user_id))
                        <form action="/comment/{{$comment->id}}/delete" method="post">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-danger" style="float:right;"
                                    onclick="return ifDelete()">
                                删除评论
                            </button>
                        </form>
                    @endif

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