<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<center>
    <h1>商品修改页面</h1>
    <form action="{{'/update/'.$GoodsInfo->goods_id}}" method="post" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <td>商品名称</td>
                <td><input type="text" name="goods_name" value="{{$GoodsInfo->goods_name}}"></td>
            </tr>
            <tr>
                <td>商品价格</td>
                <td><input type="text" name="goods_price"  value="{{$GoodsInfo->goods_price}}"></td>
            </tr>
            <tr>
                <td>商品图片</td>
                <td><img src="{{env('UPLOADS_URL')}}{{$GoodsInfo->goods_img}}" height="50px" width="50px">
                    <input type="file" name="goods_img">
                </td>
            </tr>
            <tr>
                <td>商品库存</td>
                <td><input type="text" name="goods_num" value="{{$GoodsInfo->goods_num}}"></td>
            </tr>
            <tr>
                <td>是否精品</td>
                <td><input type="radio" name="is_best" value="1" {{$GoodsInfo->is_best==1?"checked":''}}>是
                    <input type="radio" name="is_best" value="2" {{$GoodsInfo->is_best==2?"checked":''}}>否
                </td>
            </tr>
            <tr>
                <td>是否热卖</td>
                <td><input type="radio" name="is_hot" value="1" {{$GoodsInfo->is_hot==1?"checked":''}}>是
                    <input type="radio" name="is_hot" value="2" {{$GoodsInfo->is_hot==2?"checked":''}}>否
                </td>
            </tr>
            <tr>
                <td>是否上架</td>
                <td><input type="radio" name="is_up" value="1" {{$GoodsInfo->is_up==1?"checked":''}}>是
                    <input type="radio" name="is_up" value="2" {{$GoodsInfo->is_up==2?"checked":''}}>否
                </td>
            </tr>
            <tr>
                <td>商品介绍</td>
                <td><textarea name="goods_detail"  cols="30" rows="10">{{$GoodsInfo->goods_detail}}</textarea></td>
            </tr>
            <tr>
                <td>商品相册</td>
                <td>@if($GoodsInfo->goods_imgs)
                    @php $goods_imgs=explode('|',$GoodsInfo->goods_imgs) @endphp
                    @foreach($goods_imgs as $k=>$v)
                            <img src="{{env('UPLOADS_URL')}}{{$v}}" height="50px" width="50px">
                    @endforeach
                    @endif
                    <input type="file" name="goods_imgs[]" multiple></td>
            </tr>
            <tr>
                <td>商品分类</td>
                <td><select name="c_id">
                        <option value="">--请选择--</option>
                        @foreach($CateInfo as $k=>$v)
                            <option value="{{$v->c_id}}" {{$GoodsInfo->c_id==$v->c_id?'selected':''}}>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$v['level']) !!}{{$v->c_name}}</option>
                        @endforeach
                    </select></td>
            </tr>
            <tr>
                <td>商品品牌</td>
                <td><select name="b_id">
                        <option value="">--请选择--</option>
                        @foreach($BrandInfo as $k=>$v)
                            <option value="{{$v->b_id}}" {{$GoodsInfo->b_id==$v->b_id?"selected":''}}>{{$v->b_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="修改"></td>
            </tr>
        </table>
    </form>
</body>
</html>