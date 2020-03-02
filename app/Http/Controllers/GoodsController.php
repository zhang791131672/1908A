<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Brand;
use App\Cate;
class GoodsController extends Controller
{
    //
    function index()
    {
        $goods_name=request()->goods_name??'';
        $b_id=request()->b_id??'';
        $where=[];
        if($goods_name){
            $where[]=['goods_name','like',"%".$goods_name."%"];
        }
        if($b_id){
            $where[]=['goods.b_id','=',$b_id];
        }
        $BrandInfo=Brand::get();
        $pagesize=config('app.pagesize');
            $GoodsInfo=Goods::
                        leftjoin('cate','goods.c_id','=','cate.c_id')
                        ->leftjoin('brand','goods.b_id','=','brand.b_id')
                        ->where($where)
                        ->paginate($pagesize);
            return view('goods.index',['GoodsInfo'=>$GoodsInfo,'BrandInfo'=>$BrandInfo,'query'=>request()->all()]);
    }

        function create()
        {
            $BrandInfo = Brand::get();
            $CateInfo = Cate::get();
            $CateInfo = $this->getCateInfo($CateInfo);
            return view('goods.create', ['BrandInfo' => $BrandInfo, 'CateInfo' => $CateInfo]);
        }

        function store(Request $request)
        {
            $data = $request->except('_token');
            if ($request->hasFile('goods_img')) { //
               $data['goods_img']=$this->upload('goods_img');
            }
            if(isset($data['goods_imgs'])){
                $data['goods_imgs']=$this->Moreupload('goods_imgs');
                $data['goods_imgs']=implode('|',$data['goods_imgs']);
            }
            $data=Goods::create($data);
            if($data){
                return redirect('/index');
            }
        }

        function destroy()
        {
            $goods_id=request()->goods_id;
            $res=Goods::destroy($goods_id);
            if($res){
                echo json_encode(['code'=>1,'font'=>"删除成功"]);
            }else{
                echo json_encode(['code'=>2,'font'=>"删除失败"]);
            }
        }

        function edit($id)
        {
            $BrandInfo = Brand::get();
            $CateInfo = Cate::get();
            $CateInfo = $this->getCateInfo($CateInfo);
            $GoodsInfo=Goods::find($id);
            return  view('goods.edit',['GoodsInfo'=>$GoodsInfo,'BrandInfo' => $BrandInfo,'CateInfo' => $CateInfo]);
        }

        function update(Request $request, $id)
        {
            $data=$request->except('_token');
            if ($request->hasFile('goods_img')) { //
                $data['goods_img']=$this->upload('goods_img');
            }
            if(isset($data['goods_imgs'])){
                $data['goods_imgs']=$this->Moreupload('goods_imgs');
                $data['goods_imgs']=implode('|',$data['goods_imgs']);
            }
            $res=Goods::where('goods_id','=',$id)->update($data);
            if($res!==false){
                return redirect('/index');
            }
        }

        function upload($filename){
            if (request()->file($filename)->isValid()){
                $photo = request()->file($filename);
                $store_result = $photo->store('uploads');
                return $store_result;
            }
            exit('未获取到上传文件或上传过程出错');
        }

        function getCateInfo($data, $pid = 0, $level = 1)
        {
            if (!$data) {
                return;
            }
            static $arr = [];
            foreach ($data as $k => $v) {
                if ($v->pid == $pid) {
                    $v->level = $level;
                    $arr[] = $v;
                    $this->getCateInfo($data, $v->c_id, $level + 1);
                }
            }
            return $arr;
        }

    function Moreupload($filename){
        $photo=request()->file($filename);
        if(!is_array($photo)){
            return;
        }
        foreach($photo as $v){
            if($v->isValid()){
                $store_result[]=$v->store('uploads');
            }
        }
        return $store_result;
    }
}
