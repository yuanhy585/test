<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class DiscussionController extends Controller
{
    public function index()
    {
        $posts = Post::all()->pluck('title','id');
        return view('discussions.index',compact('posts'));
    }

    public function show($id)
    {
        $post = Post::where('id',$id)->first();
        $comments = Comment::where('post_id',$id)->get();
        return view('discussions.show',compact('post','comments'));
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        $comment = new Comment();
        if ($inputs['content'] == null)
        {
            return Redirect::back()->withInput()->withErrors(['content'=>'评论不可为空']);
        }
        $comment->comment = $inputs['content'];
        $comment->user_id = $inputs['user_id'];
        $comment->post_id = $inputs['post_id'];
        $comment->save();

        return back();
    }

    public function destroy($id)
    {
        $post = Post::where('id',$id)->first();
        $post->delete();

        return redirect('/discussions');
    }

    public function deleteComment($user_id, $comment_id)
    {
        $user_ids = User::where('role_id',1)->pluck('id')->toArray();
        $role_id = User::where('id',$user_id)->first()->role_id;
        $post_ids = Post::where('user_id',$user_id)->pluck('id')->toArray();
        $post_id = Comment::where('id',$comment_id)->first()->post_id;

        if ($role_id == 1)
        {
            $comment = Comment::where('id',$comment_id)->where('user_id',$user_id)->first();
            $comment->delete();
        }
        elseif ($role_id == 2 || $role_id == 3)
        {
            if(in_array($post_id,$post_ids))
            {
                $comment = Comment::where('id',$comment_id)->first();
            }else{
                $comment = Comment::where('id',$comment_id)->whereIn('user_id',$user_ids)
                    ->orWhere('user_id',$user_id)->first();
            }
            $comment->delete();
        }
        elseif($role_id == 4)
        {
            $comment = Comment::where('id',$comment_id)->first();
            $comment->delete();
        }

        return back();
    }

}
