<!-- seo fact area start -->
<main class="main-content-inner">
	<div class="row">
		<div class="col-lg-8">
			<div class="row">
				<div class="col-md-6 mt-5 mb-3">
					<div class="card">
						<div class="seo-fact sbg1">
							<div class="p-4 d-flex justify-content-between align-items-center">
								<div class="seofct-icon"><i class="ti-thumb-up"></i> Curtidas</div>
								<h2><?PHP $data['all']['likes']['count']; ?></h2>
							</div>
							<canvas id="seolinechart1" height="50" data-chart="<?PHP $data['all']['likes']['statics']; ?>"></canvas>
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-md-5 mb-3">
					<div class="card">
						<div class="seo-fact sbg2">
							<div class="p-4 d-flex justify-content-between align-items-center">
								<div class="seofct-icon"><i class="ti-comments"></i> Comentários</div>
								<h2><?PHP $data['all']['comments']['count']; ?></h2>
							</div>
							<canvas id="seolinechart2" height="50" data-chart="<?PHP $data['all']['comments']['statics']; ?>"></canvas>
						</div>
					</div>
				</div>
				<div class="col-md-6 mb-3 mb-lg-0">
					<div class="card">
						<div class="seo-fact sbg3">
							<div class="p-4 d-flex justify-content-between align-items-center">
								<div class="seofct-icon">Postagens</div>
								<canvas id="seolinechart3" height="60" data-chart="<?PHP $data['all']['posts']['statics']; ?>"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="seo-fact sbg4">
							<div class="p-4 d-flex justify-content-between align-items-center">
								<div class="seofct-icon">Novos Usuários</div>
								<canvas id="seolinechart4" height="60" data-chart="<?PHP $data['all']['users']['statics']; ?>"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- seo fact area end -->

		<!-- Social Campain area start -->
		<div class="col-lg-4 mt-5">
			<div class="card">
				<div class="card-body pb-0">
					<h4 class="header-title">Social ads Campain</h4>
					<div id="socialads" style="height: 245px;"></div>
				</div>
			</div>
		</div>
		<!-- Social Campain area end -->

		<!-- Statistics area start -->
		<div class="col-lg-8 mt-5">
			<div class="card">
				<div class="card-body">
					<h4 class="header-title">User Statistics</h4>
					<div id="user-statistics"></div>
				</div>
			</div>
		</div>
		<!-- Statistics area end -->

		<!-- Advertising area start -->
		<div class="col-lg-4 mt-5">
			<div class="card h-full">
				<div class="card-body">
					<h4 class="header-title">Advertising & Marketing</h4>
					<canvas id="seolinechart8" height="233"></canvas>
				</div>
			</div>
		</div>
		<!-- Advertising area end -->

		<!-- sales area start -->
		<div class="col-xl-9 col-ml-8 col-lg-8 mt-5">
			<div class="card">
				<div class="card-body">
					<h4 class="header-title">Sales</h4>
					<div id="salesanalytic"></div>
				</div>
			</div>
		</div>
		<!-- sales area end -->

		<!-- timeline area start -->
		<div class="col-xl-3 col-ml-4 col-lg-4 mt-5">
			<div class="card">
				<div class="card-body">
					<h4 class="header-title">Timeline</h4>
					<div class="timeline-area">
						<?PHP foreach($data['posts'] as $post): ?>
						<?PHP
							switch($post['category']){
								case 'news':
									$bg = 'bg2';
									$fa = 'fa-newspaper-o';
									break;
								case 'analyzes':
									$bg = 'bg3';
									$fa = 'fa-line-chart';
									break;
								default:
									$bg = 'bg1';
									$fa = 'fa-book';
							}
						?>
							<div class="timeline-task">
								<div class="icon <?PHP echo $bg ?>">
									<i class="fa <?PHP echo $fa ?>"></i>
								</div>
								<div class="tm-title">
									<h4><?PHP echo $post['title'];?></h4>
									<span class="time"><i class="ti-time"></i><?PHP echo $post['created'];?></span>
								</div>
								<p><?PHP echo $post['description'];?></p>
							</div>
						<?PHP endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<!-- timeline area end -->

		<!-- map area start -->
		<div class="col-xl-5 col-lg-12 mt-5">
			<div class="card">
				<div class="card-body">
					<h4 class="header-title">Marketing Area</h4>
					<div id="seomap"></div>
				</div>
			</div>
		</div>
		<!-- map area end -->

		<!-- testimonial area start -->
		<div class="col-xl-7 col-lg-12 mt-5">
			<div class="card">
				<div class="card-body bg1">
					<h4 class="header-title text-white">Client Feadback</h4>
					<div class="testimonial-carousel owl-carousel">
						<div class="tst-item">
							<div class="tstu-img">
								<img src="assets/images/team/team-author1.jpg" alt="author image">
							</div>
							<div class="tstu-content">
								<h4 class="tstu-name">Abel Franecki</h4>
								<span class="profsn">Designer</span>
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae laborum ut nihil numquam a aliquam alias necessitatibus ipsa soluta quam!</p>
							</div>
						</div>
						<div class="tst-item">
							<div class="tstu-img">
								<img src="assets/images/team/team-author2.jpg" alt="author image">
							</div>
							<div class="tstu-content">
								<h4 class="tstu-name">Abel Franecki</h4>
								<span class="profsn">Designer</span>
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae laborum ut nihil numquam a aliquam alias necessitatibus ipsa soluta quam!</p>
							</div>
						</div>
						<div class="tst-item">
							<div class="tstu-img">
								<img src="assets/images/team/team-author3.jpg" alt="author image">
							</div>
							<div class="tstu-content">
								<h4 class="tstu-name">Abel Franecki</h4>
								<span class="profsn">Designer</span>
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae laborum ut nihil numquam a aliquam alias necessitatibus ipsa soluta quam!</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!-- testimonial area end -->
	</div>
</main>