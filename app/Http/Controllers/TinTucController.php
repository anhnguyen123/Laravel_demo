<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;
class TinTucController extends Controller
{
    public function getDanhSach(){
        $tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin/tintuc/danhsach',['tintuc'=>$tintuc]);        
    }
    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
       return view('admin/tintuc/them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    
    public function postThem(Request $request){
        $this->validate($request,
        [
            'loaitin_form'=>'required',
            'TieuDe_form'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat_form'=>'required',
            'NoiDung_form'=>'required'
        ],
        [
            'loaitin_form.required'=>'Bạn chưa chọn loại tin',
            'TieuDe_form.requied'=>'Bạn chưa nhập tiêu đề',
            'TieuDe_form.min'=>'Tiêu đề phải lớn hơn 3 ký tự',
            'TieuDe_form.unique'=>'Tiêu đề đã tồn tại',
            'TomTat_form.required'=>'Bạn chưa nhập tóm tắt',
            'NoiDung_form.required'=>'Bạn chưa nhập nội dung'
        ]);
        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe_form;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe_form);
        $tintuc->idLoaiTin = $request->loaitin_form;
        $tintuc->TomTat= $request->TomTat_form;
        $tintuc->NoiDung = $request->NoiDung_form;
        $tintuc->SoLuotXem = 0;
        if($request->hasFile('File_Hinh')){
            $file = $request->file('File_Hinh');
            $duoi = $file->getclientOriginalExtension();
            if($duoi != "jpg" && $duoi != "png" && $duoi !="jpeg") 
            {
                return redirect('admin/tintuc/them')->with('thongbao','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh)){
                $Hinh = str_random(4)."_".$name;                
            }
            $file->move('upload/tintuc',$Hinh);
            $tintuc->Hinh = $Hinh;
        }else{
            $tintuc->Hinh= "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Bạn đã thêm tin thành công');
    }

    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        // echo $tintuc->toJson();
        return view('admin/tintuc/sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postSua(Request $request,$id){
       $tintuc = TinTuc::find($id);
       $this->validate($request,
        [
            'loaitin_form'=>'required',
            'TieuDe_form'=>'required|min:3',
            'TomTat_form'=>'required',
            'NoiDung_form'=>'required'
        ],
        [
            'loaitin_form.required'=>'Bạn chưa chọn loại tin',
            'TieuDe_form.requied'=>'Bạn chưa nhập tiêu đề',
            'TieuDe_form.min'=>'Tiêu đề phải lớn hơn 3 ký tự',
            // 'TieuDe_form.unique'=>'Tiêu đề đã tồn tại',
            'TomTat_form.required'=>'Bạn chưa nhập tóm tắt',
            'NoiDung_form.required'=>'Bạn chưa nhập nội dung'
        ]);
        $tintuc->TieuDe = $request->TieuDe_form;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe_form);
        $tintuc->idLoaiTin = $request->loaitin_form;
        $tintuc->TomTat= $request->TomTat_form;
        $tintuc->NoiDung = $request->NoiDung_form;
        // $tintuc->SoLuotXem = 0;
        if($request->hasFile('File_Hinh')){
            $file = $request->file('File_Hinh');
            $duoi = $file->getclientOriginalExtension();
            if($duoi != "jpg" && $duoi != "png" && $duoi !="jpeg") 
            {
                return redirect('admin/tintuc/them')->with('thongbao','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh)){
                $Hinh = str_random(4)."_".$name;                
            }
           
            //unlink là để xoá ảnh cũ
            $file->move('upload/tintuc',$Hinh);
            while(file_exists("upload/tintuc/".$tintuc->Hinh)){                
                unlink("upload/tintuc/".$tintuc->Hinh);             
            }
            if("upload/tintuc/".$tintuc->Hinh){
                
              }
            //unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }
        // else{
        //     $tintuc->Hinh= "";
        // }
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }
    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Xoá thành công');
    }
}
