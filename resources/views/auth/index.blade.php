<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
	
<title>Login</title>
    
<link rel="stylesheet" type="text/css" href="styles/style.css">
<link rel="stylesheet" type="text/css" href="styles/framework.css"><link rel="stylesheet" type="text/css" href="styles/fonts/css/all.min.css">
<link rel="stylesheet" type="text/css" href="styles/custom.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
</head>

<body>

<div id="preloader" class="preloader-light">
	<h1></h1>
	<div id="preload-spinner"></div>
	<p>Sedang Memuat</p>
</div>
	
<div id="page-transitions">
		
	<div id="page-content" class="page-content">	
		<div id="page-content-scroll"><!--Enables this element to be scrolled --> 	
			
			<div class="cover-item cover-item-full">
				<div class="cover-content cover-content-center">
					<div class="page-login content-boxed content-boxed-padding no-top no-bottom">
						<img class="preload-image login-bg responsive-image no-bottom" src="images/logo-majapait.png" data-src="images/logo-majapait.png" alt="img">
						<h3 class="uppercase ultrabold full-top no-bottom color-black">Masuk</h3>
						<p class="smaller-text half-bottom">Makanan Jajanan Pait</p>

						<form method="POST" action="{{ route('login') }}">
						@csrf
						<div class="page-login-field">
							<i class="fa fa-envelope"></i>
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
							<em>(wajib)</em>
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>	
						<div class="page-login-field half-bottom">
							<i class="fa fa-lock"></i>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
							<em>(wajib)</em>
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="page-login-links small-bottom">
							<a class="forgot float-right" href="register.html"><i class="fa fa-user float-right"></i>Buat Akun</a>
							<a class="create float-left" href="forgot-password.html"><i class="fa fa-eye"></i>Lupa Kata Sandi?</a>
							<div class="clear"></div>
						</div>
						<button type="submit" class="button button-red button-full button-rounded button-s uppercase ultrabold">{{ __('Login') }}</button>
					</form>
					</div>		
				</div>
			</div>	
			
		</div>  
	</div>
	
	<!-- <a href="#" class="back-to-top-badge back-to-top-small"><i class="fa fa-angle-up"></i>Back to Top</a> -->
</div>
	

<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script type="text/javascript" src="scripts/plugins.js"></script>

</body>