


<div class="container" ng-controller="PostsController">
	<div class="h-600x h-sm-auto">
		<!-- bloco superior -->
		<div class="h-2-3 h-sm-auto oflow-hidden">
			<!-- 1 Post GG -->
			<div class="pb-5 pr-5 pr-sm-0 float-left float-sm-none w-2-3 w-sm-100 h-100 h-sm-300x">
				<a class="pos-relative h-100 dplay-block" href="<?PHP echo $this->Html->url(array("controller" => "Posts", "action" => "view", $data['posts'][0]['stamp']), true)?>">

					<div class="img-bg bg-grad-layer-6" style="background: url('<?PHP echo $data['posts'][0]['img']['path'] ?>') no-repeat center; background-size: cover;"></div>

					<div class="abs-blr color-white p-20 bg-sm-color-7">
						<h3 class="mb-15 mb-sm-5 font-sm-13"><b><?PHP echo $data['posts'][0]['title']; ?></b></h3>
						<ul class="list-li-mr-20">
							<li>Criado por <span class="color-primary"><b><?PHP echo $data['posts'][0]['author']['name']; ?></b></span><?PHP echo $data['post'][0]['created']; ?></li>
							<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i><?PHP echo $data['posts'][0]['likes']; ?></li>
							<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i><?PHP echo $data['posts'][0]['comments']['count']; ?></li>
						</ul>
					</div><!--abs-blr -->
				</a><!-- pos-relative -->
			</div><!-- w-1-3 -->

			<!-- 2 Post PP -->
			<div class="float-left float-sm-none w-1-3 w-sm-100 h-100 h-sm-600x">

				<div class="pl-5 pb-5 pl-sm-0 ptb-sm-5 pos-relative h-50">
					<a class="pos-relative h-100 dplay-block" href="<?PHP echo $this->Html->url(array("controller" => "Posts", "action" => "view", $data['posts'][1]['stamp']), true)?>">

						<div class="img-bg bg-grad-layer-6" style="background: url(<?PHP echo $data['post'][1]['img']['path'] ?>) no-repeat center; background-size: cover;"></div>

						<div class="abs-blr color-white p-20 bg-sm-color-7">
							<h4 class="mb-10 mb-sm-5"><b><?PHP echo $data['posts'][1]['title']; ?></b></h4>
							<ul class="list-li-mr-20">
								<li><?PHP echo $data['post'][1]['created']; ?></li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i><?PHP echo $data['posts'][1]['likes'];?></li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i><?PHP echo $data['posts'][1]['comments']['count'];?></li>
							</ul>
						</div><!--abs-blr -->
					</a><!-- pos-relative -->
				</div><!-- w-1-3 -->

				<div class="pl-5 ptb-5 pl-sm-0 pos-relative h-50">
					<a class="pos-relative h-100 dplay-block" href="<?PHP echo $this->Html->url(array("controller" => "Posts", "action" => "view", $data['posts'][2]['stamp']), true)?>">

						<div class="img-bg bg-grad-layer-6" style="background: url(<?PHP echo $data['post'][2]['img']['path'] ?>) no-repeat center; background-size: cover;"></div>

						<div class="abs-blr color-white p-20 bg-sm-color-7">
							<h4 class="mb-10 mb-sm-5"><b><?PHP echo $data['posts'][2]['title']; ?></b></h4>
							<ul class="list-li-mr-20">
								<li><?PHP echo $data['post'][2]['created']; ?></li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i><?PHP echo $data['posts'][2]['likes'];?></li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i><?PHP echo $data['posts'][2]['comments']['count'];?></li>
							</ul>
						</div><!--abs-blr -->
					</a><!-- pos-relative -->
				</div><!-- w-1-3 -->

			</div><!-- float-left -->

		</div><!-- h-2-3 -->

		<!-- Bloco inferior -->
		<div class="h-1-3 oflow-hidden">

			<div class="pr-5 pr-sm-0 pt-5 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
				<a class="pos-relative h-100 dplay-block" href="<?PHP echo $this->Html->url(array("controller" => "Posts", "action" => "view", $data['posts'][3]['stamp']), true)?>">

					<div class="img-bg bg-grad-layer-6" style="background: url(<?PHP echo $data['post'][3]['img']['path'] ?>) no-repeat center; background-size: cover;"></div>

					<div class="abs-blr color-white p-20 bg-sm-color-7">
						<h4 class="mb-10 mb-sm-5"><b><?PHP echo $data['posts'][3]['title']; ?></b></h4>
							<ul class="list-li-mr-20">
								<li><?PHP echo $data['post'][3]['created']; ?></li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i><?PHP echo $data['posts'][3]['likes'];?></li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i><?PHP echo $data['posts'][3]['comments']['count'];?></li>
							</ul>
					</div><!--abs-blr -->
				</a><!-- pos-relative -->
			</div><!-- w-1-3 -->

			<div class="plr-5 plr-sm-0 pt-5 pt-sm-10 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
				<a class="pos-relative h-100 dplay-block" href="<?PHP echo $this->Html->url(array("controller" => "Posts", "action" => "view", $data['posts'][4]['stamp']), true)?>">

					<div class="img-bg bg-grad-layer-6" style="background: url(<?PHP echo $data['post'][4]['img']['path'] ?>) no-repeat center; background-size: cover;"></div>

					<div class="abs-blr color-white p-20 bg-sm-color-7">
						<h4 class="mb-10 mb-sm-5"><b><?PHP echo $data['posts'][4]['title']; ?></b></h4>
							<ul class="list-li-mr-20">
								<li><?PHP echo $data['post'][4]['created']; ?></li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i><?PHP echo $data['posts'][4]['likes'];?></li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i><?PHP echo $data['posts'][4]['comments']['count'];?></li>
							</ul>
					</div><!--abs-blr -->
				</a><!-- pos-relative -->
			</div><!-- w-1-3 -->

			<div class="pl-5 pl-sm-0 pt-5 pt-sm-10 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
				<a class="pos-relative h-100 dplay-block" href="<?PHP echo $this->Html->url(array("controller" => "Posts", "action" => "view", $data['posts'][5]['stamp']), true)?>">

					<div class="img-bg bg-grad-layer-6" style="background: url(<?PHP echo $data['post'][5]['img']['path'] ?>) no-repeat center; background-size: cover;"></div>

					<div class="abs-blr color-white p-20 bg-sm-color-7">
					<h4 class="mb-10 mb-sm-5"><b><?PHP echo $data['posts'][5]['title']; ?></b></h4>
							<ul class="list-li-mr-20">
								<li><?PHP echo $data['post'][5]['created']; ?></li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i><?PHP echo $data['posts'][5]['likes'];?></li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i><?PHP echo $data['posts'][5]['comments']['count'];?></li>
							</ul>
					</div><!--abs-blr -->
				</a><!-- pos-relative -->
			</div><!-- w-1-3 -->

		</div><!-- h-2-3 -->
	</div><!-- h-100vh -->
</div><!-- container -->