
<?php echo $this->Session->flash('auth'); ?>
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
				<?php echo $this->Form->create('User'); ?>
                    <div class="login-form-head">
                        <h4>Entrar</h4>
                        <p>Seja bem vindo a área administrativa do MeuBlog.com</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <?php echo $this->Form->input('username', array( 'div' => false, 'label' => 'Seu Username')); ?>
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
							<?php echo $this->Form->input('password', array( 'div' => false, 'label' => 'Sua Senha')); ?>
                            <i class="ti-lock"></i>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Entrar <i class="ti-arrow-right"></i></button>
                            <div class="login-other row mt-4">
                                <div class="col-6">
									<a class="fb-login" href="<?PHP echo $this->Html->url(array('controller' => 'Users', 'action'=>'admin_login_facebook'), true); ?>">
										Entrar com:
										<i class="fa fa-facebook"></i>
									</a>
                                </div>
                                <div class="col-6">
									<a class="google-login" href="<?PHP echo $this->Html->url(array('controller' => 'Users', 'action'=>'admin_login_google'), true); ?>">
										Entrar com:
										<i class="fa fa-google"></i>
									</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Quer contribruir ? <a href="<?PHP echo $this->Html->url(array('controller' => 'Users', 'action'=>'admin_register'), true); ?>">Registre-se</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

