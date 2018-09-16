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
            {{--
            <button class="layui-btn" onclick="x_admin_show('添加用户','./admin-add.html')"><i class="layui-icon"></i>添加
            </button>
            --}}
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
                <th>用户名</th>
                <th>邮箱</th>
                <th>角色</th>
                <th>注册时间</th>
                <th>操作</th>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{ $user->id }}'><i class="layui-icon">&#xe605;</i></div>
                    </td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? '管理员':'普通用户' }}</td>
                    <td>{{ $user->created_at }}</td>

                    @if($user->id != 1)
                    <td class="td-manage">


                        <a title="编辑" onclick="x_admin_show('编辑','{{ route('admin_users.display',[$user]) }}')" href="javascript:;">
                            <i class="layui-icon">&#xe642;</i>
                        </a>
                        <a title="删除" onclick="member_del(this,'{{ $user->id }}')" href="javascript:;">
                            <i class="layui-icon">&#xe640;</i>
                        </a>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>

        {{--paginator--}}
        {!! $users->links() !!}

    </div>

    <script>

        /*用户-删除*/
        function member_del(obj, id) {
            var user_id=id;
            layer.confirm('确认要删除吗？', function (index) {
                //发异步删除数据
                $.ajax({

                    type: "DELETE",
                    url: 'users/'+id,
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
                        layer.msg(data.msg, {icon: 5, time: 1000});
                    }
                });

            });
        }

        //批量删除
        function delAll(argument) {

            var data = tableCheck.getData();

            console.log(data);
            // console.log(JSON.stringify(data));

            layer.confirm('确认要删除吗？' + data, function (index) {
                //捉到所有被选中的，发异步进行删除
                $.ajax({
                    type: 'GET',
                    url: 'users/destroyAll',
                    data: {
                        '_token':'{{ csrf_token() }}',
                        'user_list':JSON.stringify(data)
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