

<?php echo $this->Session->flash('auth'); ?>
<div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
				<?php echo $this->Form->create('User'); ?>
                    <div class="login-form-head">
                        <h4>Em avaliação</h4>
                        <p>Você precisa de um token de autorização <br /> confira seu E-mail!</p>
                    </div>
                    <div class="login-form-body">
						<?php if(!empty($data['email'])): ?>
							<div class="form-gp">
								<p> Você recebera o token no seguinte E-mail :
									<?php echo $data['email'] ?> </p>
								<i class="ti-email"></i>
							</div>
						<?php endif; ?>
						<div class="form-gp">
							<?php echo $this->Form->input('token', array( 'div' => false, 'value' => $data['token'], 'label' => 'Cole seu token aqui')); ?>
							<i class="ti-lock"></i>
						</div>
                        <div class="submit-btn-area mt-5">
                            <button id="form_submit" type="submit">Desbloquear <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>