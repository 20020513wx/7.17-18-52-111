<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Model\User;
class UserController extends Controller
{
    //注册视图
    public function reg(){
        return view('admin.reg');
    }
    //注册执行
    public function regDo(){
        $data=request()->except('_token');
        $validator=Validator::make($data,[
            'name'=>'required|unique:user',
            'password'=>'required',
            'pwds'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'name.unique'=>'用户名不能重复',
            'password.required'=>'密码不能为空',
            'pwds.required'=>'确认密码不能为空',
        ]);
        if($validator->fails()){
            return redirect('reg')->withErrors($validator)->withInput();
        }
        if($data['password']!=$data['pwds']){
            return redirect('reg')->with('msg','确认密码与密码不一致');
        }
        array_pop($data);
        $data['regtime']=time();
        $res=User::insert($data);
        if($res){
            return redirect('/');
        }
    }
    public function login(){
        return view('admin.login');
    }
    public function loginDo(){
        $data=request()->except('_token');
        $validator=Validator::make($data,[
            'name'=>'required',
            'password'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
        ]);
        if($validator->fails()){
            return redirect('/')->withErrors($validator)->withInput();
        }

        $where=[
            ['name','=',$data['name']],
        ];
        $res=User::where($where)->first();
        $wheres=[
            ['id','=',$res['id']]
        ];
        User::where($wheres)->update(['logintime'=>time()]);
        if($res){
            if($data['password']!=$res['password']){
                return redirect('/')->with('pwd','密码错误');
            }
            session(['user'=>$res]);
            return redirect('admin/index');
        }else{
            return redirect('/')->with('msg','账号不存在');
        }
    }
    public function test(){
        $res=session('user');
        dd($res);
    }
}
