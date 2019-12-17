@extends('layouts.master')
@section('NoiDung')

<h1>PHP</h1>
<!-- <?php echo $khoahoc ?> -->
<!-- {{$khoahoc}}  --><!-- ko cho hiển thị html -->
<!-- {!!$khoahoc!!} --> <!-- cho phép hiển thị html -->
<!-- @if($khoahoc !="")
	{{$khoahoc}}
@else {{"không có khoá học"}}
@endif -->
<!-- {{ isset($khoahoc) ? $khoahoc:"khong co khoa hoc"}}
<br>
@for($i = 1; $i<=10; $i++)
	{{$i." " }}
@endfor -->

<!-- phần 2 -->
<?php $khoahoc = array('PHP','IOS','ASP','Android')?>
<!-- @if(!empty($khoahoc))
	@foreach($khoahoc as $value)
		{{$value}}
	@endforeach
@else
	{{"Mảng rỗng"}}
@endif
 -->
 

@forelse($khoahoc as $values)
 <!-- @break ($values == "IOS") -->
 {{$values}}
@empty
 {{"Mang rong"}}
@endforelse

@endsection