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
<h1>添加管理员</h1>
<form action="{{url('/admin/store')}}"  method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户名</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入用户名" name="admin_user">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入密码" name="admin_pwd">
		</div>
	</div>
		<div class="form-group">
		<label class="sr-only" for="inputfile">头像</label>
		<input type="file" id="inputfile" name="admin_img">
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>
