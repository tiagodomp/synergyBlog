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
			echo $this->Html->script('admin/vendor/jquery-2.2.4.min');
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
		<!-- preloader area end -->
		<!-- page container area start -->
		<div class="page-container">

			<!-- sidebar menu area start -->
			<nav class="sidebar-menu">
				<div class="sidebar-header">
					<div class="logo">
						<?php echo $this->Html->image('logo-white.png',
												array(
													'alt' 		=> 'Logo do blog',
													'border' 	=> '0',
													'url'		=> array('controller' => 'Pages', 'action' => 'admin_home' )
													)
												);
						?>
					</div>
				</div>
				<div class="main-menu">
					<div class="menu-inner">
						<nav>
							<ul class="metismenu" id="menu">
								<li><a href="<?PHP echo $this->Html->url(array('controller' => 'Pages', 'action' => 'admin_home')) ?>"><i class="ti-dashboard"></i> <span>Home</span></a></li>
								<li>
									<a href="javascript:void(0)" aria-expanded="true"><i class="ti-book"></i><span>Postagens</span></a>
									<ul class="collapse">
										<li><a href="<?PHP echo $this->Html->url(array('controller' => 'Posts', 'action' => 'admin_home')) ?>">Posts</a></li>
										<li><a href="<?PHP echo $this->Html->url(array('controller' => 'Posts', 'action' => 'admin_news')) ?>">Notícias</a></li>
										<li><a href="<?PHP echo $this->Html->url(array('controller' => 'Posts', 'action' => 'admin_analyzes')) ?>">Análises</a></li>
									</ul>
								</li>
								<li>
									<a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>Usuários</span></a>
									<ul class="collapse">
										<li><a href="<?PHP echo $this->Html->url(array('controller' => 'Users', 'action' => 'admin_home_adm')) ?>">Administradores</a></li>
										<li><a href="<?PHP echo $this->Html->url(array('controller' => 'Users', 'action' => 'admin_home_master')) ?>">Mestres</a></li>
										<li><a href="<?PHP echo $this->Html->url(array('controller' => 'Users', 'action' => 'admin_home_worker')) ?>">Funcionários</a></li>
										<li><a href="<?PHP echo $this->Html->url(array('controller' => 'Users', 'action' => 'admin_candidatos')) ?>">Candidatos</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</nav>
			<!-- sidebar menu area end -->


			<!-- main content area start -->
			<div class="main-content">
				<!-- header area start -->
				<header class="header-area">
					<div class="row align-items-center">
						<!-- nav and search button -->
						<div class="col-md-6 col-sm-8 clearfix">
							<div class="nav-btn pull-left">
								<span></span>
								<span></span>
								<span></span>
							</div>
							<div class="search-box pull-left">
								<form action="#">
									<input type="text" name="search" placeholder="buscar..." required>
									<i class="ti-search"></i>
								</form>
							</div>
						</div>
						<!-- profile info & task notification -->
						<div class="col-md-6 col-sm-4 clearfix">
							<ul class="notification-area pull-right">
								<li id="full-view"><i class="ti-fullscreen"></i></li>
								<li id="full-view-exit"><i class="ti-zoom-out"></i></li>

								<!-- Notificações -->
								<li class="dropdown">
									<i class="ti-bell dropdown-toggle" data-toggle="dropdown">
										<span><?PHP echo $data['notifications']['count']; ?></span>
									</i>
									<div class="dropdown-menu bell-notify-box notify-box">
										<span class="notify-title">Você tem <?PHP echo $data['notifications']['count']; ?> novas notificações
											<a href="<?php echo $this->Html->url(array('controller' => 'Profiles', 'action' => 'admin_notifications'));?>">Ver todas</a>
										</span>
										<div class="nofity-list">
											<?PHP foreach($data['notifications']['all'] as $notify): ?>
											<a href="<?php echo $this->Html->url(array('controller' => 'Posts', 'action' => 'admin_notification', $notify['uuid']));?>" class="notify-item">
												<div class="notify-thumb"><i class="ti-pin-alt btn-<?PHP echo $notify['type']; ?>"></i></div>
												<div class="notify-text">
													<p><?PHP echo $notify['title']; ?></p>
													<span><?PHP echo $notify['created']; ?></span>
												</div>
											</a>
											<?php endforeach; ?>
										</div>
									</div>
								</li>

								<!-- Mensagens -->
								<li class="dropdown">
									<i class="fa fa-envelope-o dropdown-toggle" data-toggle="dropdown">
										<span><?PHP echo $data['messages']['count']; ?></span></i>
									<div class="dropdown-menu notify-box nt-enveloper-box">
										<span class="notify-title">Você tem <?PHP echo $data['messages']['count']; ?> novas mensagens
											<a href="<?php echo $this->Html->url(array('controller' => 'Profiles', 'action' => 'admin_messages'));?>">Ver Todas</a>
										</span>
										<div class="nofity-list">
											<?PHP foreach($data['messages']['all'] as $msg): ?>
											<a href="<?php echo $this->Html->url(array('controller' => 'Posts', 'action' => 'admin_message', $msg['uuid']));?>" class="notify-item">
												<div class="notify-thumb">
													<?PHP echo $this->Html->image($msg['author']['img'], array('alt' => $msg['author']['name'])); ?>
												</div>
												<div class="notify-text">
													<p><?PHP echo $data['author']['name']; ?></p>
													<span class="msg"><?PHP echo $data['author']['msg']; ?></span>
													<span><?PHP echo $data['created']; ?></span>
												</div>
											</a>
											<?PHP endforeach; ?>
										</div>
									</div>
								</li>
								<li class="settings-btn">
									<i class="ti-settings"></i>
								</li>
							</ul>
						</div>
					</div>
				</header>
				<!-- header area end -->
				<!-- page title area start -->
				<nav class="page-title-area">
					<div class="row align-items-center">
						<div class="col-sm-6">
							<div class="breadcrumbs-area clearfix">
								<h4 class="page-title pull-left">Dashboard</h4>
								<ul class="breadcrumbs pull-left">
									<li><a href="index.html">Home</a></li>
									<li><span>Dashboard</span></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-6 clearfix">
							<div class="user-profile pull-right">
								<?php echo $this->Html->image($data['profile']['img'],
												array(
													'alt' 		=> $data['profile']['name'],
													'border' 	=> '0',
													'url'		=> array('controller' => 'Profiles', 'action' => 'admin_home' ),
													'class'		=> 'avatar user-thumb',
													)
												);
								?>
								<h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php $data['profile']['first_name']; ?><i class="fa fa-angle-down"></i></h4>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="<?php echo $this->Html->url(array('controller' => 'Profiles', 'action' => 'admin_home'));?>">Meu perfil</a>
									<a class="dropdown-item" href="<?php echo $this->Html->url(array('controller' => 'Profiles', 'action' => 'admin_config'));?>">Configurações</a>
									<a class="dropdown-item" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'logout'));?>">Sair</a>
								</div>
							</div>
						</div>
					</div>
				</nav>
				<!-- page title area end -->
				<main class="main-content-inner">
					<div class="row">
						<?PHP echo $this->fetch('content'); ?>
					</div>
				</main>
			</div>
			<!-- main content area end -->


			<!-- footer area start-->
			<footer>
				<div class="footer-area">
					<p>© Copyright 2018. All right reserved. Template by <a href="#">Tiago Pereira</a>.</p>
				</div>
			</footer>
			<!-- footer area end-->
		</div>
		<!-- page container area end -->


		<!-- offset area start -->
		<div class="offset-area">
			<div class="offset-close"><i class="ti-close"></i></div>
			<ul class="nav offset-menu-tab">
				<li><a class="active" data-toggle="tab" href="#activity">Atividades</a></li>
				<li><a data-toggle="tab" href="#settings">Configurações</a></li>
			</ul>
			<div class="offset-content tab-content">
				<div id="activity" class="tab-pane fade in show active">
					<div class="recent-activity">
						<div class="timeline-task">
							<div class="icon bg1">
								<i class="fa fa-envelope"></i>
							</div>
							<div class="tm-title">
								<h4>Rashed sent you an email</h4>
								<span class="time"><i class="ti-time"></i>09:35</span>
							</div>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
							</p>
						</div>
						<div class="timeline-task">
							<div class="icon bg2">
								<i class="fa fa-check"></i>
							</div>
							<div class="tm-title">
								<h4>Added</h4>
								<span class="time"><i class="ti-time"></i>7 Minutes Ago</span>
							</div>
							<p>Lorem ipsum dolor sit amet consectetur.
							</p>
						</div>
						<div class="timeline-task">
							<div class="icon bg2">
								<i class="fa fa-exclamation-triangle"></i>
							</div>
							<div class="tm-title">
								<h4>You missed you Password!</h4>
								<span class="time"><i class="ti-time"></i>09:20 Am</span>
							</div>
						</div>
						<div class="timeline-task">
							<div class="icon bg3">
								<i class="fa fa-bomb"></i>
							</div>
							<div class="tm-title">
								<h4>Member waiting for you Attention</h4>
								<span class="time"><i class="ti-time"></i>09:35</span>
							</div>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
							</p>
						</div>
						<div class="timeline-task">
							<div class="icon bg3">
								<i class="ti-signal"></i>
							</div>
							<div class="tm-title">
								<h4>You Added Kaji Patha few minutes ago</h4>
								<span class="time"><i class="ti-time"></i>01 minutes ago</span>
							</div>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
							</p>
						</div>
						<div class="timeline-task">
							<div class="icon bg1">
								<i class="fa fa-envelope"></i>
							</div>
							<div class="tm-title">
								<h4>Ratul Hamba sent you an email</h4>
								<span class="time"><i class="ti-time"></i>09:35</span>
							</div>
							<p>Hello sir , where are you, i am egerly waiting for you.
							</p>
						</div>
						<div class="timeline-task">
							<div class="icon bg2">
								<i class="fa fa-exclamation-triangle"></i>
							</div>
							<div class="tm-title">
								<h4>Rashed sent you an email</h4>
								<span class="time"><i class="ti-time"></i>09:35</span>
							</div>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
							</p>
						</div>
						<div class="timeline-task">
							<div class="icon bg2">
								<i class="fa fa-exclamation-triangle"></i>
							</div>
							<div class="tm-title">
								<h4>Rashed sent you an email</h4>
								<span class="time"><i class="ti-time"></i>09:35</span>
							</div>
						</div>
						<div class="timeline-task">
							<div class="icon bg3">
								<i class="fa fa-bomb"></i>
							</div>
							<div class="tm-title">
								<h4>Rashed sent you an email</h4>
								<span class="time"><i class="ti-time"></i>09:35</span>
							</div>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
							</p>
						</div>
						<div class="timeline-task">
							<div class="icon bg3">
								<i class="ti-signal"></i>
							</div>
							<div class="tm-title">
								<h4>Rashed sent you an email</h4>
								<span class="time"><i class="ti-time"></i>09:35</span>
							</div>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
							</p>
						</div>
					</div>
				</div>
				<div id="settings" class="tab-pane fade">
					<div class="offset-settings">
						<h4>General Settings</h4>
						<div class="settings-list">
							<div class="s-settings">
								<div class="s-sw-title">
									<h5>Notifications</h5>
									<div class="s-swtich">
										<input type="checkbox" id="switch1" />
										<label for="switch1">Toggle</label>
									</div>
								</div>
								<p>Keep it 'On' When you want to get all the notification.</p>
							</div>
							<div class="s-settings">
								<div class="s-sw-title">
									<h5>Show recent activity</h5>
									<div class="s-swtich">
										<input type="checkbox" id="switch2" />
										<label for="switch2">Toggle</label>
									</div>
								</div>
								<p>The for attribute is necessary to bind our custom checkbox with the input.</p>
							</div>
							<div class="s-settings">
								<div class="s-sw-title">
									<h5>Show your emails</h5>
									<div class="s-swtich">
										<input type="checkbox" id="switch3" />
										<label for="switch3">Toggle</label>
									</div>
								</div>
								<p>Show email so that easily find you.</p>
							</div>
							<div class="s-settings">
								<div class="s-sw-title">
									<h5>Show Task statistics</h5>
									<div class="s-swtich">
										<input type="checkbox" id="switch4" />
										<label for="switch4">Toggle</label>
									</div>
								</div>
								<p>The for attribute is necessary to bind our custom checkbox with the input.</p>
							</div>
							<div class="s-settings">
								<div class="s-sw-title">
									<h5>Notifications</h5>
									<div class="s-swtich">
										<input type="checkbox" id="switch5" />
										<label for="switch5">Toggle</label>
									</div>
								</div>
								<p>Use checkboxes when looking for yes or no answers.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- offset area end -->


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