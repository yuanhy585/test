<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class CommentAPIController extends Controller
{
    public function getComments(Request $request)
    {
        $user_id = $request->get('user_id');
        $post_id = $request->get('post_id');
        $count = Post::where('id',$post_id)->count();

        Auth::loginUsingId($user_id);

        if ($count == 0)
        {
            $rtn = 101;
            $message = "该文章不存在";
            $response = ['code'=>$rtn, 'message'=>$message];
        }
        else
        {
            $post = Post::where('id',$post_id)->first();
            $comments = Comment::where('post_id',$post_id)->get();

            $postDatas = [];
            $postData['title'] = $post->title;
            $postData['content'] = $post->content;
            $postData['author'] = User::where('id',$post->user_id)->first()->name;
            $postData['created_at'] = date('Y-m-d H:i:s', strtotime($post->created_at));
            $postDatas[] = $postData;

            $commentDatas = [];
            foreach ($comments as $comment)
            {
                $commentData['id'] = $comment->id;
                $commentData['comment'] = $comment->comment;
                $commentData['post_id'] = $comment->post_id;
                $commentData['user'] = User::where('id',$comment->user_id)->first()->name;
                $commentData['created_at'] = date('Y-m-d H:i:s',strtotime($comment->created_at));

                $commentDatas[] = $commentData;
            }
            $postDatas['commentList'] = $commentDatas;

            $rtn = 101;
            $message = "评论信息已获取";
            $response = ['code'=>$rtn, 'message'=>$message,'post'=>$postDatas,'data'=>$commentDatas];
        }

        return response()->json($response);
    }

    public function createComment(Request $request)
    {
        $inputs = $request->all();
        $user_id = $request->get('user_id');
        $post_id = $request->get('post_id');
        $count = Post::where('id',$post_id)->count();

        Auth::loginUsingId($user_id);
        if ($count == 0)
        {
            $rtn = 101;
            $message = "该文章不存在";
            $response = ['code'=>$rtn, 'message'=>$message];
        }
        else
        {
            $post = Post::where('id',$post_id)->first();
            $postDatas = [];
            $postData['title'] = $post->title;
            $postData['content'] = $post->content;
            $postData['author'] = User::where('id',$post->user_id)->first()->name;
            $postData['created_at'] = date('Y-m-d H:i:s', strtotime($post->created_at));
            $postDatas[] = $postData;

            $commentDatas = [];
            $commentData = new Comment();
            if ($inputs['comment'] == null)
            {
                return "评论不可为空";
            }
            $commentData['comment'] = $inputs['comment'];
            $commentData['post_id'] = $inputs['post_id'];
            $commentData['user_id'] = $inputs['user_id'];
            $commentData->save();

            $commentDatas[] = $commentData;

            $rtn = 100;
            $message = "评论创建成功";
            $response = ['code'=>$rtn, 'message'=>$message, 'data'=>$commentDatas];
        }

        return response()->json($response);
    }

    public function deleteComment(Request $request)
    {
        $user_id = $request->get('user_id');
        $user = User::where('id',$user_id)->first();

        $post_id = $request->get('post_id');
        $post = Post::where('id',$post_id)->first();

        $comment_id = $request->get('comment_id');
        $count = Comment::where('id',$comment_id)->count();

        Auth::loginUsingId($user_id);
        if ($count == 0)
        {
            $rtn = 101;
            $message = "该评论不存在";
            $response = ['code'=>$rtn, 'message'=>$message];
        }
        else
        {
            $comment = Comment::where('id',$comment_id)->first();
            if ($user_id == $comment->user_id || ($user_id == $post->user_id) || ($user->role_id > 3))
            {
                $comment->delete();
            }
            else
            {
                return "抱歉，您没有删除该评论的权限";
            }

            $rtn = 100;
            $message = "评论删除成功";
            $response = ['code'=>$rtn, 'message'=>$message];

        }

        return response()->json($response);
    }

}
