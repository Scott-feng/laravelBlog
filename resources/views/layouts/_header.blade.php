<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Scott BLOG
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">首页</a></li>
                <li><a href="{{ route('topics.index') }}">最新文章</a></li>
                {{--<li><a href="javascript:;">文章分类</a></li>--}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        文章分类
                        <b class="caret"></b>
                    </a>

                    <ul class="dropdown-menu">
                        @foreach(\App\Models\Category::all() as $item)
                        <li><a href="{{ route('categories.show',[$item->id]) }}">{{ $item->name }}</a></li>

                        @endforeach
                    </ul>
                </li>
                <li><a href="{{ url('/about') }}">关于</a></li>


            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">

                                @if(Auth::user()->is_admin)
                                {{--<span class="badge pull-right">VIP</span>--}}
                                <span class="pull-right"><img src="{{ config('app.url') }}/image/vip.png" alt="" class="img-thumbnail img-responsive" style="height: 40px;margin-left: 5px;"></span>
                                @endif
                                <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="40px" height="40px">
                            </span>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    退出登录
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>


                            </li>
                            <li>
                                <a href="{{ route('users.show',[Auth::user()]) }}">个人中心</a>
                            </li>

                            <li>
                                <a href="{{ route('users.edit',Auth::id()) }}">
                                    编辑资料
                                </a>
                            </li>

                            {{--only admin user will see--}}
                            @if(Auth::user()->is_admin)
                            <li>
                                <a href="{{ route('admin') }}">
                                    后台管理
                                </a>
                            </li>
                            @endif

                        </ul>
                    </li>
                @else

                    <!-- Authentication Links -->
                    <li><a href="{{ route('login') }}">登录</a></li>
                    <li><a href="{{ route('users.create') }}">注册</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
