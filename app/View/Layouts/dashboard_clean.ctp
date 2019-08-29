<?php
//váriaveis globais

echo $this->Html->docType('html5');
?>
<html lang="pt-br">

	<head>

		<title><?php echo $this->fetch('title');?></title>

		<?php echo $this->Html->charset(); ?>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<?php
			echo $this->Html->meta('icon');

			echo $this->Html->css('admin/bootstrap.min');
			echo $this->Html->css('admin/font-awesome.min');
			echo $this->Html->css('admin/themify-icons');
			echo $this->Html->css('admin/metisMenu');
			echo $this->Html->css('admin/owl.carousel.min');
			echo $this->Html->css('admin/slicknav.min');
			echo $this->Html->css('admin/typography');
			echo $this->Html->css('admin/default-css');
			echo $this->Html->css('admin/styles');
			echo $this->Html->css('admin/responsive');
		?>
		<link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
		<?PHP

			echo $this->Html->script('admin/vendor/modernizr-2.8.3.min');
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
	</head>

	<body>
		<!--[if lt IE 8]>
				<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
			<![endif]-->
		<!-- preloader area start -->
		<div id="preloader">
			<div class="loader"></div>
		</div>

		<?php echo $this->Flash->render(); ?>

		<?php echo $this->fetch('content'); ?>

		<?php echo $this->Html->script('admin/vendor/jquery-2.2.4.min'); ?>

		<?php echo $this->Html->script(array('admin/jquery',
										'admin/popper.min',
										'admin/bootstrap.min',
										'admin/owl.carousel.min',
										'admin/metisMenu.min',
										'admin/jquery.slimscroll.min',
										'admin/jquery.slicknav.min',
									)); ?>

		<!-- start chart js -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
		<!-- start highcharts js -->
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
		<!-- start amcharts -->
		<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
		<script src="https://www.amcharts.com/lib/3/ammap.js"></script>
		<script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
		<script src="https://www.amcharts.com/lib/3/serial.js"></script>
		<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
		<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

		<?php echo $this->Html->script(array('admin/line-chart', 	//all line chart activation
										'admin/pie-chart',		//all pie chart
										'admin/bar-chart',		//all bar chart
										'admin/maps',			//all map chart
										'admin/plugins',		//others plugins
										'admin/scripts',		//others plugins
									)); ?>
		<?php echo $this->Js->writeBuffer(); ?>
	</body>

</html>