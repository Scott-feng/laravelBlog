@extends('layouts.app')

@section('title','首页')

@section('css')
    <link rel="stylesheet" href="{{config('app.url')}}/X-admin/lib/layui/css/layui.css">
@endsection

@section('content')
    <div class="col-lg-8">
        <div class="layui-carousel" id="test1">
        <div carousel-item>
            <div>
                <img src="{{ config('app.url') }}/image/banner3.jpg" alt="">
            </div>
            <div>
                <img src="{{ config('app.url') }}/image/banner4.jpg" alt="">
            </div>
        </div>
        {{--<img src="{{ config('app.url') }}/image/banner3.jpg" alt="" style="width: 700">--}}
    </div>
    </div>

    <div class="col-lg-4">
        <fieldset class="layui-elem-field">
            <legend><strong>木兰花·拟古决绝词柬友</strong></legend>
            <div class="layui-field-box">

                人生若只如初见，何事秋风悲画扇。
                等闲变却故人心，却道故人心易变。
                骊山语罢清宵半，泪雨零铃终不怨。
                何如薄幸锦衣郎，比翼连枝当日愿。
            </div>
        </fieldset>

        <fieldset class="layui-elem-field">
            <legend><strong>蝶恋花</strong></legend>
            <div class="layui-field-box">

                槛菊愁烟兰泣露，罗幕轻寒，燕子双飞去。明月不谙离恨苦，斜光到晓穿朱户。
                昨夜西风凋碧树，独上高楼，望尽天涯路。欲寄彩笺兼尺素，山长水阔知何处？
            </div>
        </fieldset>

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
                ,interval: 7000
                ,height:'400px'

            });
        });
        layui.use('flow', function(){
            var flow = layui.flow;
            //信息流

            //图片懒加载
            flow.lazyimg();
        });
    </script>
@endsection