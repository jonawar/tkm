@extends('layout/main')
@section('container')
<!-- Content -->    
<div class="container" style="margin-top: 30px; margin-bottom: 90px;">
	<div class="jumbotron" style="background-color: #FFF;">
		<p style="font-weight: bold;">SOAL TEST</p>
		<hr>
		<p class="lead">Tes ini terdiri dari 80 Soal dan 4 jawaban setiap soal. Jawab secara jujur dan spontan.</p>
		<form method="post" action="{{url('/test/postest')}}">
		@csrf
		<input type="hidden" name="nama" value="{{$nama}}">
		<input type="hidden" name="license" value="{{$license}}">
		<input type="hidden" name="email" value="{{$email}}">
		<div class="row">
			@php
				$totalsoal = 0;
			@endphp
			@foreach($soal as $data)
			@php
				$totalsoal += 1;
			@endphp
			<div class="col-sm-12" style="margin-top: 20px;">
				<div class="card">
					<div class="card-body">
						<table width="100%">
							<tr>
								<td width="5%">{{ $totalsoal }}</td>
								<td width="95%">{{ $data->soal }}</td>
							</tr>
							<tr>
								<td width="5%">
								<td>
									<table>
										<tr>
											<td><input type="radio" class="jawaban-<?php echo $data->nomor; ?>" name="jawaban[<?php echo $data->nomor; ?>]" value="0">&nbsp;Tidak Pernah</td>
										</tr>
										<tr>
											<td><input type="radio" class="jawaban-<?php echo $data->nomor; ?>" name="jawaban[<?php echo $data->nomor; ?>]" value="1">&nbsp;Jarang</td>
										</tr>
										<tr>
											<td><input type="radio" class="jawaban-<?php echo $data->nomor; ?>" name="jawaban[<?php echo $data->nomor; ?>]" value="2">&nbsp;Sering</td>
										</tr>
										<tr>
											<td><input type="radio" class="jawaban-<?php echo $data->nomor; ?>" name="jawaban[<?php echo $data->nomor; ?>]" value="3">&nbsp;Selalu</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			@endforeach
		</div>

	</div>
</div>
<!-- End Content -->


<!-- Modal Petunjuk -->
<div class="modal fade" id="tutorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tutorial Test</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>"Tes ini terdiri dari 80 Soal dan 4 jawaban setiap soal. Jawab secara jujur dan spontan."</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Mengerti</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->



<!-- Footer -->
<nav id="submit" style="border: 1px solid #E5DDDD;" class="navbar navbar-expand-lg bg-light fixed-bottom">
	<ul class="navbar nav ml-auto">
		<li class="nav-item">
			<span id="answered" style="color: #A8A7A7">0</span><span style="color: #A8A7A7">/</span><span id="total" style="color: #A8A7A7">{{$totalsoal}}</span> <span style="color: #A8A7A7">Soal Terjawab</span>
		</li>
		<li class="nav-item ml-3">
			<a style="font-size: 1.5em; cursor: help;" data-toggle="modal" data-target="#tutorial"><i class="fa fa-question-circle"></i></a>
		</li>
		<li class="nav-item ml-3">
			<button type="submit" id="btn-submit" class="btn btn-success" disabled>Submit</button>
		</li>
		</form>
	</ul>
</nav>



<!-- Tutorial -->
<!-- http://jsfiddle.net/AnWU3/4/ -->

<script type="text/javascript">
	$(document).on("change", "input[type=radio]", function(){
		var className = $(this).attr("class");
		
		// Count answered question
		countAnswered();

		// Enable submit button
		var totalQuestion = document.getElementById('total').innerHTML;
		countAnswered() >= totalQuestion ? $("#btn-submit").removeAttr("disabled") : $("#btn-submit").attr("disabled", "disabled");
	});

	// Count answered question
	function countAnswered(){
		var total = 0;
		var x = 0;
		var totalQuestion = document.getElementById('total').innerHTML;
		for(x=0;x <= totalQuestion;x++){
			var radioValue = $("input[name='jawaban["+x+"]']:checked").val();
			if(radioValue){
				total++;
			}
		}

		$("#answered").text(total);
		return total;
	}

	// Modal dialog tutorial
	$(document).ready(function(){
		$("#tutorial").modal("toggle");
	});

</script>

<!-- End Footer -->
@endsection()