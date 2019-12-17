@extends('admin.layout.index')
@section('content')
 <!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>{{$user->name}}</small>
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
            <div class="col-lg-7" style="padding-bottom:120px">
            <form action="admin/user/sua/{{$user->id}}" method="POST">      
                    <input type="hidden" name="_token"  value="{{csrf_token()}}">              
                    <div class="form-group">
                        <label>Họ tên</label>
                    <input value="{{$user->name}}" class="form-control" name="Name_form" placeholder="Họ tên người dùng" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input readonly value="{{$user->email}}" type="email" class="form-control" name="Mail_form" placeholder="Nhập Email" />
                    </div>
                    
                    <div class="form-group">
                        <input type="checkbox" name="changePassword" id="changePassword">                        
                        <label>Đổi Mật khẩu</label>
                        <input disabled type="password" class="form-control password" name="Password_form" placeholder="Nhập mật khẩu" />
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input disabled type="password" class="form-control password" name="Password_agian_form" placeholder="Nhập lại mật khẩu" />
                    </div>                    
                    <div class="form-group">
                        <label>Quyền người dùng</label>
                        <label class="radio-inline">
                            <input 
                            @if ($user->quyen == 1)
                                {{'checked'}}
                            @endif
                            name="Quyen_form" value="1" type="radio">Admin
                        </label>
                        <label class="radio-inline">
                            <input
                            @if ($user->quyen == 0)
                                {{'checked'}}
                            @endif
                            name="Quyen_form" value="0"  type="radio">Thường
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Sửa</button>
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
        $('#changePassword').change(function(){
            if($(this).is(":checked")){
                $('.password').removeAttr('disabled');
            }
            else{
                $(".password").attr('disabled','');
            }
        });
    });
</script>    
    
@endsection