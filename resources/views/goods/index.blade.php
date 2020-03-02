<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
<center>
<h1>商品展示页面</h1>
    <form>
    请输入商品名称:<input type="text" name="goods_name" value="{{$query['goods_name']??''}}" placeholder="请输入商品名称">
    请选择商品品牌: <select name="b_id">
                        <option value="">--请选择--</option>
                        @php $query=$query['b_id']??''; @endphp
                        @foreach($BrandInfo as $v)
                        <option value="{{$v->b_id}}" {{$query==$v->b_id?'selected':''}}>{{$v->b_name}}</option>
                        @endforeach
                    </select>
        <input type="submit" value="搜索">
    </form>
<table border="1px">
    <tr>
        <td>商品id</td>
        <td>商品名称</td>
        <td>商品价格</td>
        <td>商品图片</td>
        <td>商品库存</td>
        <td>是否热卖</td>
        <td>是否精品</td>
        <td>是否上架</td>
        <td>商品介绍</td>
        <td>商品相册</td>
        <td>商品品牌</td>
        <td>商品分类</td>
        <td>操作</td>
    </tr>
    @foreach($GoodsInfo as $k=>$v)
    <tr goods_id="{{$v->goods_id}}">
        <td>{{$v->goods_id}}</td>
        <td>{{$v->goods_name}}</td>
        <td>{{$v->goods_price}}</td>
        <td><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" height="50px" width="50px"></td>
        <td>{{$v->goods_num}}</td>
        <td>{{$v->is_hot==1?'√':'×'}}</td>
        <td>{{$v->is_best==1?'√':'×'}}</td>
        <td>{{$v->is_up==1?'√':'×'}}</td>
        <td>{{$v->goods_detail}}</td>
        <td>@if($v->goods_imgs)
            @php $goods_imgs=explode('|',$v->goods_imgs) @endphp
            @foreach($goods_imgs as $vv)
            <img src="{{env('UPLOADS_URL')}}{{$vv}}" height="50px" width="50px">
            @endforeach
            @endif
        </td>
        <td>{{$v->b_name}}</td>
        <td>{{$v->c_name}}</td>
        <td><a href="javascript:;" class="del">删除</a>
            <a href="/edit/{{$v->goods_id}}">修改</a>
        </td>
    </tr>
     @endforeach
</table>
    {{$GoodsInfo->appends('query')->links()}}
</body>
</html>
<script src="/jquery.min.js"></script>
<script>
    $(function(){
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $(document).on('click','.del',function(){
            var _this=$(this);
            var goods_id=_this.parents('tr').attr('goods_id');
            $.ajax({
                url:'/destroy',
                data:{goods_id:goods_id},
                type:'post',
                dataType:'json',
                success:function(res){
                    if(res.code==1){
                        _this.parents('tr').remove();
                        location.href='/index';
                    }else{
                        alert(res.font);
                    }
                }
            })
        })
    })
</script>