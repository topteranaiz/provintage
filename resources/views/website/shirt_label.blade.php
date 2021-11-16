@extends('template.master')
@section('content')
<section class="blog section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-12 offset-lg-0">
				<!-- Article 01 -->
                <article>
                    <br>
                    <h3 align="center"><i class="fa fa-picture-o"></i>&nbsp;ป้ายเสื้อ</h3>

                    <!-- Post Image -->
                    <div class="image">
                        {{-- <img src="image/shirt_label01.jpg" alt="article-01"> --}}
                        <img class="card-img-top" src="/image/shirt_label01.jpg" width="200" height="300" alt="Card image cap">

                    </div>
                    <div class="image">
                        {{-- <img src="image/shirt_label02.jpg" alt="article-01"> --}}
					<img class="card-img-top" src="/image/shirt_label02.jpg" width="200" height="300" alt="Card image cap">

                    </div>
                    <div class="image">
                        {{-- <img src="image/shirt_label03.jpg" alt="article-01"> --}}
					<img class="card-img-top" src="/image/shirt_label03.jpg" width="200" height="300" alt="Card image cap">

                    </div>
                    <div class="image">
                        {{-- <img src="image/shirt_label04.jpg" alt="article-01"> --}}
					<img class="card-img-top" src="/image/shirt_label04.jpg" width="200" height="300" alt="Card image cap">

                    </div>
                    <div class="image">
                        {{-- <img src="image/shirt_label05.jpg" alt="article-01"> --}}
					<img class="card-img-top" src="/image/shirt_label05.jpg" width="200" height="300" alt="Card image cap">

                    </div>
                </article>
			</div>
		</div>
	</div>
</section>
@endsection