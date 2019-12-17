<?php

namespace App\Http\Controllers;
use App\TheLoai;
use Illuminate\Http\Request;

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
}
