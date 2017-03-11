<?php

namespace App\Http\Controllers;

use App\News;
use Gate, Auth, Redirect;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsController extends Controller
{
    public function index()
    {
        $posts = News::all();
        return view('news.index',compact('posts'));
    }

    public function create()
    {
        if (Gate::denies('create_news',Auth::user()))
        {
            return Redirect::back();
        }

        return view('news.create');
    }

    public function store(Request $request)
    {
        if (Gate::denies('create_news',Auth::user()))
        {
            return Redirect::back();
        }

        $inputs = $request->all();
        $post = new News();
        if ($inputs['title'] == null)
        {
            return back()->withInput()->withErrors(['title'=>'标题不能为空']);
        }
        $post->title = $inputs['title'];
        if ($inputs['content'] == null)
        {
            return back()->withInput()->withErrors(['content'=>'内容不能为空']);
        }
        $post->content = $inputs['content'];
        $post->user_id = $inputs['user_id'];
        $post->publish = isset($inputs['publish'])?$inputs['publish']:0;
        $post->save();

        return redirect('/news');
    }


}
