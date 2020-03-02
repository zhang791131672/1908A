<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="static/css/bootstrap.min.css">  
	<script src="static/js/jquery.min.js"></script>
	<script src="static/js/bootstrap.min.js"></script>
</head>
<body>
<h1>管理员展示列表</h1>

<table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>管理员id</th>
			<th>用户名</th>
			<th>密码</th>
			
			<th>头像</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_user}}</td>
			<td>{{$v->admin_pwd}}</td>
			
			<td>@if($v->admin_img)<img src="{{env('UPLOADS_URL')}}{{$v->admin_img}}" width="50" height="50">@endif</td>
			
			<td><a href="{{url('admin/edit/'.$v->admin_id)}}" class="btn btn-info">编辑</a>
				<a href="{{url('admin/destroy/'.$v->admin_id)}}" class="btn btn-danger">删除</a></td>
		</tr>
		@endforeach
		
	</tbody>
</table>

</body>
</html>