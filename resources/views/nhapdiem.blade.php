<h1>Nhập điểm</h1>
<form action="{{route('diem')}}" method="get">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
	<input type="number" name="diem">
	<input type="submit">
</form>