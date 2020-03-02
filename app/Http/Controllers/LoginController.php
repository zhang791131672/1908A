<?php

namespace App\Http\Controllers;
use App\Admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    function login(){
        return view('login.login');
    }
    function logindo(){
        $data=request()->except('_token');
        $res=Admin::where('admin_user','=',$data['admin_user'])->first();
        if(!$res){
            return redirect('/login')->with('msg','没有此用户');
        }
        if($data['admin_pwd']!=decrypt($res['admin_pwd'])){
            return redirect('/login')->with('msg','密码错误');
        }
        session(['admin_id'=>$res->admin_id,'admin_user'=>$res->admin_user]);
        return redirect('/');
    }
}
