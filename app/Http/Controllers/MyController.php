<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
class MyController extends Controller
{
    public function Xinchao(){
    	echo "Chào các bạn";
    }
    public function KhoaHoc($ten){
    	echo $ten;
    	//
    	return redirect()->route('MyRoute');
    }
    public function GetURL(Request $request){
    	//return $request->url();
    	if($request->isMethod('get')){
    		echo "Phương thức Get";
    	}else echo "Không phải phương thức Get";
    }
    public function postForm(Request $request){
    	echo "Tên của bạn là: ";
    	echo $request->hoten;
    	if($request->has('tuoi'))
    		echo "Có tham số";
    	else echo "Không có tham số";

    }

    //làm việc với cookie
    public function setCookie(){
    	$response = new Response();
    	$response->withCookie('khoahoc','Laravel Khoa Pham',0.1);//(tên cookie, giá trị của cookie, thời gian tồn tại)
    	echo "Đã set cookie";
    	return $response;
    }
    public function getCookie(Request $request){
    	return $request->cookie('khoahoc');
    }
    public function postFileImpl(Request $request){
    	if($request->hasFile('myFile')){
    		$file = $request->file('myFile');
    		if($file->getClientOriginalExtension('myFile')=="JPG"){


	    		$filename = $file->getClientOriginalName('myFile');
	    		echo $filename;
	    		$file ->move('img',$filename);//lưu với tên file gốc
	    	}else echo "Không phải đuôi JPG";
    		// $file ->move('img','myfile.jpg');
    	}else echo "Chưa có file";
    }
    //json
    public function getJson(){
    	$array =['KhoaHoc'=>'HTML'];
    	//$array =['Laravel','PHP','ASP.NET','HTML'];
    	return response()->json($array);
    }

    public function myView(){
    	return view('myView');
    }
    public function Time($t){
    	return view('myView',['timeinput'=>$t]);
    }
    public function blade($str){
    	$khoahoc = "Laravel - Khoa Phạm";
    	if($str == 'laravel')
    		return view('pages.laravel',['khoahoc'=>$khoahoc]);
    	elseif($str == 'php') 
    		return view('pages.php',['khoahoc'=>$khoahoc]);
    }
}
