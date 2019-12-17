<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Khoa Pham</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"> <!-- assert sẽ tự trỏ tới thư mục publish -->
</head>
<body>
	@include('layouts.header')
	<div id="content">
		<h1>Khoa Phạm</h1>
		@yield('NoiDung')
	</div>
	@include('layouts.footer')
</body>
</html>