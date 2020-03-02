<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>分类修改</h1>
    <form action="{{url('/classify/update/'.$data->c_id)}}" method="post">
    @csrf
       分类名称: <input type="text" name="c_name" value="{{$data->c_name}}"><br>
       父级分类:  <select name="pid" id="">
                   @foreach($res as $v)
                   <option value="{{$v->c_id}}" {{$data->c_id==$v->c_id ? 'selected' : ''}}>
                   
                   {{str_repeat('|——',$v->level)}}{{$v->c_name}}</option>
                   @endforeach
               </select><br>
       描述 :   <textarea name="c_detail" id="" cols="30" rows="10">{{$data->c_detail}}</textarea><br>
                <input type="submit" value="修改">     
    </form>
</body>
</html>