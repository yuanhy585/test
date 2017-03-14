<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
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

}
