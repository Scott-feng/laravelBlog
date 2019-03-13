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
            <button class="layui-btn" onclick="x_admin_show('添加标签','{{ route('admin_tag.create') }}')"><i class="layui-icon"></i>添加
            </button>
        </xblock>
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i>
                    </div>
                </th>
                <th>标签ID</th>
                <th>标签名称</th>
                <th>操作</th>

            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{ $tag->id }}'><i class="layui-icon">&#xe605;</i></div>
                    </td>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->title }}</td>


                    <td class="td-manage">

                        <a title="编辑" onclick="x_admin_show('编辑','{{ route('admin_tag.edit',[$tag]) }}')" href="javascript:;">
                            <i class="layui-icon">&#xe642;</i>
                        </a>
                        <a title="删除" onclick="member_del(this,'{{ $tag->id }}')" href="javascript:;">
                            <i class="layui-icon">&#xe640;</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{--paginator--}}
        {!! $tags->links() !!}

    </div>

    <script>
        layui.use('laydate', function () {
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
        });



        /*分类-删除*/
        function member_del(obj, id) {
            layer.confirm('确认要删除吗？', function (index) {
                //发异步删除数据
                $.ajax({

                    type: "DELETE",
                    url: 'tags/'+id,
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


        function delAll(argument) {

            var data = tableCheck.getData();

            layer.confirm('确认要删除吗？' + data, function (index) {
                $.ajax({
                    type: 'GET',
                    url: 'tags/destroyAll',
                    data: {
                        '_token':'{{ csrf_token() }}',
                        'tags_list':JSON.stringify(data)
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