<?php
	/**
	 *$cateinfo 要循环处理的值
	 *$p_id 父级分类id
	 * $level 级别默认为1
	  @return array
	 */

  // function cateinfo($cateinfo,$p_id=0,$level=1){
  //   	static $info=[];
  //   	foreach ($cateinfo as $k=>$v) {
  //   		if($v['p_id']==$p_id){
  //   			$v['level']=$level;
  //   			$info[]=$v;
  //   			cateinfo($cateinfo,$v['cate_id'],$v['level']+1);
  //   		}
  //   	}
  //   	return $info;
  //   }

  //文件上传
   function  upload($filename){
        //判断上传过程有误错误
        if(request()->file($filename)->isValid()){
            //接收值
            $photo = request()->file($filename);
            //上传
            $store_result = $photo->store($filename);
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出售');
    }
  //多文件上传
  function Moreuploads($filename){
    $photo = request()->file($filename);
    if(!is_array($photo)){
      return;
    }
    foreach($photo as $v){
      if($v->isValid()){
        $store_result[] = $v->store('uploads');
      }
    }
    return $store_result;
  }