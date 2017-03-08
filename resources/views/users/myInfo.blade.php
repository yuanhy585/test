@extends('layout')

@section('content')
<div class="container">
    <div class="page-title">
        我的信息
    </div><hr/>

    <div class="row">
        <div class="col-md-6">
            <table id="myInfo" class="table table-bordered table-striped">
                <tr>
                    <th>用户名:&nbsp;&nbsp;&nbsp;&nbsp;
                        {{$user->name}}
                    </th>
                </tr>
                <tr>
                    <th>
                        姓名:&nbsp;&nbsp;&nbsp;&nbsp;
                        {{App\Profile::where('user_id',$id)->first()->real_name}}
                    </th>
                </tr>
                <tr>
                    <th>
                        角色:&nbsp;&nbsp;&nbsp;&nbsp;
                        {{App\Role::where('id',$user->role_id)->first()->name}}
                    </th>
                </tr>
                <tr>
                    <th>
                        状态:&nbsp;&nbsp;&nbsp;&nbsp;
                        {{App\Status::where('id',$user->status_id)->first()->name}}
                    </th>
                </tr>
                <tr>
                    <th>
                        语言:&nbsp;&nbsp;&nbsp;&nbsp;
                        {{App\Language::where('id',$user->language_id)->first()->name}}
                    </th>
                </tr>
                <tr>
                    <th>
                        部门:&nbsp;&nbsp;&nbsp;&nbsp;
                        {{App\Organization::where('id',$user->organization_id)->first()->name}}
                    </th>
                </tr>
                <tr>
                    <th>
                        邮箱:&nbsp;&nbsp;&nbsp;&nbsp;
                        {{$user->email}}
                    </th>
                </tr>
                <tr>
                    <th>
                        电话:&nbsp;&nbsp;&nbsp;&nbsp;
                        {{App\Profile::where('user_id',$id)->first()->phone}}
                    </th>
                </tr>
                <tr>
                    <th>
                        地址:&nbsp;&nbsp;&nbsp;&nbsp;
                        {{App\Profile::where('user_id',$id)->first()->address}}
                    </th>
                </tr>
                <tr>
                    <th>
                        备注:&nbsp;&nbsp;&nbsp;&nbsp;
                        {{App\Profile::where('user_id',$id)->first()->notes}}
                    </th>
                </tr>
                @if($user->profile->attribute1_id !=0)
                    <tr>
                        <th>
                            {{$attribute->attr1_title}}:&nbsp;&nbsp;&nbsp;&nbsp;
                            {{App\FirstAttribute::where('id',$user->profile->attribute1_id)->first()->attriName}}
                        </th>
                    </tr>
                @endif
                @if($user->profile->attribute2_id !=0)
                    <tr>
                        <th>
                            {{$attribute->attr2_title}}:&nbsp;&nbsp;&nbsp;&nbsp;
                            {{App\FirstAttribute::where('id',$user->profile->attribute2_id)->first()->attriName}}
                        </th>
                    </tr>
                @endif
                @if($user->profile->attribute3_id !=0)
                    <tr>
                        <th>
                            {{$attribute->attr3_title}}:&nbsp;&nbsp;&nbsp;&nbsp;
                            {{App\FirstAttribute::where('id',$user->profile->attribute3_id)->first()->attriName}}
                        </th>
                    </tr>
                @endif

                @if($user->profile->attribute4_id !=0)
                    <tr>
                        <th>
                            {{$attribute->attr4_title}}:&nbsp;&nbsp;&nbsp;&nbsp;
                            {{App\FirstAttribute::where('id',$user->profile->attribute4_id)->first()->attriName}}
                        </th>
                    </tr>
                @endif
                @if($user->profile->attribute5_id !=0)
                    <tr>
                        <th>
                            {{$attribute->attr5_title}}:&nbsp;&nbsp;&nbsp;&nbsp;
                            {{App\FirstAttribute::where('id',$user->profile->attribute5_id)->first()->attriName}}
                        </th>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
@stop