<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getThem(){
        return view('admin/user/them');
    }
    
    public function postThem(Request $request){
        $this->validate($request,
        [            
            'Name_form'=>'required|min:6',
            'Mail_form'=>'required|email|unique:users,email',     
            'Password_form'=>'required|min:3|max:32',
            'Password_agian_form'=>'required|same:Password_form',  
        ],
        [            
            'Name_form.requied'=>'Bạn chưa nhập tên',    
            'Name_form.min'   =>'Tên người dùng phải có ít nhất 6 ký tự',
            'Mail_form.required'=>'Bạn chưa nhập email',
            'Mail_form.email'=>'Bạn chưa nhập đúng định dạng email',
            'Mail_form.unique'=>'Email đã tồn tại',
            'Password_form.required'=>'Bạn chưa nhập mật khẩu',
            'Password_form.min'=>'Mật khẩu phải lớn hơn 3 và nhỏ hơn 32 ký tự',
            'Password_form.max'=>'Mật khẩu phải lớn hơn 3 và nhỏ hơn 32 ký tự',
            'Password_agian_form.required'=>'Bạn chưa nhập lại password',
            'Password_agian_form.same'=>'Password không giống với lần đầu',
        ]);
        $user = new User;
        $user->name = $request->Name_form;
        $user->email = $request->Mail_form;
        $user->password = bcrypt($request->Password_form);
        $user->quyen = $request->Quyen_form;
       $user->save();
       return redirect('admin/user/them')->with('thongbao','Đã thêm thành công');
    }

    public function getSua($id){
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }
    public function postSua(Request $request,$id){
        $this->validate($request,
        [            
            'Name_form'=>'required|min:6',                      
        ],
        [            
            'Name_form.requied'=>'Bạn chưa nhập tên',    
            'Name_form.min'   =>'Tên người dùng phải có ít nhất 6 ký tự',                             
        ]);
        $user = User::find($id);
        $user->name = $request->Name_form;
        $user->quyen = $request->Quyen_form;
        //echo $request->changePassword;
        if($request->changePassword == 'on')
        {
            $this->validate($request,
        [ 
            'Password_form'=>'required|min:3|max:32',
            'Password_agian_form'=>'required|same:Password_form'             
        ],
        [            
            'Password_form.required'=>'Bạn chưa nhập mật khẩu',
            'Password_form.min'=>'Mật khẩu phải lớn hơn 3 và nhỏ hơn 32 ký tự',
            'Password_form.max'=>'Mật khẩu phải lớn hơn 3 và nhỏ hơn 32 ký tự',
            'Password_agian_form.required'=>'Bạn chưa nhập lại password',
            'Password_agian_form.same'=>'Password không giống với lần đầu'                
        ]);
            $user->password = bcrypt($request->Password_form);
        }
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }
    public function getXoa($id){
        $user = User::find($id);
        $user->delete();
        //đang chú thích đây mà
        return redirect('admin/user/danhsach')->with('thongbao','Đã xoá thành công');
    }
}
