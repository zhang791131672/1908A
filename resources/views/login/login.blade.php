<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<center>
<h1>登录页面</h1>
    <b style="color:red">{{ session('msg') }} </b>
    <form action="{{('/logindo')}}" method="post">
        @csrf
        <table>
            <tr>
                <td>用户名</td>
                <td><input type="text" name="admin_user" placeholder="请输入用户名"></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="admin_pwd" placeholder="请输入密码"></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" value="登录"></td>
            </tr>
        </table>
    </form>
</body>
</html>