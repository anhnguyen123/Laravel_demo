@extends('admin.layout.index')
@section('content')
 <!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>Thêm</small>
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
                <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token"  value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>thể loại</label>
                        <select class="form-control" name="theloai_form" id="TheLoai">
                            @foreach ($theloai as $item)
                                <option value="{{$item->id}}">{{$item->Ten}}</option>
                            @endforeach                            
                        </select>
                    </div>
                    <div class="form-group">
                            <label>loại tin</label>
                            <select class="form-control" name="loaitin_form" id="LoaiTin">
                                @foreach ($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>                   
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="TieuDe_form" placeholder="Please Enter Category Name" />
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea  name="TomTat_form" class="form-control ckeditor" id="idTomTat"  rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="NoiDung_form" class="form-control ckeditor" id="idNoidung"  rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-control">Hình ảnh</label>
                        <input type="file" name="File_Hinh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0" checked="" type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1" type="radio">Có
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
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