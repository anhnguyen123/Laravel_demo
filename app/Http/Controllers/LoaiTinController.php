<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
class LoaiTinController extends Controller
{
    //
    public function getDanhSach(){
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
    public function getThem(){
        $theloai = TheLoai::all();

    	return view ('admin.loaitin.them',['theloai'=>$theloai]);
    }
    
    public function postThem(Request $request){
        // echo $request->Ten;
        $this->validate($request,
        [
            'Ten_loaitin'=>'required|unique:LoaiTin,Ten|min:1|max:100',
            'idTheLoai_value'=>'required'
        ],
        [
            'Ten_loaitin.required'=>'Bạn chưa nhập tên loại tin',
            'Ten_loaitin.unique'=>'Tên loại tin đã tồn tại',
            'Ten_loaitin.min'=> 'Tên loại phải lớn hơn 1 ký tự',
            'Ten_loaitin.max'=>'Tên loại tin > 1 và < 100 ký tự',
            'idTheLoai_value.required'=>'Bạn chưa chọn thể loại'
        ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten_loaitin;
        $loaitin->TenKhongDau=changeTitle($request->Ten_loaitin);
        $loaitin->idTheLoai=$request->idTheLoai_value;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Bạn đã thêm thành công');
        
    }

    public function getSua($id){
        $loaitin = LoaiTin::find($id);
        $theloai = TheLoai::all();
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $this->validate($request,
        [
            'Ten_loaitin'=>'required|unique:LoaiTin,Ten|min:1|max:100',
            'idTheLoai_value'=>'required'
        ],
        [
            'Ten_loaitin.required'=>'Bạn chưa nhập tên loại tin',
            'Ten_loaitin.unique'=>'Tên loại tin đã tồn tại',
            'Ten_loaitin.min'=> 'Tên loại phải lớn hơn 1 ký tự',
            'Ten_loaitin.max'=>'Tên loại tin > 1 và < 100 ký tự',
            'idTheLoai_value.required'=>'Bạn chưa chọn thể loại'
        ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten_loaitin;
        $loaitin->TenKhongDau= changeTitle($request->Ten_loaitin);
        $loaitin->idTheLoai= $request->idTheLoai_value;
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Bạn đã thêm thành công');
        
    }
    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao',"Đã xoá thành công ".$loaitin->Ten);
    }
}
