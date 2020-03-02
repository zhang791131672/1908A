<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classify;
class ClassifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Classify::get();
        //dd($data);
        return view('classify.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $classify = Classify::all();
        //dd($classify);
        $classify = $this->CreateTree($classify);
        //dd($classify);
        return view('classify.create',['classify'=>$classify]);
    }

    public function CreateTree($data,$parent_id=0,$level=1){
        if(!$data){
          return;
        }
        static $newarray = [];
        foreach($data as $k=>$v){
            if($v->pid==$parent_id){
                $v->level = $level;
                $newarray[] =$v;
                $this->CreateTree($data,$v->c_id,$level+1);
            }
        }
        return $newarray;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');
        $res = Classify::insert($post);
        if($res){
          return redirect('classify/index');
        }
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
        $data =Classify::where('c_id',$id)->first();
        $res = Classify::all();
        $res = $this->CreateTree($res);
        return view('classify.edit',['data'=>$data,'res'=>$res]);
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
        $data = $request->except('_token');
        $classify = Classify::find($id);
        $classify->c_name = $data['c_name'];
        $classify->pid = $data['pid'];  
        $classify->c_detail = $data['c_detail'];
        $res = $classify->save();
        if($res!==false){
          return redirect('classify/index');
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
        $data = Classify::destroy($id);
        if($data){
         return redirect('classify/index');
        }
    }
}
