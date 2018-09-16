<!DOCTYPE html>
<html>
    @include('admins._head')
    <body>
    <div class="x-body layui-anim layui-anim-up">
        <blockquote class="layui-elem-quote">欢迎尊贵的管理员:
            <span class="x-red">{{ Auth::user()->name }}</span>！{{ date('Y-m-d') }}</blockquote>
        <fieldset class="layui-elem-field">
            <legend>系统信息</legend>
            <div class="layui-field-box">
                <table class="layui-table">

                        <tr>
                            <th>服务器信息</th>
                            <td>{{ Sysinfo::server() }}</td></tr>
                        <tr>
                            <th>服务器ip</th>
                            <td>{{ Sysinfo::ip() }}</td></tr>
                        <tr>
                            <th>CPU信息</th>
                            <td>{{ Sysinfo::cpu() }}</td></tr>
                        <tr>
                            <th>总内存信息</th>
                            <td>{{ Sysinfo::memory() }}</td></tr>
                        <tr>
                            <th>PHP版本</th>
                            <td>{{ Sysinfo::php() }}</td></tr>

                      
                        <tr>
                            <th>上传附件限制</th>
                            <td>{{ Sysinfo::upload_max_filesize() }}</td></tr>
                        <tr>
                            <th>php版本信息</th>
                            <td>{{ Sysinfo::php() }}</td></tr>
                        <tr>
                            <th>laravel 版本</th>
                            <td>{{ Sysinfo::laraver() }}</td>
                        </tr>

                        <tr>
                            <th>时区信息</th>
                            <td>{{ Sysinfo::timezone() }}</td>
                        </tr>

                </table>
            </div>
        </fieldset>
        <fieldset class="layui-elem-field">
            <legend>开发团队</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>
                        <tr>
                            <th>版权所有</th>
                            <td>
                                ©2017 Scott
                            </td>
                        </tr>
                        <tr>
                            <th>开发者</th>
                            <td>Scott</td></tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
    </body>
</html>