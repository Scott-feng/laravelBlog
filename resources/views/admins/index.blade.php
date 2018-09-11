<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <title>后台管理</title>
    <link rel="stylesheet" href="{{ config('app.url') }}/X-admin/css/font.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/X-admin/css/xadmin.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/X-admin/lib/layui/css/layui.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ config('app.url') }}/X-admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="{{ config('app.url') }}/X-admin/js/xadmin.js"></script>

</head>

<body>
<!-- 顶部开始 -->
<div class="container">
    <div class="logo"><a href="/">Scott BLOG</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>

    <ul class="layui-nav right" lay-filter="">
        @if(Auth::check())
        <li class="layui-nav-item">
            <a href="javascript:;">{{ Auth::user()->name }}</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        退出登录
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index"><a href="/">前台首页</a></li>
        @endif
    </ul>

</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>用户管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>

                <ul class="sub-menu">
                    <li>
                        <a _href="{{ route('admin_users.index') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>用户列表</cite>

                        </a>
                    </li >
                </ul>
            </li>

            {{--分类管理--}}
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe699;</i>
                    <cite>分类管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{ route('admin_category.index') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>分类列表</cite>

                        </a>
                    </li >
                </ul>
            </li>

            {{--文章管理--}}
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6fc;</i>
                    <cite>文章管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{ route('admin_topic.index') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>文章列表</cite>

                        </a>
                    </li >
                </ul>
            </li>

            {{--资源推荐--}}
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6f7;</i>
                    <cite>资源推荐</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{ route('admin_link.index') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>资源列表</cite>

                        </a>
                    </li >
                </ul>
            </li>


        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='{{ route('admin.welcome') }}' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="page-content-bg"></div>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
@include('admins._footer')

</body>
</html>