<style type="text/css">
	.pagination li{
		list-style: none;
		float: left;
		margin-left: 5px;
	}
</style>
@foreach($user_mva as $value)
	{{$value->name}}<br>
@endforeach

{!! $user_mva->links() !!}