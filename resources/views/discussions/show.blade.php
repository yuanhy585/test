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

        <p class="page-title text-center" style="margin-top:80px;">
            {{$post->title}}
        </p>
        <p style="margin-top:10px;text-align: center;">
            发布者：{{App\User::where('id',$post->user_id)->first()->name}}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            发布时间：{{$post->created_at}}
        </p>

        <div class="content">
            {{$post->content}}
        </div>

        <div class="comment" style="margin:80px 0 20px;">
            <p>评论区</p>
            <table style="font-size:15px;">
                @foreach($comments as $comment)
                    <tr>
                        <td style="text-align: left;">
                            <p style="margin-top:20px;">
                                第{{$comment->id}}条评论：
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            {{$comment->comment}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="text-align: right;">
                                评论时间：{{$comment->created_at}}
                                评论人：{{App\User::where('id',$comment->user_id)->first()->name}}
                            </p>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if(Auth::user()->role_id > 1)
            <a href="" class="btn btn-primary">
                编辑
            </a>
            <form action="" method="" style="display: inline;">
                {{csrf_field()}}

                <button type="" class="btn btn-danger" onclick="return ifDelete()">
                    删除
                </button>
            </form>
        @endif

        <form action="/comment/store" method="post" style="margin-top:20px;">
            {{csrf_field()}}

            <input type="hidden" name="user_id" value="{{$post->user_id}}">
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