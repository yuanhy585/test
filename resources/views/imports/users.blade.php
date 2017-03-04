@extends('layout')

@section('js')
<script>
    $(function(){
        $("[data-toggle = 'tooltip']").tooltip();
    });
</script>
@append

@section('content')
<div class="container">
    <div class="row">
        <div class="page-title">
            用户导入
            <a href="" class="tooltip-show" data-toggle="tooltip" data-placement="right"
               title="此功能为用户导入功能，请点击导出模板，
                        并仔细阅读模板中的填写说明，填写后上传，创建用户信息，
                        该功能仅支持.xls(excel2007)文件">
                <span class="glyphicon glyphicon-question-sign"></span>
            </a>
        </div><hr/>

        <div class="form" style="margin:50px 0 20px 0;float:right;">
            <form class="form-group" action="/usersImport" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-inline">

                @include('imports.import')

                    <a href="/usersExample" class="btn btn-primary">
                        导出模板
                    </a>
                </div>
            </form>
            {!! errors_for('file',$errors) !!}
        </div>

        <div class="table">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>文件名</th>
                    <th>创建时间</th>
                    <th>用户</th>
                    <th>日志</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($imports as $import)
                    <tr>
                        <td>{{$import->file_name}}</td>
                        <td>{{$import->created_at}}</td>
                        <td>{{App\Profile::where('user_id',$import->user_id)->first()->real_name}}</td>
                        <td>
                            <a href="" style="text-decoration: none;">查看</a>
                        </td>
                        <td>
                            <a class="btn btn-success" style="margin-right: 20px;"
                               href="/importLog/{{$import->id}}/download">
                                下载
                            </a>
                            <a class="btn btn-danger" href="">
                                删除
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop