<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user_mva;
class usermvaController extends Controller
{
    //
    public function index(){
    	$user_mva = user_mva::where('class','>=',6)->paginate(10);

    	return view('user_mva',['user_mva'=>$user_mva]);
    }
}
