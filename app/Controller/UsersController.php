<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 */
class UsersController extends AppController
{

	/**
	 * Scaffold
	 *
	 * @var mixed
	 */
	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array('Html', 'Form');

	public $name = 'Users';

	public $paginate = array(
		'limit' => 25,
		'conditions' => array('status' => '1'),
		'order' => array('User.username' => 'asc'),
	);

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('admin_login',
							'admin_register',
							'admin_login_modal',
							'admin_lock'
						);
	}

	public function admin_login(){
		//Caso esteja logado redirecionar para index
		if ($this->Session->check('Auth.User')) {
			$this->redirect(array('controller' => 'Pages', 'action' => 'admin_home'));
		}
		$this->layout = 'dashboard_clean';
		// Se for Post tentar autenticar
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->setFlash(__('Seja Bem-vindo, ' .$this->Auth->user('username').'!'));
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('Username ou senha inválidos'));
			}
		}
	}

	public function admin_logout(){
		$this->redirect($this->Auth->logout());
	}

	public function index(){
		$this->paginate = array(
			'limit' => 5,
			'order' => array('User.username' => 'asc')
		);
		$users = $this->paginate('User');
		$this->set(compact('users'));
	}

	public function admin_register(){

		$this->layout = 'dashboard_clean';

		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['status'] 	= false;
			$this->request->data['User']['deleted'] = gmdate('Y-m-d H:i:s');

			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('Usuário criado com sucesso');
				$this->redirect(array('action' => 'admin_lock', 'email' => $this->request->data['User']['email']));
			} else {
				$this->Session->setFlash('Vixi! deu erro ao criar o usuário');
			}
		}
	}

	public function edit($uuid = null){

		if (!$uuid) {
			$this->Session->setFlash('usuário não identificado');
			$this->redirect(array('action' => 'index'));
		}

		$user = $this->User->findById($uuid);
		if (!$user) {
			//$this->Session->setFlash('uuid Inválido');
			$this->redirect(array('action' => 'index'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->uuid = $uuid;
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Usuário atualizado com sucesso'));
				$this->redirect(array('action' => 'edit', $uuid));
			} else {
				$this->Session->setFlash(__('Não foi possível atualizar este usuário'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $user;
		}
	}

	public function delete($uuid = null){

		if (!$uuid) {
			$this->Session->setFlash('Usuário não identificado');
			$this->redirect(array('action' => 'index'));
		}

		$this->User->uuid = $uuid;
		if (!$this->User->exists()) {
			// $this->Session->setFlash('uuid inválido');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->User->saveField('status', 0) && $this->User->saveField('deleted', gmdate('Y-m-d H:i:s'))) {
			$this->Session->setFlash(__('Usuário apagado com sucesso'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Erro ao apagar usuário'));
		$this->redirect(array('action' => 'index'));
	}

	public function activate($uuid = null){

		if (!$uuid) {
			$this->Session->setFlash('Usuário não identificado');
			//$this->redirect(array('action' => 'index'));
		}

		$this->User->uuid = $uuid;
		if (!$this->User->exists()) {
			$this->Session->setFlash('uuid Inválido');
			//$this->redirect(); //redirecionar para a pagina anterior
		}
		if ($this->User->saveField('status', true) && $this->User->saveField('deleted', null)) {
			$this->Session->setFlash(__('Usuário foi Ativado'));
			//$this->redirect(); //redirecionar para a pagina anterior
		}
		$this->Session->setFlash(__('Erro ao ativar usuário'));
		//$this->redirect(); //redirecionar para a pagina anterior
	}

	public function admin_login_modal(){
		/**
		  implementar
		 */
	}

	public function admin_home(){
		$this->layout 	= 'dashboard';
	}


	public function admin_home_adm(){
		$this->layout 	= 'dashboard';
	}

	public function admin_home_master(){
		$this->layout 	= 'dashboard';
	}

	public function admin_home_worker(){
		$this->layout 	= 'dashboard';
	}

	public function admin_lock(string $email = null, string $token = null){
		$this->layout 	= 'dashboard_clean';

		if(empty($email))
			$email = $this->request->email;

		if(empty($token))
			$token = $this->request->token;


		$data = [
			'token' => $token,
			'email' => $email
		];

		$this->set('data', $data);

	}
}
