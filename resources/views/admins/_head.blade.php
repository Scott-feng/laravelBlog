<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>后台管理</title>
    <link rel="stylesheet" href="{{ config('app.url') }}/X-admin/css/font.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/X-admin/css/xadmin.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/X-admin/lib/layui/css/layui.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ config('app.url') }}/X-admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="{{ config('app.url') }}/X-admin/js/xadmin.js"></script>

</head>