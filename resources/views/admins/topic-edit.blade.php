<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--csrf token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--styles--}}
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/X-admin/lib/layui/css/layui.css">

    <title>编辑文章-{{ $topic->title }}</title>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="{{ config('app.url') }}/X-admin/lib/layui/layui.js" charset="utf-8"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    {!! editor_css() !!}
    {{--<link rel="stylesheet" href="{{ config('app.url') }}/css/editormd.css">--}}
</head>
<body>
<div id="app" class="{{ route_class() }}-page">
    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <h2 class="text-center">
                        <i class="glyphicon glyphicon-edit"></i>
                        修改文章
                    </h2>

                    <hr>

                    @include('common.error')

                    <form class="layui-form">

                        <div class="layui-form-item">
                            <input class="layui-input" type="text" name="title" id="title" value="{{ old('title',$topic->title) }}" placeholder="请填写标题" lay-verify="required">

                        </div>

                        <div class="layui-form-item">
                            <select class="layui-input" name="category_id" required id="cate">
                                <option value="" hidden disabled selected>请选择分类</option>
                                @foreach ($categories as $value)
                                    <option value="{{ $value->id }}" {{ $topic->category_id == $value->id ? "selected":"" }}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="layui-form-item">
                            <div id="editormd_id" class="layui-input">
                                <textarea name="content" id="markdown" style="display:none;">{!! $topic->body !!}</textarea>
                            </div>
                        </div>

                        <div class="well well-sm">
                            <button type="button" class="btn btn-primary" lay-filter="add" lay-submit=""><span
                                        class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


{{--scripts--}}
<script src="{{ config('app.url') }}/X-admin/lib/layui/layui.js" charset="utf-8"></script>
{!! editor_js() !!}

{{--
<script src="/vendor/editormd/js/editormd.js"></script>
<script src="/vendor/editormd/lib/marked.min.js"></script>
<script src="/vendor/editormd/lib/prettify.min.js"></script>
<script src="/vendor/editormd/lib/raphael.min.js"></script>
<script src="/vendor/editormd/lib/underscore.min.js"></script>
<script src="/vendor/editormd/lib/sequence-diagram.min.js"></script>
<script src="/vendor/editormd/lib/flowchart.min.js"></script>
<script src="/vendor/editormd/lib/jquery.flowchart.min.js"></script>


<script>

    var testEditor;
    $(function () {
        editormd.emoji = {
            path: "//staticfile.qnssl.com/emoji-cheat-sheet/1.0.0/",
            ext: ".png"
        };
        testEditor = editormd({
            id: "editormd_id",
            width: "100%",
            height:700,
            theme: "default",
            editorTheme:"default",
            previewTheme:"default",
            path: '/vendor/editormd/lib/',
            codeFold:true,
            saveHTMLToTextarea: true,
            searchReplace: true,
            emoji: true,
            taskList: true,
            tocm: true,
            tex: true,
            flowChart: true,
            sequenceDiagram: true,
            imageUpload: true,
            imageFormats:["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL: "/larvelchen/upload/editormd/image?token=YEQr8bsd5HI54xUTQmwycrmcjgtSP0r0tn9n8kWV",
        });
    })

    layui.use(['form', 'layer'], function () {
        $ = layui.jquery;
        var form = layui.form
            , layer = layui.layer;
        //监听提交
        form.on('submit(add)', function (data) {
            // console.log(data);
            //发异步，把数据提交给php
            $.ajax({

                type: "PATCH",
                url: "{{ route('admin_topic.update',[$topic->id]) }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'title': $('#title').val(),
                    'body': testEditor.getMarkdown(),
                    'category_id': $('#cate').val()
                },
                success: function (data) {
                    // console.log('Success', data);
                    // console.log('body markdown: ',testEditor.getMarkdown());

                    // layer.msg(data.msg);
                    layer.alert(data.msg, {icon: 6});
                    // return false;
                },

                error: function (data) {
                    console.log('Error:', data);
                    layer.alert('更新失败', {icon: 5});

                }
            });

        });
    });


</script>
--}}

</body>
</html>
