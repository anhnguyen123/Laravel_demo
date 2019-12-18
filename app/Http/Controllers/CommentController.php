<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\TinTuc;
class CommentController extends Controller
{
    public function getXoa($id,$idtintuc){
        $tintuc = Comment::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/sua/'.$idtintuc)->with('thongbao','Xoá comment thành công');
    }
    public function postComment($id,Request $request){
        $idTinTuc = $id;
        $tintuc = TinTuc::find($id);
        $commnet = new Comment;
        $commnet->idTinTuc = $idTinTuc;
        $commnet->idUser = Auth::user()->id;
        $commnet->NoiDung = $request->noidung_comment;
        $commnet->save();
        return redirect("tintuc/$id/".$tintuc->TieuDeKhongDau.".html")->with('thongbao','Viết bình luận thành công');
    }
}
