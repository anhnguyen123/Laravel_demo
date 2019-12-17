{{-- {{$error  or ''}} --}}
<form action="{{route('login')}}" method="post">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
	<input type="text" name	="username" placeholder="username">
	<input type="password" name	="password" placeholder="password">
	<input type="submit">
</form>