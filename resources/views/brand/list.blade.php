
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>品牌列表展示</h1></center>
<form action="">
 品牌名称：<input type="text" name="b_name" value="{{$b_name}}" placeholder="请输入品牌名称">
 <input type="submit" value="搜索">
</form>
<table class="table">
  
  <thead>
       <tr>
           <th>ID</th>
           <th>品牌名称</th>
           <th>品牌LOGO</th>
           <th>品牌描述</th>
           <th>操作</th>
       </tr>
  </thead>
  <tbody>
      @foreach($data as $k=>$v)
       <tr @if($k%2==0) class="success" @else class="active" @endif>
           <td>{{$v->b_id}}</td>
           <td>{{$v->b_name}}</td>
           <td>@if($v->b_logo)<img src="{{env('UPLOADS_URL')}}{{$v->b_logo}}" width="30" height="30">@endif</td>
           <td>{{$v->b_desc}}</td>
           <td> <a href="{{url('brand/edit/'.$v->b_id)}}" class="btn btn-info">编辑</a> <a href="{{url('brand/destroy/'.$v->b_id)}}" class="btn btn-danger">删除</a></td>
       </tr>
       @endforeach
       <tr><td colsapn="7">{{$data->appends(['b_name'=>$b_name])->links()}}</td></tr>
  </tbody>
</table>
</body>
<ml>
<script>
$(document).on('click','.pagination a',function(){
  var url=$(this).attr('href');
  //console.log(url);
  if(!url){
       return;
  }
  $.get(url,function(res){
    $('tbody').html(res);
  })
  return false;
})
</script>