<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
	
	<title>Dashboard</title>

	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css" rel="stylesheet">    
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/framework.css"><link rel="stylesheet" type="text/css" href="styles/fonts/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="styles/custom.css">
</head>

<body>

	<div id="preloader" class="preloader-light">
		<h1></h1>
		<div id="preload-spinner"></div>
		<p>Sedang Memuat</p>
	</div>

	<div id="page-transitions">
		<div id="header" class="header-logo-app header-dark">
			<a href="#" class="header-logo"></a>
			<div class="toggle toggle-dark-mode-header">
				<a href="#" class="toggle-4 header-icon-3 toggle-trigger">
					<i class="fa fa-moon bg-night-dark"></i>
					<span></span>
					<i class="fa fa-sun right-text bg-gray-light"></i>
				</a>
			</div>
			<a data-deploy-menu="notification-bell" href="#"class="header-icon header-icon-2 no-border font-14"><i class="fa fa-bell"></i></a>
			<a href="{{route('setting')}}" class="header-icon header-icon-4 no-border font-14"><i class="fa fa-cog"></i></a>
		</div>	

		<div id="page-content" class="page-content">	
			<div id="page-content-scroll" class="header-clear-large"><!--Enables this element to be scrolled --> 	

				<div class="content">
					<h1 class="font-21 uppercase marbot-20">Dashboard</h1>
					<div class="one-half">
						<div class="select-box select-box-2">
							<select>
								<option value="a">Outlet 1</option>
								<option value="b">Mingguan</option>
								<option value="c">Bulanan</option>
								<option value="d">Tahunan</option>
							</select>
						</div>
					</div>
					<div class="one-half last-column">
						<div class="select-box select-box-2 half-bottom">
							<select>
								<option value="volvo">Nilai</option>
								<option value="saab">Jumlah</option>
							</select>
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="content-fullscreen">
					<h3 class="center-text uppercase ultrabold marbot-20">Penjualan Produk Teratas</h3>
					<div class="content">
							<canvas class="chart" id="pie-chart"/></canvas>
					</div>
				</div>

				<div class="decoration decoration-margins"></div>

				{{-- <div class="content-fullscreen no-bottom">
					<h3 class="center-text uppercase ultrabold marbot-20">Penjualan Per Kategori</h3>
					<div class="content no-bottom">
						<canvas class="chart" id="doughnut-chart"/></canvas>
					</div>
				</div> --}}

				<div class="decoration decoration-margins"></div>

				<div class="content-fullscreen no-bottom">
					<h3 class="center-text uppercase ultrabold marbot-20">Nominal Penjualan Tertinggi</h3>
					<div class="content no-bottom">
						<canvas class="chart" id="polar-chart"/></canvas>
					</div>
				</div>

				<div class="decoration decoration-margins"></div>

				<!-- All other charts must be disabled-->
				<canvas class="chart disabled" id="vertical-chart"/></canvas>
				<canvas class="chart disabled" id="horizontal-chart"/></canvas>
				<canvas class="chart disabled" id="line-chart"/></canvas>

				<div class="fixed-navigation">
					<div class="navigation-item">
						<a class="active" href="{{route('home')}}"><i class="fa fa-home"></i>Dashboard</a>
					</div>
					<div class="navigation-item">
						<a href="{{route('sales')}}"><i class="fa fa-tags"></i>Penjualan</a>
					</div>
					<div class="navigation-item">
						<a data-toast="coming-soon-toast" href="#"><i class="fa fa-shopping-basket"></i>Pembelian</a>
					</div>
					<div class="navigation-item">
						<a data-toast="coming-soon-toast" href="#"><i class="fa fa-boxes"></i>Inventori</a>
					</div>
					<div class="navigation-item">
						<a data-toast="coming-soon-toast" href="#"><i class="fa fa-users"></i>HR</a>
					</div>
				</div>

				<p id="coming-soon-toast" class="toast toast-top toast-large bg-blue-dark"><i class="fa fa-info"></i>Tahap Pengembangan</p>
			</div>  
		</div>

		<a href="#" class="back-to-top-badge back-to-top-small"><i class="fa fa-angle-up"></i>Back to Top</a>

		<div id="notification-bell" data-menu-size="450" class="menu-wrapper menu-light menu-modal menu-large activate-page" style="display: block; height: 450px; margin-top: -225px; transition: all 250ms ease 0s;">
			<div class="menu-scroll">
				<div class="menu-socials">
					<h5 class="center-text uppercase ultrabold header-clear-large marbot-20">Pemberitahuan</h5>
				</div>

				<div class="menu">
					<ul class="link-list">		
						<li><a class="menu-item" href="#"><i class="font-15 fa color-blue-dark fa-info-circle"></i><strong>Ada berita bagus nih guys</strong></a></li>
						<li><a class="menu-item" href="#"><i class="font-15 fa color-blue-dark fa-info-circle"></i><strong>Ada berita bagus nih guys</strong></a></li>
						<li><a class="menu-item" href="#"><i class="font-15 fa color-blue-dark fa-info-circle"></i><strong>Ada berita bagus nih guys</strong></a></li>
						<li><a class="menu-item" href="#"><i class="font-15 fa color-blue-dark fa-info-circle"></i><strong>Ada berita bagus nih guys</strong></a></li>
						<li><a class="menu-item" href="#"><i class="font-15 fa color-blue-dark fa-info-circle"></i><strong>Ada berita bagus nih guys</strong></a></li>
						<li><a class="menu-item" href="#"><i class="font-15 fa color-blue-dark fa-info-circle"></i><strong>Ada berita bagus nih guys</strong></a></li>
						<li><a class="menu-item" href="#"><i class="font-15 fa color-blue-dark fa-info-circle"></i><strong>Ada berita bagus nih guys</strong></a></li>
						<li><a class="menu-item" href="#"><i class="font-15 fa color-blue-dark fa-info-circle"></i><strong>Ada berita bagus nih guys</strong></a></li>
						<li><a class="menu-item" href="#"><i class="font-15 fa color-blue-dark fa-info-circle"></i><strong>Ada berita bagus nih guys</strong></a></li>
						<li><a class="menu-item" href="#"><i class="font-15 fa color-blue-dark fa-info-circle"></i><strong>Ada berita bagus nih guys</strong></a></li>
						<li><a class="menu-item" href="#"><i class="font-15 fa color-blue-dark fa-info-circle"></i><strong>Ada berita bagus nih guys</strong></a></li>
						<li><a class="menu-item" href="#"><i class="font-15 fa color-blue-dark fa-info-circle"></i><strong>Ada berita bagus nih guys</strong></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	

	
	<script type="text/javascript" src="scripts/jquery.js"></script>
	<script type="text/javascript" src="scripts/plugins.js"></script>
	<script type="text/javascript" src="scripts/custom.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			if($('.chart').length > 0){
			var loadJS = function(url, implementationCode, location){
				var scriptTag = document.createElement('script');
				scriptTag.src = url;
				scriptTag.onload = implementationCode;
				scriptTag.onreadystatechange = implementationCode;
				location.appendChild(scriptTag);
			};
			var call_charts_to_page = function(){
				new Chart(document.getElementById("pie-chart"), {
					type: 'pie',
					data: {
					  labels: {!!json_encode($kategori)!!},
					  datasets: [{
						backgroundColor: ["#4FC1E9", "#FC6E51", "#ED5565", "#A0D468","#293462",
										"#216583","#f76262","#f76262","#fff1c1","#ed3833","#f9ed69",
										"#f08a5d","#b83b5e","#6a2c70","#30e3ca","#ffc8c8","#ff9a00","#ff165d",
										"#1fab89","#62d2a2"],
						borderColor:"rgba(255,255,255,0.2)",
						data: {!!json_encode($datatotal)!!}
					  }]
					},
					options: {
						legend: {display: true, position:'bottom', labels:{fontSize:13, padding:15,boxWidth:12},},
						tooltips:{enabled:true}, animation:{duration:1500},
					},
				});		

				// new Chart(document.getElementById("doughnut-chart"), {
				// 	type: 'doughnut',
				// 	data: {
				// 	  labels: ["Apple Inc.", "Samsung", "Google", "One Plus", "Huawei"],
				// 	  datasets: [{
				// 		backgroundColor: ["#CCD1D9", "#5D9CEC","#FC6E51", "#434A54", "#4FC1E9"],
				// 		borderColor:"rgba(255,255,255,0.2)",
				// 		data: [5500,4000,2000,3000,1000]
				// 	  }]
				// 	},
				// 	options: {
				// 		legend: {display: true, position:'bottom', labels:{fontSize:13, padding:15,boxWidth:12},},
				// 		tooltips:{enabled:true}, animation:{duration:1500}, layout:{ padding: {bottom: 30}}
				// 	}
				// });		

				new Chart(document.getElementById("polar-chart"), {
					type: 'polarArea',
					data: {
					  labels: {!!json_encode($kategori)!!},
					  datasets: [{
						backgroundColor: ["#CCD1D9", "#5D9CEC","#FC6E51"],
						borderColor:"rgba(255,255,255,0.2)",
						data: {!!json_encode($datatotal)!!}
					  }]
					},
					options: {
						legend: {display: true, position:'bottom', labels:{fontSize:13, padding:15,boxWidth:12},},
						tooltips:{enabled:true}, animation:{duration:1500}, layout:{ padding: {bottom: 30}}
					}
				});			

				new Chart(document.getElementById("vertical-chart"), {
					type: 'bar',
					data: {
					  labels: ["2010", "2015", "2020", "2025"],
					  datasets: [
						{
						  label: "iOS",
						  backgroundColor: "#A0D468",
						  data: [900,1000,1200,1400]
						}, {
						  label: "Android",
						  backgroundColor: "#4A89DC",
						  data: [890,950,1100,1300]
						}
					  ]
					},
					options: {
						legend: {display: true, position:'bottom', labels:{fontSize:13, padding:15,boxWidth:12},},
						title: {display: false}
					}
				});	


				new Chart(document.getElementById("horizontal-chart"), {
					type: 'horizontalBar',
					data: {
					  labels: ["2010", "2013", "2016", "2020"],
					  datasets: [
						{
						  label: "Mobile",
						  backgroundColor: "#BF263C",
						  data: [330,400,580,590]
						}, {
						  label: "Responsive",
						  backgroundColor: "#EC87C0",
						  data: [390,450,550,570]
						}
					  ]
					},
					options: {
						legend: {display: true, position:'bottom', labels:{fontSize:13, padding:15,boxWidth:12},},
						title: {display: false}
					}
				});	

				new Chart(document.getElementById("line-chart"), {
				  type: 'line',
				  data: {
					labels: [2000,2005,2010,2015,2020],
					datasets: [{ 
						data: [500,400,300,200,300],
						label: "Produk 1",
						borderColor: "#D8334A"
					  }, { 
						data: [0,100,300,400,500],
						label: "Produk 2",
						borderColor: "#4A89DC"
					  }
					]
				  },
				  options: {
					legend: {display: true, position:'bottom', labels:{fontSize:13, padding:15,boxWidth:12},},
					title: {display: false}
				  }
				});
			}
			loadJS('scripts/charts.js', call_charts_to_page, document.body);
		}
		} );
	</script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.jqueryui.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.datatable-sales-majapait').DataTable();
		} );
	</script>

</body>