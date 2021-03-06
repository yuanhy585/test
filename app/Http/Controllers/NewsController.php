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

    public function edit($id)
    {
        if (Gate::denies('create_news',Auth::user()))
        {
            return Redirect::back();
        }

        $post = News::where('id',$id)->first();
        return view('news.edit',compact('post'));
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $post = News::where('id',$id)->first();

        if ($inputs['title'] == null){
            return back()->withInput()->withErrors(['title'=>'标题不可为空']);
        }
        $post->title = $inputs['title'];
        if ($inputs['content'] == null){
            return back()->withInput()->withErrors(['title'=>'内容不可为空']);
        }
        $post->content = $inputs['content'];
        $post->save();

        return redirect('/news');
    }

    public function destroy($id)
    {
        $post = News::where('id',$id)->first();
        if (Gate::denies('create_news',Auth::user()))
        {
            return Redirect::back();
        }
        $post->delete();
        return back();
    }

    public function push($id)
    {
        $post = News::where('id',$id)->first();
        if(Gate::allows('create_news',Auth::user()))
        {
            $post->publish = 1;
            $post->save();
        }
        return back();
    }

    public function revoke($id)
    {
        $post = News::where('id',$id)->first();
        if (Gate::allows('create_news',Auth::user()))
        {
            $post->publish = 0;
            $post->save();
        }
        return back();
    }

}
