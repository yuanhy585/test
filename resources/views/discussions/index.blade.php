@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading page-title">
                讨论区
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    @foreach($posts as $id => $title)
                    <tr>
                        <td style="text-align: left;">
                            <a href="/post/{{$id}}">
                                {{$title}}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@stop