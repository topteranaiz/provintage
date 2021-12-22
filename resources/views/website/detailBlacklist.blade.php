@extends('template.master')
@section('content')
<section class="blog section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-12 offset-lg-0">
                <article>
                    <br>
                    <h1 align="center" style="font-weight: bold">&nbsp;รายละเอียดบุคคลที่ควรระวัง</h1>
                    <p style="font-size:18px;">รหัสบัตรประชาชน: {{ $dataBlacklists->card_id }}</p>
                    <p style="font-size:18px;">วันที่โอน: {{ $dataBlacklists->date_transfer }}</p>
                    <p style="font-size:18px;">ยอดโอน: {{ $dataBlacklists->price }} บาท</p>
                    <p style="font-size:18px;">เว็บประกาศขายของ: {{ $dataBlacklists->web }}</p>
                    @foreach ($dataBlacklists->getBlacklistImage as $item)
                    <div align="center">
                        <div class="col-md-6">
                            <div class="image">
                                <img class="card-img-top" src="{{ asset($item->image) }}" width="100" height="auto"alt="Card image cap">
                            </div><br>
                        </div>
                    </div>
                    @endforeach
                    
                </article>
			</div>
		</div>
	</div>
</section>
@endsection