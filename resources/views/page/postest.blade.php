@extends('layout/main')
@section('container')
<div class="container" style="margin-top: 30px; margin-bottom: 20px;">
	<div class="jumbotron" id="printpage" style="background-color: #FFF; width: 100%;">
		<div class="page-header">
			<div class="pull-left">
				<p style="font-weight: bold;">Hasil TEST</p>
			</div>
			<div class="pull-right">
				<p style="font-weight: bold;" id="tanggal">{{date('d')}}, {{date('M')}}, {{date('Y')}}</p>
				<button class="btn btn-success" id="btn-print">Cetak <i class="fa fa-print"></i></button>
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
					<th style="width:70%">Category</th>
					<th style="width:30%">Total</th>
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