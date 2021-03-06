@extends('admins.modal')

@section('content')
    <div class="x-body">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="cateName" class="layui-form-label">
                    <span class="x-red">*</span>分类名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="cate_name" name="cate_name" required="" lay-verify="required"
                           autocomplete="off" value="" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">至少两个字符</div>
            </div>

            <div class="layui-form-item">
                <label for="cateName" class="layui-form-label">
                    <span class="x-red">*</span>分类描述
                </label>
                <div class="layui-input-inline">
                    <input type="text" value="" id="cate_desc" name="cate_desc" required=""
                           lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">至少两个字符</div>
            </div>



            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button class="layui-btn" lay-filter="add" lay-submit="" type="button">
                    保存
                </button>
            </div>
        </form>
    </div>

    <script>
        layui.use(['form', 'layer'], function () {
            $ = layui.jquery;
            var form = layui.form
                ,layer = layui.layer;

            //监听提交
            form.on('submit(add)', function (data) {
                console.log(data);
                var is_admin = $("input[type='radio']:checked").val();
                //发异步，把数据提交给php
                $.ajax({

                    type: "POST",
                    url: "{{ route('admin_category.store') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'name':$('#cate_name').val(),
                        'description':$('#cate_desc').val()
                    },
                    success: function (data) {
                        console.log('Success',data);

                        // layer.msg(data.msg);
                        layer.alert(data.msg, {icon: 6},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                        });
                        // return false;
                    },

                    error: function (data) {
                        console.log('Error:', data);
                        layer.alert('更新失败',{icon:5},function () {
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                        });

                    }
                });

            });



        });
    </script>
@stop
