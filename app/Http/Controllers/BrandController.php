<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $b_name = request()->b_name??'';
        $where = [];
        if($b_name){
           $where[] = ['b_name','like',"%$b_name%"];
        }
        $data = Brand::where($where)->paginate(1);
        if(request()->ajax()){
            return view('brand.ajaxPage',['data'=>$data,'b_name'=>$b_name]);

         }
        return view('brand.list',['data'=>$data,'b_name'=>$b_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $validator = Validator::make($data,[
            'b_name' => 'required|unique:brand',
           
            'b_logo' => 'required',
            'b_desc' => 'required',
           

           ],[
            'b_name.required'=>'品牌名称不能为空',
           
            'b_name.unique'=>'品牌名称已存在',
            'b_logo.required'=>'品牌图片不能为空',
            'b_desc.required'=>'品牌描述不能为空',

         ]);
         if($validator->fails()){
           return redirect('brand/create')
           ->withErrors($validator)
           ->withInput();
         }
        // dd($data);
         //上传文件
         if($request->hasFile('b_logo')){
            $data['b_logo'] = $this->upload('b_logo');
          }
          $res = Brand::create($data);
          if($res){
             return redirect('/brand');
          }
    }
    //上传图片
    public function upload($filename){
        //判断上传是否有错误
        if(request()->file($filename)->isValid()){
           //接受值
          $photo = request()->file($filename);
           //上传
           $store_result = $photo->store('uploads');
           return $store_result;
       }
       exit('未获取到上传文件或上传过程出错');
   }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res = Brand::find($id);

        return view('brand.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->except('_token');
        if($request->hasFile('b_logo')){
           $data['b_logo'] = $this->upload('b_logo');
         }
       $res = Brand::where('b_id',$id)->update($data);
       if($res!==false){
          return redirect('/brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Brand::where('b_id',$id)->delete();
        if($res){
            return redirect('/brand');
          } 
    }
}
