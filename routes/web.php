<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('ngocanh', function () {
    echo 'xin chào các bạn';
});
Route::get('ngocanh1', function () {
    echo 'xin chào các bạn';
});
Route::get('ngocanh/home',function(){
	echo "<h1>Khoá học Laravel</h1>";
});

//truyền tham số

Route::get('ngocanh4/{ten}',function($ten){
	echo "<h1>".$ten."</h1>";
});
Route::get('ngocanh/{ten2}',function($ten2){
	echo "Khoa Pham: " .$ten2;
})->where(['ten2'=>'[a-zA-Z]+']);

//Định danh
Route::get('Route1',['as'=>'MyRoute',function(){
	echo "Xin chào các bạn";
}]);

Route::get('Route2',function(){
	echo "Day la route2";
})->name('MyRoute2');

Route::get('Goiten',function(){
	return redirect()->route('MyRoute2');
});

//Group

Route::group(['prefix'=>'MyGroup'],function(){
	Route::get('User1',function(){
		echo "User1";
	});
	Route::get('User2',function(){
		echo "User2";
	});
	Route::get('User3',function(){
		echo "User3";
	});
});

//Gọi controller
Route::get('goicontroller','MyController@Xinchao');
Route::get('ThamSo/{ten}','MyController@KhoaHoc');

//URL
Route::get('MyRequest','MyController@GetURL');
//Gửi nhận dữ liệu với request
Route::get('getForm',function(){
	return view('postform');//ko lấy đuôi blade.php
});
Route::post('postForm',['as'=>'postForm','uses'=>'MyController@postForm']);

//Cookie
Route::get('setCookie','MyController@setCookie');
Route::get('getCookie','MyController@getCookie');

//upload
Route::get('uploadFile',function(){
	return view('postFile');//tên file không cần có đuôi blade
});
Route::post('postFileRoute',['as'=>'postFileRoute','uses'=>'MyController@postFileImpl']);

//JSON
Route::get('getJson','MyController@getJson');
//view
Route::get('myView','MyController@myView');

Route::get('Time/{t}','MyController@Time');
View::share('Khoahoc','Laravel');

//BLADE TEMPLATE
Route::get('blade',function(){
	return view('pages.php');
	//return view('layouts/master');
});
Route::get('bladetemplate/{str}','MyController@blade');

//database
Route::get('createtable',function(){
	Schema::create('users',function($table){
		$table->increments('id');
		$table->string('name',100);
		$table->string('email',100);
		$table->string('password',100);
	});
});
Route::get('database',function(){
	// Schema::create('loaisanpham',function($table){
	// 	$table->increments('id');
	// 	$table->string('ten',100);
	// });
	Schema::create('theloai',function($table){
		$table->increments('id');
		$table->string('ten',100)->nullable();
		$table->string('nsx',200)-> default('Nhà sản xuất Sunhouse');
	});
	echo "Đã thực hiện tạo bảng";
});
//chỉnh sửa bảng
Route::get('lienketbang',function(){
	Schema::create('sanpham',function($table){
		$table->increments('id');
		$table->string('tensanpham',50);
		$table->float('gia');
		$table->integer('soluong')->default(0);
		$table->integer('id_loaisanpham')->unsigned();
		$table->foreign('id_loaisanpham')->references('id')->on('loaisanpham');
	});
	echo "Đã chạy lienketbang";
});
Route::get('suabang',function(){
	Schema::table('theloai',function($table){
		$table->dropColumn('nsx');
	});
});
Route::get('themcot',function(){
	Schema::table('theloai',function($table){
		$table->string('email');
	});
	echo "Đã thêm cột email";
});
Route::get('doiten',function(){
	Schema::rename('theloai','nguoidung');
	echo "Đã đổi tên bảng";
});
//QUERY BUILDER

