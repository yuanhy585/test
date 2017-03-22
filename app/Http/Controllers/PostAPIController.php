<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostAPIController extends Controller
{
    public function getPosts(Request $request)
    {
        $user_id = $request->get('user_id');
        $count = User::where('id',$user_id)->count();

        if ($count == 0)
        {
            $rtn = 101;
            $message = "无此人信息，无法登录";
            $response = ['code'=>$rtn,'message'=>$message,'data'=>[]];
        }
        else
        {
            Auth::loginUsingId($user_id);
            $datas = array();
            $posts = Post::all();

            foreach ($posts as $post)
            {
                $data['post_id'] = $post->id;
                $data['title'] = $post->title;
                $data['content'] = $post->content;
                $data['user_id'] = $post->user_id;

                $datas[] = $data;
            }

            $rtn = 100;
            $message = "文章列表获取成功";
            $response = ['code'=>$rtn,'message'=>$message,'data'=>$datas];
        }
        return response()->json($response);
    }
}
