<?php

namespace App\Http\Controllers;
use App\TheLoai;
use Illuminate\Http\Request;
use App\LoaiTin;
use App\TinTuc;
use App\Slide;
use App\User;
use Illuminate\Support\Facades\Auth;
class PagesController extends Controller
{
    // public function __contruct(){
    //     $theloai = TheLoai::all();
    //     view()->share('theloai',$theloai);
    // }
    // Ở phiên bản Laravel hiện tại là 5.6 thì mình không thể dùng cách view share như anh đề cập nữa.
    // Cách khắc phục:
    // Bạn vào file App\Providers\AppServiceProvider.php
    // Thêm thư viện
    // use App\TheLoai;
    // và trong hàm boot() bạn thêm
    // $theloai = TheLoai::all();
    // view()->share('theloai', $theloai); 
    // ==================> Như vậy thì Provider ở trên đã truyền $theloai cho tất cả các view rồi đấy
    // -----------------------------------------------------------------------------------------------
    // Trong PagesController bạn xóa __constructor đi, không dùng cái này nữa. Các function trangchu() và lienhe() cũng không truyền $theloai vào, vì Provider ở trên nó tự share $theloai cho tất cả loại view
    public function trangchu(){
        // $theloai = TheLoai::all();
        // return view('pages.trangchu',['theloai'=>$theloai]);
        return view('pages.trangchu');
    }
    public function lienhe(){
        // $theloai = TheLoai::all();
        // return view('pages.lienhe',['theloai'=>$theloai]);
        return view('pages.lienhe');
    }
    public function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(10);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    public function tintuc($id){
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
    public function getDangNhap(){
        return view('pages.dangnhap');
    }
    public function postDangNhap(Request $request){
        $this->validate($request,
        [            
            'email_login'=>'required',                      
            'password_login'=>'required|min:3|max:32'
        ],
        [            
            'email_login.requied'=>'Bạn chưa nhập tên',    
            'password_login.requied'=>'Bạn chưa nhập mật khẩu',    
            'password_login.min'   =>'Mật khẩu phải lớn hơn 6 và nhỏ 32 ký tự',                             
            'password_login.max'   =>'Mật khẩu phải lớn hơn 6 và nhỏ 32 ký tự',                             
        ]);
        if(Auth::attempt(['email'=>$request->email_login,'password'=>$request->password_login])){
            return redirect('trangchu');
        }else{
            return redirect('dangnhap')->with('thongbao','Đăng nhập không thành công');
        }

    }
    public function dangxuat(){
        Auth::logout();
        return redirect('trangchu');
    }
    public function getNguoiDung(){
        $user = Auth::user();
        return view('pages.nguoidung',['nguoidung'=>$user]);
    }
   
    public function postNguoiDung(Request $request){
        $this->validate($request,
        [            
            'Name_form'=>'required|min:6',                      
        ],
        [            
            'Name_form.requied'=>'Bạn chưa nhập tên',    
            'Name_form.min'   =>'Tên người dùng phải có ít nhất 6 ký tự',                             
        ]);
        $user = Auth::user();
        $user->name = $request->Name_form;        
        echo $request->changePassword;
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
        return redirect('nguoidung')->with('thongbao','Bạn đã sửa thành công');
    }
    public function getDangKy(){
        return view('pages.dangky');
    }
    public function postDangKy(Request $request){
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
        $user->quyen = 0;
       $user->save();
       return redirect('dangnhap')->with('thongbao','Đã đăng ký thành công');
    }
    public function timkiem(Request $request){
        $tukhoa = $request->tukhoa;
        $tintuc = TinTuc::where('TieuDe','like',"%%$tukhoa")->orWhere('TomTat','like',"%$tukhoa%")->orWhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(6);
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }
}
