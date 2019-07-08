<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />

<title>Settings</title>

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
	<div id="header" class="header-logo-app header-dark">
		<a href="#" class="header-title back-button">Opsi</a>
		<a href="#" class="header-logo disabled"></a>
		<a href="#" class="header-icon back-button header-icon-1 font-10 no-border"><i class="fa fa-chevron-left"></i></a>
	</div>	
	
	<div id="page-content" class="page-content">	
		<div id="page-content-scroll"><!--Enables this element to be scrolled --> 	

			<div class="content">
				<ul class="link-list">		
					<li><a href="profile.html"><i class="font-18 fa fa-user color-red-dark"></i><span>Profil</span></a></li>				
					<li><a href="faq.html"><i class="font-18 fa fa-info-circle color-red-dark"></i><span>FAQ</span></a></li>				
					<li><a data-deploy-menu="logout" href="#"><i class="font-18 fa fa-sign-out-alt color-red-dark"></i><span>Keluar</span></a></li>				
				</ul>
			</div>
			
			<div id="logout" data-menu-size="260" class="menu-wrapper menu-light menu-modal">
				<h1 class="center-text half-top full-bottom color-green-light"><i class="fa fa-sign-out-alt fa-2x"></i></h1>
				<h1 class="no-top uppercase ultrabold no-bottom center-text">Keluar</h1>
				<p class="opacity-70 center-text full-bottom">
					Anda yakin ingin keluar?
				</p>
				<div class="one-half">
				<a href="{{route('logout')}}" class="button button-rounded button-s button-full button-green uppercase ultrabold">Ya</a>
				</div>
				<div class="one-half last-column">
					<a href="#" class="close-menu button button-rounded button-s button-full button-red uppercase ultrabold">Tidak</a>
				</div>
			</div>	
	
		</div>  
	</div>
</div>
	

<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script type="text/javascript" src="scripts/plugins.js"></script>

</body>