@extends('layouts.app')

@section('title','首页')

@section('css')
    <link rel="stylesheet" href="{{config('app.url')}}/X-admin/lib/layui/css/layui.css">
@endsection

@section('content')
    <div class="col-lg-8">
        <div class="layui-carousel" id="test1">
            <div carousel-item>
                <div><img src="http://tupian.aladd.net/2018/6/9/yueduzazhitupian2.jpg"></div>
                <div><img src="http://tupian.aladd.net/2018/6/9/yueduzazhitupian4.jpg"></div>
                <div><img src="http://tupian.aladd.net/2018/6/9/yueduzazhitupian3.jpg"></div>

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <p>banncer</p>

    </div>
@stop

@section('script')
    <script src="{{ config('app.url')}}/X-admin/lib/layui/layui.js"></script>
    <script>
        layui.use('carousel', function(){
            var carousel = layui.carousel;
            //建造实例
            carousel.render({
                elem: '#test1'
                ,width: '100%' //设置容器宽度
                ,arrow: 'always' //始终显示箭头
                // ,anim: 'updown' //切换动画方式
                ,interval: 7000,

            });
        });
    </script>
@endsection