Route::get('qb/get',function(){
	$data = DB::table('users')->get();
	// echo $data;
	foreach ($data as $row) {
		foreach ($row as $key => $value) {
			echo $key.":".$value;
		}
		echo "<hr>";
	}
});
Route::get('qb/where',function(){
	$data = DB::table('users')->where('id','=',3)->get();
	// echo $data;
	foreach ($data as $row) {
		foreach ($row as $key => $value) {
			echo $key.":".$value;
		}
		echo "<hr>";
	}
});
// select id, name, email,...
Route::get('qb/select',function(){
	$data = DB::table('users')->select(['id','name','email'])->where('id',3)->get();//where kiểu này sẽ tự hiểu là = 3
	// $data = DB::table('users')->where('id','=',3)->get();
	// echo $data;
	foreach ($data as $row) {
		foreach ($row as $key => $value) {
			echo $key.":".$value;
		}
		echo "<hr>";
	}
});
//select name as hoten from users
Route::get('qb/raw',function(){
	$data = DB::table('users')->select(DB::raw('id,name as hoten,email'))->where('id',3)->get();//where kiểu này sẽ tự hiểu là = 3
	// $data = DB::table('users')->where('id','=',3)->get();
	// echo $data;
	foreach ($data as $row) {
		foreach ($row as $key => $value) {
			echo $key.":".$value;
		}
		echo "<hr>";
	}
});

//inser update
Route::get('qb/update',function(){
	DB::table('users')->where('id',1)->update(['name'=>'Ngoc Khoa','email'=>'khoa@gmail.com']);
	echo "Đã update";
});
Route::get('qb/delete',function(){
	DB::table('users')->where('id',1)->delete();
	echo "Đã xoá";
});
//MODEL
Route::get('model/save',function(){
	$user = new App\User();
	// $user->id=5;
	$user->name='admin';
	$user->email='mai@gmail.com';
	$user->password=bcrypt('123456');
	$user->save();
	echo "Đã insert qua model";
});
Route::get('model/query',function(){
	$user = App\User::find(1);
	echo $user->name;
});

//tạo model
Route::get('model/sanpham/save',function(){
	$sanpham = new App\SanPham();
	$sanpham->tensanpham="iphone 6";
	$sanpham->soluong=100;
	$sanpham->gia =100;
	$sanpham->save();
	echo "Đã thêm sản phẩm";
});
Route::get('model/sanpham/save/{ten}',function($ten){
	$sanpham = new App\SanPham();
	$sanpham->tensanpham=$ten;
	$sanpham->soluong=100;
	$sanpham->gia =100;
	$sanpham->save();
	echo "Đã thêm sản phẩm ".$ten;
});
Route::get('model/sanpham/all1',function(){
	//$sanpham = new App\SanPham::all()->toJson();
	$sanpham = new App\SanPham();
	var_dump($sanpham::all()->toJson());
});

Route::get('model/sanpham/ten',function(){
	$sanpham = App\SanPham::where('tensanpham','Laptop')->get()->toJson();
	var_dump($sanpham);
});
//xoá nhanh bằng khoá chính
Route::get('model/sanpham/delete',function(){
	$sanpham = App\SanPham::destroy(4);
	echo "Đã xoá";
});


//liên kết dữ liệu trong model
Route::get('taocot',function(){
	Schema::table('sanpham',function($table){
		$table->integer('id_loaisanpham')->unsigned();
	});	
});

// bảng sản phẩm sẽ là bảng cha, lưu id sản phẩm
//tạo liên kết từ bảng con sang bảng cha, sanpham -> loaisanpham
Route::get('lienket',function(){
	$data = App\SanPham::find(3)->loaisanpham->toArray();
	var_dump($data);
});

//từ cha tới con, 1 cha có nhiều con, 1 loại sản phẩm có nhiều sảnphaamr
Route::get('lienketloaisanpham',function(){
	$data = App\LoaiSanPham::find(1)->sanpham->toJson();
	var_dump($data);
});
//Middleware
//kiểm tra bảo mật, hoặc ràng buộc điều kiện cho route
Route::get('diem',function(){
	echo "Bạn đã đủ điểm";
})->middleware('MyMiddleware')->name('diem');

