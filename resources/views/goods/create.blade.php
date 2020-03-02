<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<center>
<h1>商品添加页面</h1>
<form action="{{'/store'}}" method="post" enctype="multipart/form-data">
    @csrf
    <table>
        <tr>
            <td>商品名称</td>
            <td><input type="text" name="goods_name"></td>
        </tr>
        <tr>
            <td>商品价格</td>
            <td><input type="text" name="goods_price"></td>
        </tr>
        <tr>
            <td>商品图片</td>
            <td><input type="file" name="goods_img"></td>
        </tr>
        <tr>
            <td>商品库存</td>
            <td><input type="text" name="goods_num"></td>
        </tr>
        <tr>
            <td>是否精品</td>
            <td><input type="radio" name="is_best" value="1" checked>是
                <input type="radio" name="is_best" value="2">否
            </td>
        </tr>
        <tr>
            <td>是否热卖</td>
            <td><input type="radio" name="is_hot" value="1" checked>是
                <input type="radio" name="is_hot" value="2">否
            </td>
        </tr>
        <tr>
            <td>是否上架</td>
            <td><input type="radio" name="is_up" value="1" checked>是
                <input type="radio" name="is_up" value="2">否
            </td>
        </tr>
        <tr>
            <td>商品介绍</td>
            <td><textarea name="goods_detail"  cols="30" rows="10"></textarea></td>
        </tr>
        <tr>
            <td>商品相册</td>
            <td><input type="file" name="goods_imgs[]" multiple></td>
        </tr>
        <tr>
            <td>商品分类</td>
            <td><select name="c_id">
                    <option value="">--请选择--</option>
                    @foreach($CateInfo as $k=>$v)
                    <option value="{{$v->c_id}}">{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$v['level']) !!}{{$v->c_name}}</option>
                    @endforeach
                </select></td>
        </tr>
        <tr>
            <td>商品品牌</td>
            <td><select name="b_id">
                    <option value="">--请选择--</option>
                    @foreach($BrandInfo as $k=>$v)
                    <option value="{{$v->b_id}}">{{$v->b_name}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="添加"></td>
        </tr>
    </table>
</form>
</body>
</html>