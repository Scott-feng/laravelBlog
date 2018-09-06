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

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                                @if(Auth::user()->is_admin)
                                <span class="badge pull-right">VIP</span>
                                @endif
                                <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                            </span>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}">
                                    <form action="{{ route('logout') }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                                    </form>
                                </a>


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