<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
	
<title>Sales</title>
    
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="styles/style.css">
<link rel="stylesheet" type="text/css" href="styles/framework.css"><link rel="stylesheet" type="text/css" href="styles/fonts/css/all.min.css">
<link rel="stylesheet" type="text/css" href="styles/custom.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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

	<div class="toggle">
			<h5 class="toggle-title uppercase ultrabold">Android Style 2</h5>
			<a href="#" class="toggle-4 toggle-trigger">
				<i class="fa fa-check bg-green-dark"></i>
				<span></span>
				<i class="fa fa-times right-text bg-orange-dark"></i>
			</a>	
			<div class="toggle-content">
				<img data-src="images/pictures/6w.jpg" src="images/empty.png" alt="img" class="preload-image responsive-image">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
					Fusce hendrerit dictum vestibulum. Duis vel nulla congue,
					pharetra ligula id, luctus lorem. 
				</p>
			</div>
		</div>
	<div id="page-content" class="page-content">	
		<div id="page-content-scroll" class="header-clear-large"><!--Enables this element to be scrolled --> 	

			<div class="content">
				<div class="one-half">
					<div class="select-box select-box-2">	
						<select>
							<option value="weekly">Mingguan</option>
							<option value="monthly">Bulanan</option>	
							<option value="yearly">Tahunan</option>
						</select>
					</div>
				</div>
				<div class="one-half last-column">
					<div class="select-box select-box-2">	
							<input type="text" name="datefilter" value=""/>
					</div>
				</div>
				<div class="clear"></div>
				<!-- <div class="container search-input-container search-input-dark search-input-light">
					<div class="search-boxes">
						<div class="search">
							<i class="fa fa-search"></i>
							<input type="text" placeholder="" data-search="">
						</div>
					</div>
				</div> -->
			</div>

			<div class="content-fullscreen">
				<h3 class="center-text uppercase ultrabold no-bottom">Penjualan Produk</h3>
				<p class="center-text small-text color-blue-dark half-bottom">Tahunan</p>
				<div class="content">
					<canvas class="chart" id="line-chart"/></canvas>
				</div>
			</div>

			<canvas class="chart enable" id="vertical-chart"/></canvas>
			<canvas class="chart disabled"  id="horizontal-chart"/></canvas>
			<canvas class="chart disabled" id="pie-chart"/></canvas>
			<canvas class="chart disabled" id="doughnut-chart"/></canvas>
			<canvas class="chart disabled" id="polar-chart"/></canvas>

			<div class="content">
				<a data-deploy-menu="sync-now" href="#" class="button button-round button-green button-center uppercase ultrabold"><i class="fa fa-sync"></i> Sinkronisasi </a>
			</div>

			<div class="content">
				<table class="table table-striped table-bordered dt-responsive nowrap datatable-sales-majapait" style="width:100%">
					<thead>
						<tr>
							<th>Tanggal & Waktu</th>
							<th>Produk</th>
							<th>Kategori</th>
							{{-- <th>SKU</th> --}}
							<th>Terjual</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $sales_invoice)
						<tr>
							<td>{{ Carbon\Carbon::parse($sales_invoice->posting_date)->format('d-m-Y') }}</td>
							<td>{{$sales_invoice->description}}</td>
							<td>{{$sales_invoice->item_group}}</td>
							{{-- <td></td> --}}
							<td>{{$sales_invoice->total_qty}}</td>
							<td>{{$sales_invoice->total}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="fixed-navigation">
				<div class="navigation-item">
					<a href="{{route('home')}}"><i class="fa fa-home"></i>Dashboard</a>
				</div>
				<div class="navigation-item">
					<a class="active" href="{{route('sales')}}"><i class="fa fa-tags"></i>Penjualan</a>
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

			<div id="sync-now" data-menu-size="260" class="menu-wrapper menu-light menu-modal">
				<h1 class="center-text half-top full-bottom color-green-light"><i class="fa fa-sync fa-2x"></i></h1>
				<h1 class="no-top uppercase ultrabold no-bottom center-text">Sinkronisasi Data</h1>
				<p class="opacity-70 center-text full-bottom">
					Anda yakin ingin sinkronisasi data sekarang?
				</p>
				<div class="one-half">
					<a href="{{route('sync')}}" class="button button-rounded button-s button-full button-green uppercase ultrabold">Ya</a>
				</div>
				<div class="one-half last-column">
					<a href="#" class="close-menu button button-rounded button-s button-full button-red uppercase ultrabold">Tidak</a>
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
					</ul>
				</div>
			</div>
		</div>
</div>

<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
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
<script type="text/javascript">
	$(function() {
	
	  $('input[name="datefilter"]').daterangepicker({
		  autoUpdateInput: false,
		  locale: {
			  cancelLabel: 'Clear'
		  }
	  });
	
	  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
		  $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
	  });
	
	  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
		  $(this).val('');
	  });
	
	});
	</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</body>
</html>