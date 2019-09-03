<?php
//váriaveis globais
$redis = new Redis();
$redis->connect('redis', 6379);

$data = json_decode($redis->get('blog_data'), true);

echo $this->Html->docType('html5');
?>
<html lang="pt-br" ng-app="blog">

	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
		<title><?php echo $this->fetch('title');?></title>


		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php echo $this->Html->charset(); ?>


		<?php
			echo $this->Html->meta('icon');

			echo $this->Html->css('bootstrap');
			echo $this->Html->css('styles');
			echo $this->Html->css('fonts/ionicons');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');

			//pr($data); exit;
		?>
		<!-- Font -->
		<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,600,700" rel="stylesheet">
	</head>

	<body ng-controller="BlogController">

		<header>
			<div class="bg-191">
				<div class="container">
					<div class="oflow-hidden color-ash font-9 text-sm-center ptb-sm-5">

						<ul class="float-left float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10">
							<li><?php echo $this->Html->link(
													'Logar',
													array(
														'plugin'	=> 'admin', //isso equivale aos prefixo :(
														'controller'=> 'Users',
														'action' 	=> 'login',
														//'full_base'	=> true,
													),
													array('class'=>  "pl-0 pl-sm-10")
												);
								?>
							</li>
								<!-- <a class="pl-0 pl-sm-10" href="#">Logar</a></li> -->
							<li><?php echo $this->Html->link(
													'Sobre Nós',
													array(
														'controller' => 'Pages',
														'action' => 'blog_aboutUs',
													)
												); ?>
							</li>
							<li><?php echo $this->Html->link(
													'Contatos',
													array(
														'controller' => 'Pages',
														'action' => 'blog_contacts',
													)
												); ?>
							</li>
						</ul>
						<ul class="float-right float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
							<li><a class="pl-0 pl-sm-10" href="https://www.facebook.com/" 		target="_blank"><i class="ion-social-facebook"></i></a></li>
							<li><a href="https://twitter.com/" 									target="_blank"><i class="ion-social-twitter"></i></a></li>
							<li><a href="https://google.com.br/" 								target="_blank"><i class="ion-social-google"></i></a></li>
							<li><a href="https://www.instagram.com/?hl=pt-br" 					target="_blank"><i class="ion-social-instagram"></i></a></li>
							<li><a href="https://www.mercadobitcoin.com.br/" 					target="_blank"><i class="ion-social-bitcoin"></i></a></li>
						</ul>

					</div><!-- top-menu -->
				</div><!-- container -->
			</div><!-- bg-191 -->

			<?php echo $this->Flash->render(); ?>

			<div class="container">
				<?php echo $this->Html->image('logo-black.png',
											array(
												'alt' 		=> 'Logo do blog',
												'border' 	=> '0',
												'url'		=> array('controller' => 'Pages', 'action' => 'blog_home' )
												)
											);
				?>
				<!-- <a class="logo" href="index.html"><img src="images/logo-black.png" alt="Logo"></a> -->

				<a class="right-area src-btn" href="#" >
					<i class="active src-icn ion-search"></i>
					<i class="close-icn ion-close"></i>
				</a>
				<div class="src-form">
					<form>
						<input type="text" placeholder="Pesquisar">
						<button type="submit"><i class="ion-search"></i></a></button>
					</form>
				</div><!-- src-form -->

				<a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a>

				<ul class="main-menu" id="main-menu">
					<li>
						<?php
						echo $this->Html->link(
							'NOTÍCIAS', array( 'controller' => 'Posts', 'action' => 'blog_news'));
						?>
					</li>
					<li class="drop-down">
					<a href="<?php
						echo $this->Html->url(array('controller' => 'Posts', 'action' => 'blog_analyze'));?>
						">ANÁLISE TÉCNICA<i class="ion-arrow-down-b"></i></a>
						<ul class="drop-down-menu drop-down-inner">
							<li><?php
								echo $this->Html->link(
									'Em Destaque', array( 'controller' => 'Posts', 'action' => 'blog_news', 'destaque'));
								?>
							</li>
							<li><?php
								echo $this->Html->link(
									'Pelo Editor', array( 'controller' => 'Posts', 'action' => 'blog_news', 'editores'));
								?>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo $this->Html->url(array('controller' => 'Posts', 'action' => 'blog_timeline'));?>">
							TIMELINE
						</a>
					</li>
					<li>
						<a href="<?php echo $this->Html->url(array('controller' => 'Posts', 'action' => 'blog_investment'));?>">
							INVESTIMENTOS
						</a>
					</li>
					<li>
						<a href="<?php echo $this->Html->url(array('controller' => 'Posts', 'action' => 'blog_insurance'));?>">
							SEGUROS
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div><!-- container -->
		</header>

		<?PHP echo $this->fetch('content'); ?>

		<section>
			<div class="container">
				<div class="row">

					<div class="col-md-12 col-lg-8">
						<h4 class="p-title"><b>Postagens Recentes</b></h4>
						<div class="row">

							<div class="col-sm-6">
								<img src="<?PHP echo $data['posts'][6]['img']['path'];?>" alt="<?PHP echo $data['posts'][6]['img']['alt'];?>">
								<h4 class="pt-20"><a href="<?PHP echo $this->Html->url(array("controller" => "Posts", "action" => "blog_view", $data['posts'][6]['stamp']), true)?>"><?PHP echo $data['posts'][6]['title']; ?></a></h4>
								<ul class="list-li-mr-20 pt-10 pb-20">
									<li class="color-lite-black">Criado por
										<a href="<?PHP echo $this->Html->url(array("controller" => "Profiles", "action" => "blog_view", $data['posts'][6]['author']['uuid']), true)?>" class="color-black">
											<b><?PHP echo $data['posts'][6]['author']['name'];?></b>
										</a>
										<?PHP echo $data['posts'][6]['created']; ?>
									</li>
									<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i><b><?PHP echo $data['posts'][6]['likes'];?></b></li>
									<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i><b><?PHP echo $data['posts'][6]['comments']['count'];?></b></li>
								</ul>
								<p><?PHP echo $data['posts'][6]['description'];?></p>
							</div><!-- col-sm-6 -->

							<div class="col-sm-6">
								<?PHP foreach($data['posts'] as $key => $post): ?>
									<?php if($key > 6): ?>
										<a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
											<div class="wh-100x abs-tlr"><img src="<?PHP echo $post['img']['path']; ?>" alt="<?PHP echo $post['img']['alt']; ?>"></div>
											<div class="ml-120 min-h-100x">
												<h5><b><?PHP echo $post['title']; ?></b></h5>
												<h6 class="color-lite-black pt-10">Criado por <span class="color-black"><b><?PHP echo $post['author']['name']; ?></b></span> <?PHP echo $post['created']; ?></h6>
											</div>
										</a><!-- oflow-hidden -->
									<?php endif;
										if($key >= 10){
											break;
										}
									?>
								<?PHP endforeach; ?>
							</div><!-- col-sm-6 -->

						</div><!-- row -->

						<h4 class="p-title mt-30"><b>Notícias</b></h4>
						<div class="row">
							<?PHP foreach($data['news'] as $key => $notice): ?>
								<div class="col-sm-6">
									<?PHP echo $this->Html->image($notice['img'], array('alt' => $notice['title'])); ?>
									<h4 class="pt-20">
										<a href="<?PHP echo $this->Html->url(array('controller' => 'Posts', 'action'=>'blog_view', $notice['stamp']), true); ?>">
											<b><?PHP $notice['title'] ?></b>
										</a>
									</h4>
									<ul class="list-li-mr-20 pt-10 mb-30">
										<li class="color-lite-black">Criado por:
											<a href="<?PHP echo $this->Html->url(array("controller" => "Profiles", "action" => "blog_view", $notice['author']['uuid']), true)?>" class="color-black">
												<b><?PHP $notice['author']['name'] ?>,</b>
											</a> <?PHP $notice['created'] ?>
										</li>
										<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i><?PHP echo $notice['likes'] ?></li>
										<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i><?PHP echo $notice['comments']['count'] ?></li>
									</ul>
								</div><!-- col-sm-6 -->
								<?PHP
									if($key >= 6){
										break;
									}
								?>
							<?PHP endforeach; ?>
						</div><!-- row -->

						<a class="dplay-block btn-brdr-primary mt-20 mb-md-50" href="<?PHP echo $this->Html->url(array('controller' => 'Posts', 'action'=>'view'), true); ?>"><b>Ver notícias recentes</b></a>
					</div><!-- col-md-9 -->

					<div class="d-none d-md-block d-lg-none col-md-3"></div>
					<div class="col-md-6 col-lg-4">
						<div class="pl-20 pl-md-0">
							<ul class="list-block list-li-ptb-15 list-btm-border-white bg-primary text-center">
								<li data-toggle="tooltip" data-placement="right" title="<?PHP echo $data['money']['USD']['name'] ?>">
									<b>1 USD = R$<?PHP echo $data['money']['USD']['bid'] ?></b>
								</li>
								<li data-toggle="tooltip" data-placement="right" title="<?PHP echo $data['money']['EUR']['name'] ?>">
									<b>1 EUR = R$<?PHP echo $data['money']['EUR']['bid'] ?></b>
								</li>
								<li data-toggle="tooltip" data-placement="right" title="<?PHP echo $data['money']['BTC']['name'] ?>">
									<b>1 BTC = R$<?PHP echo $data['money']['BTC']['bid'] ?></b>
								</li>
								<li data-toggle="tooltip" data-placement="right" title="<?PHP echo $data['money']['LTC']['name'] ?>">
									<b>1 LTC = R$<?PHP echo $data['money']['LTC']['bid'] ?></b>
								</li>
								<li data-toggle="tooltip" data-placement="right" title="<?PHP echo $data['money']['JPY']['name'] ?>">
									<b>1 JPY = R$<?PHP echo $data['money']['JPY']['bid'] ?></b>
								</li>
								<li data-toggle="tooltip" data-placement="right" title="<?PHP echo $data['money']['CNY']['name'] ?>">
									<b>1 CNY = R$<?PHP echo $data['money']['CNY']['bid'] ?></b>
								</li>
							</ul>

							<div class="mtb-50">
								<h4 class="p-title"><b>Postagens Pop</b></h4>
								<?PHP foreach($data['postPop'] as $key => $pop):?>
									<a class="oflow-hidden pos-relative mb-20 dplay-block" href="<?PHP echo $this->Html->url(array('controller' => 'Posts', 'action'=>'blog_view', $pop['stamp']), true); ?>">
										<div class="wh-100x abs-tlr">
										<?PHP echo $this->Html->image($pop['img'], array('alt' => $pop['title'])); ?>
										</div>
										<div class="ml-120 min-h-100x">
											<h5><b><?PHP echo $pop['title'] ?></b></h5>
											<h6 class="color-lite-black pt-10">Criado por: <span class="color-black"><b><?PHP echo $pop['author']['name'] ?>, </b></span><?PHP echo $pop['created'] ?></h6>
										</div>
									</a><!-- oflow-hidden -->

								<?PHP if($key >= 4){break;} endforeach; ?>

							</div><!-- mtb-50 -->

							<div class="mtb-50 pos-relative">
								<img src="images/banner-1-600x450.jpg" alt="">
								<div class="abs-tblr bg-layer-7 text-center color-white">
									<div class="dplay-tbl">
										<div class="dplay-tbl-cell">
											<h4><b>Disponível para mobile</b></h4>
											<a class="mt-15 color-primary link-brdr-btm-primary" href="#"><b>Baixe grátis</b></a>
										</div><!-- dplay-tbl-cell -->
									</div><!-- dplay-tbl -->
								</div><!-- abs-tblr -->
							</div><!-- mtb-50 -->

							<div class="mtb-50 mb-md-0">
								<h4 class="p-title"><b>Boletim de Noticias</b></h4>
								<p class="mb-20">Assine a nossa newsletter para receber notificações sobre novas atualizações, informações, descontos, etc.</p>
								<form class="nwsltr-primary-1">
									<input type="text" placeholder="Your email"/>
									<button type="submit"><i class="ion-ios-paperplane"></i></button>
								</form>
							</div><!-- mtb-50 -->

						</div><!--  pl-20 -->
					</div><!-- col-md-3 -->

				</div><!-- row -->
			</div><!-- container -->
		</section>

		<footer class="bg-191 color-ccc">
			<div class="container">
				<div class="pt-50 pb-20 pos-relative">
					<div class="abs-tblr pt-50 z--1 text-center">
						<div class="h-80 pos-relative"><img class="opacty-1 h-100 w-auto" src="images/map.png" alt=""></div>
					</div>
					<div class="row">

						<div class="col-sm-4">
							<div class="mb-30">
								<?php
									echo $this->Html->link(
										$this->Html->image("logo.png", array("alt" => "MeuBlog")),
										array(
											'controller' => 'Pages',
											'action' => 'blog_home',
										)
									);
								?>
								<p class="mtb-20 color-ccc">Este blog apresenta técnicas e dicas para que você faça os melhores investimentos e seguros</p>
								<p class="color-ash">
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ion-heart" aria-hidden="true"></i> by <a href="" target="_blank">Tiago Pereira</a>
								</p>
							</div><!-- mb-30 -->
						</div><!-- col-md-4 -->

						<div class="col-sm-4">
							<div class="mb-30">
								<h5 class="color-primary mb-20"><b>Mais Populares</b></h5>
								<div class="mb-20">
									<a class="color-white" href="<?PHP echo $data['postPop'][0]['title'] ?>"><b><?PHP echo $data['postPop'][0]['title'] ?></b></a>
									<h6 class="mt-10"><?PHP echo $data['postPop'][0]['created'] ?></h6>
								</div>
								<div class="brdr-ash-1 opacty-2 mr-30"></div>
								<div class="mb-20">
									<a class="color-white" href="<?PHP echo $data['postPop'][1]['title'] ?>"><b><?PHP echo $data['postPop'][1]['title'] ?></b></a>
									<h6 class="mt-10"><?PHP echo $data['postPop'][1]['created'] ?></h6>
								</div>
							</div><!-- mb-30 -->
						</div><!-- col-md-4 -->

						<div class="col-sm-4">
							<div class="mb-30">
								<h5 class="color-primary mb-20"><b>Recentes</b></h5>
								<div class="mb-20">
									<a class="color-white" href="<?PHP echo $data['posts'][0]['title'] ?>"><b><?PHP echo $data['posts'][0]['title'] ?></b></a>
									<h6 class="mt-10"><?PHP echo $data['posts'][0]['created'] ?></h6>
								</div>
								<div class="brdr-ash-1 opacty-2 mr-30"></div>
								<div class="mb-20">
									<a class="color-white" href="<?PHP echo $data['posts'][1]['title'] ?>"><b><?PHP echo $data['posts'][1]['title'] ?></b></a>
									<h6 class="mt-10"><?PHP echo $data['posts'][1]['created'] ?></h6>
								</div>
							</div><!-- mb-30 -->
						</div><!-- col-md-4 -->

					</div><!-- row -->
				</div><!-- ptb-50 -->

				<div class="brdr-ash-1 opacty-2"></div>

				<div class="oflow-hidden color-ash font-9 text-sm-center ptb-sm-5">

					<ul class="float-left float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10">
						<li><a class="pl-0 pl-sm-10" href="#">Termos e condições</a></li>
						<li><a href="#">Regras de Privacidade</a></li>
						<li><a href="#">Trabalhe conosco</a></li>
						<li><a href="#">Entre em contato</a></li>
					</ul>
					<ul class="float-right float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
						<li><a class="pl-0 pl-sm-10" href="https://www.facebook.com/"  target="_blank"><i class="ion-social-facebook"></i></a></li>
						<li><a href="https://twitter.com/"  target="_blank"><i class="ion-social-twitter"></i></a></li>
						<li><a href="https://google.com.br/"  target="_blank"><i class="ion-social-google"></i></a></li>
						<li><a href="https://www.instagram.com/?hl=pt-br"  target="_blank"><i class="ion-social-instagram"></i></a></li>
						<li><a href="https://www.mercadobitcoin.com.br/"  target="_blank"><i class="ion-social-bitcoin"></i></a></li>
					</ul>

				</div><!-- oflow-hidden -->
			</div><!-- container -->
		</footer>

		<!-- SCIPTS -->

		<?php echo $this->Html->script(array('jquery-3.2.1.min',
											'tether.min.js',
											'bootstrap.js',
											'scripts.js'));
		?>
		<?php echo $this->Js->writeBuffer(); ?>
	</body>

</html>