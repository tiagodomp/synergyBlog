<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public $uses = array('Post','Tag', 'Comment');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Post->create();
			$this->request->data['Post']['user_id'] = $this->Auth->user('id');
			$this->request->data['Post']['info'] = json_encode(['status' => false]);
			$this->request->data['Post']['tag_id'] = json_encode(explode(',', $this->request->data['Post']['tags']));
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
		}
		$tags = $this->Post->Tag->find('list');
		$this->set(compact('tags'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Post']['user_id'] = $this->Auth->user('id');
			$this->request->data['Post']['info'] = json_encode(['status' => false, $this->request->data['Post']['status']]);
			$this->request->data['Post']['tag_id'] = json_encode(explode(',', $this->request->data['Post']['tags']));
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$post = $this->Post->find('first', $options);
			$this->request->data = $post;
			$tags = $this->Post->Tag->find('list');
			$this->set(compact('tags'));
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(__('The post has been deleted.'));
		} else {
			$this->Session->setFlash(__('The post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
