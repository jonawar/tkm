@extends('layout/main')
@section('container')
<!-- Content -->    
<div class="container" style="margin-top: 30px; margin-bottom: 90px;">
	<!-- Material form login -->
	@if ($errors->count() > 0)
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
	<div class="card">
		<h5 class="card-header info-color white-text text-center py-4">
			<strong>Registrasi</strong>
		</h5>
		<!--Card content-->
		<div class="card-body px-lg-5 pt-4">
			<form action="{{url('/test')}}" method="post">
				@csrf
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Nama Lengkap</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nama" placeholder="Nama lengkap" value="{{old('nama')}}">
						@if($errors->has('nama'))<span class="help-block" style="color: red;">{{ ucfirst($errors->first('nama')) }}</span>@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Lisensi</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="license" placeholder="Lisensi" value="{{old('license')}}">
						@if($errors->has('license'))<span class="help-block" style="color: red;">{{ ucfirst($errors->first('license')) }}</span>@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="email" value="{{old('email')}}" class="form-control" name="email" placeholder="Email">
						@if($errors->has('email'))<span class="help-block" style="color: red;">{{ ucfirst($errors->first('email')) }}</span>@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Password</label>
					<div class="col-sm-10">
						<input type="password" value="{{old('password')}}" class="form-control" name="password" placeholder="******">
						@if($errors->has('password'))<span class="help-block" style="color: red;">{{ ucfirst($errors->first('password')) }}</span>@endif
					</div>
				</div>
		</div>
	</div>
	<!-- Material form login -->
</div>
<!-- End Content -->

<!-- Footer -->
<nav id="submit" style="border: 1px solid #E5DDDD;" class="navbar navbar-expand-lg bg-light fixed-bottom">
	<ul class="navbar nav ml-auto">
		<li class="nav-item">
			<span id="span"></span>
		</li>
		<li class="nav-item ml-3">
		</li>
		<li class="nav-item ml-3">
			<button type="submit" class="btn btn-success">Submit</button>
		</li>
	</ul>
</nav>
</form>
<!-- End Footer -->
@endsection()