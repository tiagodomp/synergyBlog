<div class="main-content-inner">
	<div class="row">
		<!-- accordion style 1 start -->
		<div class="col-lg-12 mt-5">
			<div class="card">
				<div class="card-body">
					<div id="accordion1" class="according">
						<div class="card">
							<div class="card-header">
								<a class="card-link" data-toggle="collapse" href="#newPost">Criar novo Post <span class="left ti-arrow-circle-down"></span></a>
							</div>
							<div id="newPost" class="collapse show" data-parent="#newPost">
								<div class="card-body">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-area">
		<div class="row">
			<?PHP if(!empty($posts)): ?>
			<?php foreach($posts as $post): ?>
				<div class="col-lg-4 col-md-6 mt-5">
					<div class="card card-bordered">
						<?php echo $this->Html->image($post['img']['path'],
													array(
														'alt' 		=> $post['img']['alt'],
														'border' 	=> '0',
														'url'		=> array('controller' => 'Posts', 'action' => 'admin_edit' ),
														'class'		=> 'card-img-top img-fluid',
														)
													);
						?>
						<div class="card-body">
							<h5 class="title"><?PHP echo $post['title'] ?></h5>
							<p class="card-text"><?PHP echo $post['description'] ?></p>
							<?php echo $this->Html->link('Editar...',
															array(
																'controller' => 'Posts',
																'action' => 'admin_edit',
																$post['stamp']
															),
															array(
																'class' => 'btn btn-primary',
															)
														);
							?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			<?PHP else: ?>
			<div class="col-lg-4 col-md-6 mt-5">
				<div class="card">
					<div class="card-body">
						<h5 class="title">Crie um post para seu blog <span class="fa fa-battery-1"> </span></h5>
					</div>
				</div>
			</div>
			<?PHP endif; ?>
		</div>
	</div>
</div>