<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('initDB', 'login', 'add');
	}

	public function login() {

		if ($this->Session->read('Auth.User')) {
			$this->Session->setFlash('You are logged in!');
			return $this->redirect('/');
		}

		if ($this->request->is('post')) {
			if ($this->Auth->login()){
				if(!$this->Auth->user('status'))
					$this->redirect(array('action' => 'block', $this->Auth->user('id')));
				$this->Session->setFlash(__('Seja Bem-vindo, ' .$this->Auth->user('username').'!'));
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('Username ou senha inválidos'));
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	public function tree_category(){

	}

	public function initDB() {
		$group = $this->User->Group;

		// Allow admins to everything
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');

		// allow managers to posts and widgets
		$group->id = 2;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts');
		$this->Acl->allow($group, 'controllers/Widgets');
		$this->Acl->allow($group, 'controllers/users/logout');
		$this->Acl->allow($group, 'controllers/users/block');
		$this->Acl->allow($group, 'controllers/tags/add');
		$this->Acl->allow($group, 'controllers/tags/edit');
		$this->Acl->allow($group, 'controllers/tags/view');

		// allow users to only add and edit on posts and widgets
		$group->id = 3;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts/add');
		$this->Acl->allow($group, 'controllers/Posts/edit');
		$this->Acl->allow($group, 'controllers/Widgets/add');
		$this->Acl->allow($group, 'controllers/Widgets/edit');
		$this->Acl->allow($group, 'controllers/users/logout');
		$this->Acl->allow($group, 'controllers/users/block');
		$this->Acl->allow($group, 'controllers/tags/add');
		$this->Acl->allow($group, 'controllers/tags/edit');
		$this->Acl->allow($group, 'controllers/tags/view');

		// we add an exit to avoid an ugly "missing views" error message
		echo "all done";
		exit;
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			//$this->request->data['User']['status'] = ['live' => false, 'modified' => gmdate('Y-m-d H:i:s'), 'Author' => 0];
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['User']['id'] = $id;
			$this->request->data['User']['status'] = ['live' => $this->request->data['User']['status'], 'modified' => gmdate('Y-m-d H:i:s'), 'Author' => $this->Auth->user('id')];
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('O usuário foi atualizado'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Erro em atualizar'));
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function block($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if($this->request->data['User']['token'] == base64_encode($this->request->data['User']['username'])){
				$this->request->data['User']['id'] = $id;
				$this->request->data['User']['status'] = ['live' => true, 'modified' => gmdate('Y-m-d H:i:s'), 'Author' => $this->Auth->user('id')];
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('O usuário foi desbloqueado'));
					return $this->redirect(array('action' => 'index'));
				}
			}
			$this->Session->setFlash(__('Erro em atualizar'));

		} else {
			$options = array('conditions' =>
					array(
						'User.' . $this->User->primaryKey => $id
					),
					'recursive' => 0
				);
			$user = $this->User->find('first', $options);
			$user['User']['crypto'] = base64_encode($user['User']['username']);
			$this->request->data = $user;
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
