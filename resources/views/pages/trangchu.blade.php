    @extends('layout.index')
    @section('content')       
    
    <div class="container">

    	<!-- slider -->
    	@include('layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            @include('layout.menu')

            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
	            	</div>

	            	<div class="panel-body">
                        <!-- item -->
                        @foreach ($theloai as $tl)
                            @if (count($tl->loaitin) > 0)  
                                <div class="row-item row">
                                    <h3>
                                        <a href="category.html">{{$tl->Ten}}</a> | 	
                                        @foreach ($tl->loaitin as $lt)
                                            <small><i>
                                                    <a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html">{{$lt->Ten}}</a>
                                                {{-- {{$lt->Ten}} --}}
                                            </i>/</small>
                                        @endforeach
                                    </h3>
                                    <?php 
                                    $data = $tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5);
                                    //lấy ra 5 tin mới nhất
                                    $tin1 = $data->shift();//lấy ra tin đầu tiên, và sẽ tự loại bỏ tin đó trong $data
                                    //trả về kiểu array

                                    ?>
                                    <div class="col-md-8 border-right">
                                        <div class="col-md-5">
                                            <a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">
                                            <img class="img-responsive"   src="upload/tintuc/{{$tin1['Hinh']}}" alt="">
                                            </a>
                                        </div>

                                        <div class="col-md-7">
                                        <h3>{{$tin1['TieuDe']}}</h3>
                                            <p>{{$tin1['TomTat']}}</p>
                                            <a class="btn btn-primary" href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">Xem thêm<span class="glyphicon glyphicon-chevron-right"></span></a>
                                        </div>

                                    </div>
                                    

                                    <div class="col-md-4">
                                        @foreach ($data->all() as $tintuc)
                                            <a href="tintuc/{{$tintuc['id']}}/{{$tintuc['TieuDeKhongDau']}}.html">
                                                <h4>
                                                    <span class="glyphicon glyphicon-list-alt"></span>
                                                    {{$tintuc['TieuDe']}}
                                                </h4>
                                            </a>
                                        @endforeach
                                        
                                    </div>
                                    
                                    <div class="break"></div>
                                </div>
                            @endif
                        @endforeach
		                <!-- end item -->	 
					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    @endsection