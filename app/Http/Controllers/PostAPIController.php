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

    public function createPost(Request $request)
    {
        $inputs = $request->all();
        $id = $request->get('id');
        $count = User::where('id',$id)->where('role_id','>',1)->count();
        if ($count == 0)
        {
            $rtn = 101;
            $message = "无此人信息，无法登录";
            $response = ['code'=>$rtn, 'message'=>$message];
        }
        else
        {
            Auth::loginUsingId($id);

            $post = new Post();
            if ($inputs['title'] == null)
            {
                return "标题不可为空";
            }
            $post->title = $inputs['title'];
            if ($inputs['content'] == null)
            {
                return "内容不可为空";
            }
            $post->content = $inputs['content'];
            $post->user_id = $inputs['id'];

            $post->save();

            $rtn = 100;
            $message = "创建成功";
            $response = ['code' => $rtn, 'message'=>$message];
        }

        return response()->json($response);
    }

    public function updatePost(Request $request)
    {
        $inputs = $request->all();
        $id = $request->get('id');
        $count = User::where('id',$id)->where('role_id', '>', 1)->count();
        $user = User::where('id',$id)->first();
        $post_id = $request->get('post_id');
        $post = Post::where('id',$post_id)->first();

        if ($count == 0)
        {
            $rtn = 101;
            $message = "无此人信息，无法登录";
            $response = ['code'=>$rtn, 'message'=>$message];
        }
        else
        {
            Auth::loginUsingId($id);
            if (($id == $post->user_id) || ($user->role_id > 3))
            {
                $post = Post::where('id',$post_id)->first();
                if ($inputs['title'] == null)
                {
                    return "标题不可为空";
                }
                $post->title = $inputs['title'];
                if ($inputs['content'] == null)
                {
                    return "内容不可为空";
                }
                $post->content = $inputs['content'];
                $post->save();

                $rtn = 100;
                $message = "修改成功";
                $response = ['code'=>$rtn, 'message'=>$message];
            }
            else
            {
                $rtn = 102;
                $message = "抱歉，您对此文章无修改权限";
                $response = ['code'=>$rtn,'message'=>$message];
            }
        }
        return response()->json($response);
    }

    public function deletePost(Request $request)
    {
        //其他接口也有这样问题
        $post_id = $request->get('post_id');
        $user_id = $request->get('user_id');
//        $count = User::where('id',$user_id)->where('role_id', '>', 1)->count();
//        $count = User::where('id',$user_id)->count();不需要，直接下面一行代码就行了
        $user = User::where('id',$user_id)->first();
        $post = Post::where('id',$post_id)->first();

//        if ($count == 0)
        if (!$user)
        {
            $rtn = 101;
            $message = "无此人信息，无法登录";
            $response = ['code'=>$rtn, 'message'=>$message];
        }
        else
        {
            Auth::loginUsingId($user_id);
            //这里应该判断是否有这篇文章
            if(!empty($post))
            {
                if (($user_id == $post->user_id) || ($user->role_id > 3))
                {
//                $post = Post::where('id',$post_id)->first();这一块重复获取
                    $post->delete();
                }

                $rtn = 100;
                $message = "删除成功";
                $response = ['code'=>$rtn, 'message'=>$message];
            }else
            {
                $rtn = 100;
                $message = "文章不存在";
                $response = ['code'=>$rtn, 'message'=>$message];
            }



        }

        return response()->json($response);
    }

}
