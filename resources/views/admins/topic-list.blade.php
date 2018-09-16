@extends('admins.default')

@section('content')
    <div class="x-nav">
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
           href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>

    <div class="x-body">
        <div class="layui-row">

        </div>
        <xblock>
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
            <a href="{{ route('admin_topic.create') }}" target="_blank">
            <button class="layui-btn" ><i class="layui-icon"></i>添加
            </button>
            </a>
            {{--<span class="x-right" style="line-height:40px">共有数据:{{ $users->count() }} 条</span>--}}
        </xblock>
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i>
                    </div>
                </th>
                <th>ID</th>
                <th>文章标题</th>
                <th>作者</th>
                <th>分类</th>
                <th>更新时间</th>
                <th>操作</th>
            </thead>
            <tbody>
            @foreach($topics as $topic)
                <tr>
                    <td>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{ $topic->id }}'><i class="layui-icon">&#xe605;</i></div>
                    </td>
                    <td>{{ $topic->id }}</td>
                    <td>{{ $topic->title }}</td>
                    <td>{{ $topic->user->name }}</td>
                    <td>{{ $topic->category->name }}</td>
                    <td>{{ $topic->updated_at }}</td>

                    <td class="td-manage">

                        <a title="编辑" href="{{ route('admin_topic.edit',[$topic]) }}" target="_blank" >
                            <i class="layui-icon">&#xe642;</i>
                        </a>
                        <a title="删除" onclick="member_del(this,'{{ $topic->id }}')" href="javascript:;">
                            <i class="layui-icon">&#xe640;</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{--paginator--}}
        {!! $topics->links() !!}

    </div>

    <script>
        layui.use('layer', function () {
            $ = layui.jquery;
            layer = layui.layer;
        });



        /*用户-删除*/
        function member_del(obj, id) {
            layer.confirm('确认要删除吗？', function (index) {
                $.ajax({

                    type: "DELETE",
                    url: 'topics/'+id,
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (data) {
                        console.log(data);
                        $(obj).parents("tr").remove();
                        layer.msg(data.msg, {icon: 1, time: 1000});
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        layer.msg("删除失败", {icon: 5, time: 1000});
                    }
                });

            });
        }

        //批量删除
        function delAll(argument) {

            var data = tableCheck.getData();

            layer.confirm('确认要删除吗？' + data, function (index) {
                $.ajax({
                    type: 'GET',
                    url: 'topics/destroyAll',
                    data: {
                        '_token':'{{ csrf_token() }}',
                        'topics_list':JSON.stringify(data)
                    },
                    success :function(data){
                        console.log(data);
                        layer.msg(data.msg, {icon: 1});
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                    },
                    error:function (data) {
                        console.log('Error:', data);
                        layer.msg(data.msg, {icon: 5, time: 1000});
                    }


                });

            });
        }


    </script>

@stop