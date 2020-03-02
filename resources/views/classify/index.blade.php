<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border=1>
        <tr>
            <td>分类ID</td>
            <td>分类名称</td>
            <td>父级分类</td>
            <td>分类描述</td>
            <td>操作</td>
        </tr>
        <tr>
        @foreach($data as $v)
            <td>{{$v->c_id}}</td>
            <td>{{$v->c_name}}</td>
            <td>{{str_repeat('|——',$v->level)}}{{$v->pid}}</td>
            <td>{{$v->c_detail}}</td>
            <td>
              <a href="{{url('classify/edit/'.$v->c_id)}}">编辑</a>|
              <a href="{{url('classify/destroy/'.$v->c_id)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>