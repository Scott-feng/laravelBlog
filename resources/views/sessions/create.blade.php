@extends('layouts.app')
@section('title', '登录')

@section('content')
    <div class="col-md-offset-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>登录</h5>
                <a class="" href="{{ route('login.github') }}" title="github"><img src="http://podquousg.bkt.clouddn.com/github.png" alt="github" width="20"></a>
                <a class="" href="" title="weibo"><img src="http://podquousg.bkt.clouddn.com/%E5%BE%AE%E5%8D%9A.png" alt="weibo" width="20"></a>
                <a class="" href="" title="wechat"><img src="http://podquousg.bkt.clouddn.com/%E5%BE%AE%E4%BF%A1.png" alt="wechat" width="20"></a>

            </div>
            <div class="panel-body">
                @include('common.error')

                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码(<a href="{{ route('password.request') }}">忘记密码</a>)：</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="checkbox">
                        <label for=""><input type="checkbox" name="remember" id="">记住我</label>
                    </div>

                    <button type="submit" class="btn btn-primary">登录</button>
                </form>

                <hr>

                <p>还没账号？<a href="{{ route('users.create') }}">现在注册！</a></p>
            </div>
        </div>
    </div>
@stop