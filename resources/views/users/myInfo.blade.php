@extends('layout')

@section('content')
<div class="container">
    <div class="page-title">
        我的信息
    </div><hr/>

    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>用户名</th>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <th>姓名</th>
                    <td>{{App\Profile::where('user_id',$id)->first()->real_name}}</td>
                </tr>
                <tr>
                    <th>角色</th>
                    <td>{{App\Role::where('id',$user->role_id)->first()->name}}</td>
                </tr>
                <tr>
                    <th>状态</th>
                    <td>{{App\Status::where('id',$user->status_id)->first()->name}}</td>
                </tr>
                <tr>
                    <th>语言</th>
                    <td>{{App\Language::where('id',$user->language_id)->first()->name}}</td>
                </tr>
                <tr>
                    <th>部门</th>
                    <td>{{App\Organization::where('id',$user->organization_id)->first()->name}}</td>
                </tr>
                <tr>
                    <th>邮箱</th>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <th>电话</th>
                    <td>{{App\Profile::where('user_id',$id)->first()->phone}}</td>
                </tr>
                <tr>
                    <th>地址</th>
                    <td>
                        {{App\Profile::where('user_id',$id)->first()->address}}
                    </td>
                </tr>
                <tr>
                    <th>备注</th>
                    <td>
                        {{App\Profile::where('user_id',$id)->first()->notes}}
                    </td>
                </tr>
                @if($user->profile->attribute1_id !=0)
                    <tr>
                        <th>{{$attribute->attr1_title}}</th>
                        <td>
                            {{App\FirstAttribute::where('id',$user->profile->attribute1_id)->first()->attriName}}
                        </td>
                    </tr>
                @endif
                @if($user->profile->attribute2_id !=0)
                    <tr>
                        <th>{{$attribute->attr2_title}}</th>
                        <td>
                            {{App\FirstAttribute::where('id',$user->profile->attribute2_id)->first()->attriName}}
                        </td>
                    </tr>
                @endif
                @if($user->profile->attribute3_id !=0)
                    <tr>
                        <th>{{$attribute->attr3_title}}</th>
                        <td>
                            {{App\FirstAttribute::where('id',$user->profile->attribute3_id)->first()->attriName}}
                        </td>
                    </tr>
                @endif

                @if($user->profile->attribute4_id !=0)
                    <tr>
                        <th>{{$attribute->attr4_title}}</th>
                        <td>
                            {{App\FirstAttribute::where('id',$user->profile->attribute4_id)->first()->attriName}}
                        </td>
                    </tr>
                @endif
                @if($user->profile->attribute5_id !=0)
                    <tr>
                        <th>{{$attribute->attr5_title}}</th>
                        <td>
                            {{App\FirstAttribute::where('id',$user->profile->attribute5_id)->first()->attriName}}
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
@stop