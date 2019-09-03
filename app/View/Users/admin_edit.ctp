
<main class="main-content-inner">
	<div class="row">
		<div class="col-12 mt-5">
			<div class="card">
				<div class="card-body">
					<h4 class="header-title">Editar usuário</h4>
					<?php echo $this->Form->create('User'); ?>
							<div class="form-gp">
								<?php echo $this->Form->input('username', array( 'div' => false, 'class' => 'form-control disabled', 'label' => 'Username')); ?>
							</div>
							<div class="form-gp">
								<?php echo $this->Form->input('email', array( 'div' => false, 'class' => 'form-control', 'label' => 'Email do Candidato')); ?>
							</div>
							<div class="form-gp">
								<?php echo $this->Form->input('status', array( 'div' => false, 'class' => 'form-control', 'label' => 'Ativar Candidato')); ?>
							</div>
							<div class="form-group">
								<?php
								//pr($user); exit;
								echo $this->Form->input('role_uuid', array(
										'div'		=> false,
										'label'		=> 'Hierarquia do Candidato',
										'class'		=> 'form_control',
										'selected'	=> $user['Role']['uuid'],
									));
								?>
							</div>
							<button type="submit" class="btn btn-primary mt-4 pl-4 pr-4">Salvar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>