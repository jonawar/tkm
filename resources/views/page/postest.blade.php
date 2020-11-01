@extends('layout/main')
@section('container')
<div class="container" style="margin-top: 30px; margin-bottom: 20px;">
	<div class="jumbotron" id="printpage" style="background-color: #FFF; width: 100%;">
		<div class="page-header">
			<div class="pull-left">
				<p style="font-weight: bold;">HASIL TES</p>
			</div>
			<div class="pull-right">
				<p style="font-weight: bold;" id="tanggal">{{date('d')}}, {{date('M')}}, {{date('Y')}}</p>
				<button class="btn btn-success" id="btn-print">Download Sertifikat <i class="fa fa-print"></i></button>
			</div>
			<div class="clearfix"></div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-5"><p class="lead">Nama : {{$nama}}</p></div>
			<div class="col-sm-5"><p class="lead">Email : {{$email}}</p></div>
		</div>
		<table class="table table-bordered table-hover" style="margin-top: 20px;">
			<thead>
				<tr>
					<th style="width:70%">KECERDASAN</th>
					<th style="width:30%">TOTAL</th>
				</tr>
			</thead>
			@foreach($jawaban as $key => $val)
			<tbody>
				<tr>
					<td>{{ $val->nama_kategori }}</td>
					<td>{{ $val->total }}</td>
				</tr>
			</tbody>
			@endforeach
		</table>
		@foreach($deskripsi as $key => $val)
			<div class="col-md-12">
				<div class="col-md-12 border rounded" style="margin-top: 10px;">
					<div class="col-md-12" style="font-weight: bold;font-size : 23px;">{{ $val->type }}</div>
					<!-- <div class="col-md-12">{{ $val->type_description }}</div> -->
					<div class="col-md-12">
						<div class="col-md-12" style="font-weight: bold;">Deskripsi</div>
						<div class="col-md-12">{{ $val->description }}</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-12" style="font-weight: bold;">Poin Perhatian</div>
						<div class="col-md-12">{{ $val->poin }}</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-12" style="font-weight: bold;">Cara Mengembangkan</div>
						<div class="col-md-12">{!! $val->improvement !!}</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>



<script type="text/javascript" src="{{asset('/js/Chart.js')}}"></script>

<!-- Chart 1 -->
<script type="text/javascript">
	$(document).on("click", "#btn-print", function(e){
		e.preventDefault();
		window.print();
	});
</script>
@endsection