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

		<?php echo $this->Html->script(array('admin/vendor/jquery-2.2.4.min')); ?>
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


		<?php echo $this->Html->script(array('admin/jquery',
										'admin/popper.min',
										'admin/bootstrap.min',
										'admin/owl.carousel.min',
										'admin/metisMenu.min',
										'admin/jquery.slimscroll.min',
										'admin/jquery.slicknav.min',
										'admin/plugins',		//others plugins
										'admin/scripts',		//others plugins
									)); ?>
		<?php echo $this->Js->writeBuffer(); ?>
	</body>

</html>