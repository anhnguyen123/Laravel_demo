<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class AuthController extends Controller
{
    public function login(Request $request){
    	$username= $request['username'];
    	$password= $request['password'];
    	//đoạn này login theo ID cố định
    	// $user = User::find(3);
    	// Auth::login($user);
    	// return view('thanhcong',['user'=>Auth::user()]);


    	//đoạn này login theo form người dùng
    	if(Auth::attempt(['name'=>$username,'password'=>$password])){
    		return view('thanhcong',['user'=>Auth::user()]);
    	}
    	else
    	{
    	 return view('dangnhap',['error'=>'Đăng nhập thất bại']);
    	}
    }
    public function logout(){
    	Auth::logout();
    	return view('dangnhap');
    }
}