Route::get('loi',function(){
	echo "Bạn chưa đủ điểm";
})->name('loi');
Route::get('nhapdiem',function(){
	return view('nhapdiem');
})->name('nhapdiem');

// Tìm hiểu AUTH
Route::get('dangnhap',function(){
	return view('dangnhap');
});
Route::post('login','AuthController@login')->name('login');

//logout
Route::get('logout','AuthController@logout');
Route::get('thu',function(){
	return view('thanhcong');
});

//SESSION
Route::group(['middleware' => ['web']],function(){
	Route::get('Session',function(){
		Session::put('KhoaHoc','Laravel');
		echo "Đã đặt session";
		echo "<br>";

		echo Session::get('KhoaHoc');

		Session::flush(); //xoá hết các session
		if(Session::has('KhoaHoc'))
			echo "Session đã tồn tại";
		else echo "Session không tồn tại";
	});


});
//phân trang - pagination
Route::get('user_mva','usermvaController@index');
//bài tập thực hành
use App\TheLoai;
Route::get('thu',function(){
	return view('admin.theloai.danhsach');
});

Route::get('admin/dangnhap','UserController@getDangNhapAdmin');
Route::post('admin/dangnhap','UserController@postDangNhapAdmin');
Route::get('admin/logout','UserController@getDangXuatAdmin');
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){

	Route::group(['prefix'=>'theloai'],function(){
		//admin/theloai/them
		Route::get('danhsach','TheLoaiController@getDanhSach');
		
		Route::get('sua/{id}','TheLoaiController@getSua');
		Route::post('sua/{id}','TheloaiController@postSua');
		
		Route::get('them','TheLoaiController@getThem');
		Route::post('them','TheLoaiController@postThem');

		Route::get('xoa/{id}','TheLoaiController@getXoa');
		
	});
	Route::group(['prefix'=>'loaitin'],function(){
		//admin/loaitin/them
		Route::get('danhsach','LoaiTinController@getDanhSach');
		
		Route::get('sua/{id}','LoaiTinController@getSua');
		Route::post('sua/{id}','LoaiTinController@postSua');
		
		Route::get('them','LoaiTinController@getThem');
		Route::post('them','LoaiTinController@postThem');

		Route::get('xoa/{id}','LoaiTinController@getXoa');
	});
	Route::group(['prefix'=>'tintuc'],function(){
		//admin/loaitin/them
		Route::get('danhsach','TinTucController@getDanhSach');
		Route::get('sua/{id}','TinTucController@getSua');
		Route::post('sua/{id}','TinTucController@postSua');

		Route::get('them','TinTucController@getThem');
		Route::post('them','TinTucController@postThem');
		Route::get('xoa/{id}','TinTucController@getXoa');
		
	});
	Route::group(['prefix'=>'comment'],function(){		
		Route::get('xoa/{id}/{idtintuc}','CommentController@getXoa');	
		
	});
	Route::group(['prefix'=>'slide'],function(){
		//admin/loaitin/them
		Route::get('danhsach','SildeController@getDanhSach');
		Route::get('sua/{id}','SildeController@getSua');
		Route::post('sua/{id}','SildeController@postSua');
		Route::get('them','SildeController@getThem');
		Route::post('them','SildeController@postThem');
		Route::get('xoa/{id}','SildeController@getXoa');		
	});
	Route::group(['prefix'=>'user'],function(){		
		Route::get('danhsach','UserController@getDanhSach');
		Route::get('sua/{id}','UserController@getSua');
		Route::post('sua/{id}','UserController@postSua');
		Route::get('them','UserController@getThem');
		Route::post('them','UserController@postThem');
		Route::get('xoa/{id}','UserController@getXoa');		
	});
	Route::group(['prefix'=>'ajax'],function(){
		Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
	});
	
});


