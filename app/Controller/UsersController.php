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
	public $components = array('RequestHandler', 'Acl');
	public $helpers = array('Html', 'Form');

	public $name = 'Users';

	public $paginate = array(
		'limit' => 25,
		//'conditions' => array('status' => '1'),
		'order' => array('User.username' => 'asc'),
	);

	public $uses = array(
		'User',
		'Role',
	);

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('admin_login',
							'admin_register_public',
							'admin_login_modal',
							'admin_lock'));
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

	public function admin_register_public(){

		$this->layout = 'dashboard_clean';
		$roleUuids = $this->Role->find('list');
		$this->set('roleUuids', $roleUuids);

		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['status'] 	= false;
			$this->request->data['User']['deleted'] = gmdate('Y-m-d H:i:s');

			if ($this->User->save($this->request->data)){
				$this->Session->setFlash('Usuário criado com sucesso');
				$this->redirect(array('action' => 'admin_lock', base64_encode($this->request->data['User']['email'])));
			} else {
				$this->Session->setFlash('Vixi! deu erro ao criar o usuário');
			}
		}
	}

	public function admin_edit(string $uuid = null){ // faz mais lógica inverter, primeiro verificando se trata de uma requisição
		$this->layout 	= 'dashboard';

		if (!empty($this->request->data)) {
			$this->User->uuid = $uuid;

			if($this->request->data['User']['status'] > 0){
				$this->request->data['User']['uuid']	= $uuid; //acrescentei para evitar erro de validação
				$this->request->data['User']['deleted'] = null;
				// $this->request->data['User']['info'] = array(
				// 	'data' => array(
				// 		'authorizedBy' 	=> $this->Auth->user('uuid'),
				// 		'created'		=> gmdate('Y-m-d H:i:s'),
				// 	),
				// 	//'conditions' => '',
				// 	'path' => 'info.register.auth',
				// );
			}
			//pr($this->request->data); exit;
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Usuário atualizado com sucesso'));
				//$this->redirect($this->request->);
			} else {
				$this->Session->setFlash(__('Não foi possível atualizar este usuário'));
				$this->redirect(array('action' => 'admin_edit', $uuid));
			}
		}

		if (empty($uuid)) {
			$this->Session->setFlash('usuário não identificado');
			$this->redirect(array('action' => 'admin_candidatos'));
		}

		$user = $this->User->find('first', array('conditions'=> array('User.uuid' => $uuid), 'contain' => 'Role'));
		$roleUuids = $this->Role->find('list');

		if (empty($user)) {
			$this->Session->setFlash('uuid Inválido');
			$this->redirect(array('action' => 'admin_candidatos'));
		}

		if (!$this->request->data) {
			$this->request->data = $user;
		}

		$this->set(array('user' => $user, 'roleUuids' => $roleUuids));
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


	public function admin_administrators(){
		$this->layout 	= "dashboard";
		$this->title 	= "Candidatos";

		$this->Paginator->settings = array(
			'order' => array('Users.role_uuid' => 'asc'),
			'contain' => array('Role')
		);

		$admins = $this->paginate(
			'User',																					//alterar essa maneira de verificação
			array ( 'AND' => array('User.status =' => 1, 'User.deleted IS NULL', 'User.role_uuid =' => '1ceaf6d3-5173-41d0-9dd9-778f1c6866ca'))
		);

		// $actives = $this->paginate(
		// 	'User',
		// 	array ( 'AND' => array('User.status =' => 1, 'User.deleted IS NULL'))
		// );
		$this->set(compact('admins'));
	}

	public function admin_masters(){
		$this->layout 	= "dashboard";
		$this->title 	= "Candidatos";

		$this->Paginator->settings = array(
			'order' => array('Users.role_uuid' => 'asc'),
			'contain' => array('Role')
		);

		$masters = $this->paginate(
			'User',																					//alterar essa maneira de verificação
			array ( 'AND' => array('User.status =' => 1, 'User.deleted IS NULL', 'User.role_uuid =' => '1d324a0d-f511-45b8-a8b9-8dc7732a1ea0'))
		);

		// $actives = $this->paginate(
		// 	'User',
		// 	array ( 'AND' => array('User.status =' => 1, 'User.deleted IS NULL'))
		// );
		$this->set(compact('masters'));
	}

	public function admin_editors(){
		$this->layout 	= "dashboard";
		$this->title 	= "Candidatos";

		$this->Paginator->settings = array(
			'order' => array('Users.role_uuid' => 'asc'),
			'contain' => array('Role')
		);

		$editors = $this->paginate(
			'User',																					//alterar essa maneira de verificação
			array ( 'AND' => array('User.status =' => 1, 'User.deleted IS NULL', 'User.role_uuid =' => 'c449b520-09e3-4532-a75b-d1f89f32b0af'))
		);

		// $actives = $this->paginate(
		// 	'User',
		// 	array ( 'AND' => array('User.status =' => 1, 'User.deleted IS NULL'))
		// );
		$this->set(compact('editors'));
	}

	/**
	 * Possibilita ao administrador definir as regras para aceitar um novo membro como admin, workerMaster e worker
	 *  @param string
	 */
	public function admin_candidates(){
		$this->layout 	= "dashboard";
		$this->title 	= "Candidatos";

		$this->Paginator->settings = array(
			'order' => array('Users.role_uuid' => 'asc'),
			'contain' => array('Role')
		);

		$locks = $this->paginate(
			'User',
			array ( 'OR' => array('User.status =' => 0, 'User.deleted IS NOT NULL'))
		);

		// $actives = $this->paginate(
		// 	'User',
		// 	array ( 'AND' => array('User.status =' => 1, 'User.deleted IS NULL'))
		// );
		$this->set(compact('locks'));
	}

	public function admin_lock(string $email = null, string $token = null){
		$this->layout 	= 'dashboard_clean';

		if(empty($email))
			$email = (string) isset($this->request->pass[0])?base64_decode($this->request->pass[0]):null;

		if(empty($token))
			$token = (string) isset($this->request->pass[1])?base64_decode($this->request->pass[1]):null;


		$data = [
			'token' => $token,
			'email' => $email
		];
		$this->set('data', $data);
	}

}
