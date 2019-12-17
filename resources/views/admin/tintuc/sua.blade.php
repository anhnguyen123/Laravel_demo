@extends('admin.layout.index')
@section('content')
 <!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>{{$tintuc->TieuDe}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                    </div>
                @endif
                @if(session('thongbao'))
                    <div class="alert alert-success">{{session('thongbao')}}</div>
                @endif
                <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token"  value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>thể loại</label>
                        <select class="form-control" name="theloai_form" id="TheLoai">
                            @foreach ($theloai as $item)
                                <option 
                                @if ($tintuc->loaitin->theloai->id == $item->id)
                                    {{'selected'}}
                                @endif
                                value="{{$item->id}}">{{$item->Ten}}</option>
                            @endforeach                            
                        </select>
                    </div>
                    <div class="form-group">
                            <label>loại tin</label>
                            <select class="form-control" name="loaitin_form" id="LoaiTin">
                                @foreach ($loaitin as $lt)
                                    <option 
                                    @if ($tintuc->loaitin->id == $lt->id)
                                        {{'selected'}}
                                    @endif
                                    value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>                   
                    <div class="form-group">
                        <label>Tiêu đề</label>
                    <input value="{{$tintuc->TieuDe}}" class="form-control" name="TieuDe_form" placeholder="Please Enter Category Name" />
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea value="{{$tintuc->TomTat}}"  name="TomTat_form" class="form-control ckeditor" id="idTomTat"  rows="3">{{$tintuc->TomTat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea value="{{$tintuc->NoiDung}}" name="NoiDung_form" class="form-control ckeditor" id="idNoidung"  rows="3">{{$tintuc->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-control">Hình ảnh</label>
                        <p><img class="img-responsive" width="400px" src="upload/tintuc/{{$tintuc->Hinh}}" alt=""></p>
                        <input type="file" name="File_Hinh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input
                            @if ($tintuc->NoiBat == 0)
                                {{'checked'}}
                            @endif
                            name="NoiBat" value="0" checked="" type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input
                            @if ($tintuc->NoiBat == 1)
                                {{"checked"}}
                            @endif
                            name="NoiBat" value="1" type="radio">Có
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bình luận
                    <small>Danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
                </div>
            @endif
            @if(session('thongbao'))
                <div class="alert alert-success">{{session('thongbao')}}</div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Nội dung</th>
                        <th>Ngày đăng</th>                        
                        <th>Delete</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tintuc->comment as $cm)
                        <tr class="odd gradeX" align="center">
                            <td>{{$cm->id}}</td>
                            <td>{{$cm->user->name}}</td>
                            <td>{{$cm->NoiDung}}</td>
                            <td>{{$cm->Created_at}}</td>                            
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}">Xoá</a></td>
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- end row comment  --}}
    </div>
    <!-- /.container-fluid -->
</div>
        <!-- /#page-wrapper -->
@endsection   
@section('script')
    <script>   
    $(document).ready(function(){
        $('#TheLoai').change(function(){
            var idTheloai = $(this).val();            
            $.get("admin/ajax/loaitin/" + idTheloai,function(data){
                $("#LoaiTin").html(data);
            });
        });
    });
    </script>
@endsection     