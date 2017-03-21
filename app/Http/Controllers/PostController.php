<?php

namespace App\Http\Controllers;

use App\User;
use Gate, Auth, Redirect;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $inputs = $request->has('select')?json_decode($request->input('select'),true):$request->all();
        $posts = Post::where(function ($query) use ($inputs){
            if (isset($inputs['findByPostName'])){
                $query->where('title','LIKE','%'.$inputs['findByPostName'].'%');
            }
            })
            ->whereHas('user', function ($p) use ($inputs){
                if (isset($inputs['findByUserName'])){
                    $p->where('name','LIKE','%'.$inputs['findByUserName'].'%');
                }
            })
            ->paginate(10);
        $a = $inputs;
        return view('posts.index',compact('posts','a'));
    }

    public function create()
    {
        if (Gate::denies('manage_post',Auth::user()))
        {
            return Redirect::back();
        }

        return view('posts.create');
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        $inputs = $request->all();
        $post = new Post();
        if($inputs['title'] == null)
        {
            return back()->withInput()->withErrors(['title'=>'文章标题不可为空']);
        }
        $post->title = $inputs['title'];
        if($inputs['content'] == null)
        {
            return back()->withInput()->withErrors(['content'=>'文章内容不可为空']);
        }
        $post->content = $inputs['content'];
        $post->user_id = $user_id;
        $post->save();

        return redirect('/posts');
    }

    public function edit($id)
    {
        if (Gate::denies('manage_post',Auth::user()))
        {
            return Redirect::back();
        }
        $post = Post::where('id',$id)->first();

        return view('posts.edit',compact('post'));
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $post = Post::where('id',$id)->first();
        if ($inputs['title'] == null)
        {
            {
                return back()->withInput()->withErrors(['title'=>'文章标题不可为空']);
            }
        }
        $post->title = $inputs['title'];
        if($inputs['content'] == null)
        {
            return back()->withInput()->withErrors(['content'=>'文章内容不可为空']);
        }
        $post->content = $inputs['content'];
        $post->save();

        return redirect('/posts');
    }

    public function destroy($id)
    {
        if (Gate::denies('manage_post',Auth::user()))
        {
            return back();
        }
        $post = Post::where('id',$id)->first();
        $post->delete();

//        $user_id = Post::where('id',$id)->first()->user_id;
//        $user = User::where('id',$user_id)->first();
//        if ($user->role_id == 2 || $user_id->role_id == 3)
//        {
//            $post = Post::where('id',$id)->where('user_id',$user_id)->first();
//            $post->delete();
//        }elseif ($user->role_id == 4){
//            $post = Post::where('id',$id)->first();
//            $post->delete();
//        }
        return back();
    }

}
