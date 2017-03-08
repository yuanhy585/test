<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/css/style.css" >
</head>
<body>
<div id="container">
    <div id="header">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed"
                            data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{ url('/') }}">
                        Test
                    </a>
                </div>

                <div class="collapse navbar-collapse">
                    @if(Auth::user())
                        <ul class="nav navbar-nav">
                            @if(Auth::user()->role_id > 2)
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                        用户管理<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="/users">用户管理</a></li>
                                        <li><a href="">组织结构管理</a></li>
                                        <li><a href="/usersImport">用户导入</a></li>
                                        <li><a href="">组织结构导入</a></li>
                                        <li><a href="">用户属性管理</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                        系统管理<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="">新闻管理</a></li>
                                        <li><a href="">调研管理</a></li>
                                        <li><a href="">资料库管理</a></li>
                                        <li><a href="">知识分享管理</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(Auth::user()->role_id > 1)
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                        学习管理<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="">课程管理</a></li>
                                        <li><a href="">考试管理</a></li>
                                        <li><a href="">题库管理</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(Auth::user()->role_id == 4)
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                        报表<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="/usersInfo">用户信息</a></li>
                                        <li><a href="">xxx</a></li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    @endif

                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li>
                                <div style="line-height:3.5em;">
                                    <a href="">中文</a>|
                                    <a href="">English</a>
                                </div>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/users/{{Auth::user()->id}}/myInfo">我的信息</a></li>
                                    <li><a href="">修改密码</a></li>
                                    <li><a href="{{ url('/logout') }}">退出</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div id="page" class="clearfix">
        @yield('content')
    </div>
</div>

<div id="footer" class="footer text-center">
    <footer>
        All Rights Reserved By YHY.
    </footer>
</div>

<div class="js">
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    @yield('js')
</div>

</body>
</html>
