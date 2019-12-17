<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
class CommentController extends Controller
{
    public function getXoa($id,$idtintuc){
        $tintuc = Comment::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/sua/'.$idtintuc)->with('thongbao','Xoá comment thành công');
    }
}
