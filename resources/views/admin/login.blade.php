<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>My Inventory</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

		<style>
			 @import url('https://fonts.googleapis.com/css2?family=Faustina:wght@500&display=swap');
			
			body {
				background-image: url("{{ asset('assets/img/warehouse.jpg') }}");
				background-size: cover;
				background-repeat: no-repeat;
			}
			 /* .container{
				display: flex;
				width: 700px;
				height: 300px;
			}
			.about{
				display: flex;
				background-color:#F86F03; 
				width: 360px;
				height: 290px;
				border-radius: 6px 0 0 6px;			
			}
			.about h2{
				font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
				text-align: center;
				line-height: .9;    
				font-size: 40px;     
				color: black
			}

			.text{
				margin: auto;
			} */
/* 
			.d1 {
				width: 380px;
				height: 290px;
				position: absolute;
				z-index: -1;
				right: 350px;
				top: 150px;
				background-color: #f86d0341;
			} */
			/* .images {
				width: 100vw;
            	height: 100vh;
			} */

			/* .login {
				position: absolute;
			} */

		</style>
	</head>
	<body class="hold-transition login-page">
		{{-- <div class="d1"></div> --}}
		{{-- <div class="images">
			<img src="{{ asset('assets/img/warehouse.jpg') }}" alt="">
		</div> --}}
		<div class="login-box">
			<!-- /.login-logo -->
			@include('admin.message')
			<div class="card card-outline card-primary">
					<div class="card-header text-center">
					<a href="#" class="h3">Login</a>
					</div>
					<div class="card-body">
					<p class="login-box-msg">Sign in to start your session</p>
					<form action="{{ route('admin.authenticate') }}" method="post">
						@csrf
							<div class="input-group mb-3">
							<input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
							<div class="input-group-append">
									<div class="input-group-text">
									<span class="fas fa-envelope"></span>
									</div>
							</div>

							@error('email')
								<p class="invalid-feedback">{{ $message }}</p> 
							@enderror

							</div>
							<div class="input-group mb-3">
							<input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
							<div class="input-group-append">
									<div class="input-group-text">
									<span class="fas fa-lock"></span>
									</div>
							</div>
							@error('password')
								<p class="invalid-feedback">{{ $message }}</p> 
							@enderror
							</div>
							<div class="row">

							<div class="col-4">
									<button type="submit" class="btn btn-primary btn-block">Login</button>
							</div>
							<!-- /.col -->
							</div>
					</form>					
					</div>
					<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>

		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
		<!-- AdminLTE for demo purposes -->
		{{-- <script src="js/demo.js"></script> --}}
	</body>
</html