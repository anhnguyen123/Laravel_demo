<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
class SildeController extends Controller
{
    public function getDanhSach(){
        $slide = Slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
    }
    public function getThem(){
        return view('admin.slide.them');
    }
    
    public function postThem(Request $request){
        $this->validate($request,
        [            
            'Ten_form'=>'required',
            'NoiDung_form'=>'required',            
        ],
        [            
            'Ten_form.requied'=>'Bạn chưa nhập tên',            
            'NoiDung_form.required'=>'Bạn chưa nhập nội dung'
        ]);
        $slide = new Slide();
        $slide->Ten = $request->Ten_form;
        $slide->NoiDung = $request->NoiDung_form;
        if($request->has('Link_form'))
            $slide->link = $request->Link_form;

        if($request->hasFile('File_Hinh')){
            $file = $request->file('File_Hinh');
            $duoi = $file->getclientOriginalExtension();
            if($duoi != "jpg" && $duoi != "png" && $duoi !="jpeg") 
            {
                return redirect('admin/slide/them')->with('thongbao','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists("upload/slide/".$Hinh)){
                $Hinh = str_random(4)."_".$name;                
            }
            $file->move('upload/slide',$Hinh);
            $slide->Hinh = $Hinh;
        }else{
            $slide->Hinh= "";
        }
        $slide->save()            ;
        return redirect('admin/slide/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
        $slide = Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }
    public function postSua(Request $request,$id){
        $this->validate($request,
        [            
            'Ten_form'=>'required',
            'NoiDung_form'=>'required',            
        ],
        [            
            'Ten_form.requied'=>'Bạn chưa nhập tên',            
            'NoiDung_form.required'=>'Bạn chưa nhập nội dung'
        ]);
        $slide = Slide::find($id);
        $slide->Ten = $request->Ten_form;
        $slide->NoiDung = $request->NoiDung_form;
        if($request->has('Link_form'))
            $slide->link = $request->Link_form;

        if($request->hasFile('File_Hinh')){
            $file = $request->file('File_Hinh');
            $duoi = $file->getclientOriginalExtension();
            if($duoi != "jpg" && $duoi != "png" && $duoi !="jpeg") 
            {
                return redirect('admin/slide/them')->with('thongbao','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists("upload/slide/".$Hinh)){
                $Hinh = str_random(4)."_".$name;                
            }
            $file->move('upload/slide',$Hinh);
            while(file_exists("upload/slide/".$slide->Hinh)){
                unlink('upload/slide/'.$slide->Hinh);
            }
            $slide->Hinh = $Hinh;
        }
        $slide->save()            ;
        return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa thành công');
    }
    public function getXoa($id){
        $slide=Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/danhsach')->with('thongbao','Xoá thành công');
    }
}
