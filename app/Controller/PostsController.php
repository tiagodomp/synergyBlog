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

	public $uses = array('Tag', 'Post');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$posts = $this->Post->find('all');
		$this->set('posts', $posts);
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
			$data['Post']['user_id'] = $this->Auth->user('id');

			$data['Post']['body'] = array(
					'stamp' => gmdate('\TYmdHis'),
					'title'	=> $this->request->data['Post']['title'],
					'description' => $this->request->data['Post']['description'],
					'img' => array(
						'path'  => '',
						'alt'	=> '',
					),
					'content'	=> $this->request->data['Post']['body']?:[],
					'author' => array(
						'username'	=> $this->Auth->user('username'),
						'id'	=> $this->Auth->user('id'),
					),
					'likes'	=> 0,
					'comments'	=> array(
						'count' => 0,
						'msg'	=> array(),
					),
					'tags' => array($this->request->data['Post']['tags']?:''),
					'created'	=> gmdate('Y-m-d H:i:s'),
					'modified'	=> '',
				);
			$this->Post->create();
			if ($this->Post->save($data)) {
				$this->Session->setFlash(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'));
			}
		}
		$tags = $this->Tag->find('list', array(
			'conditions' => array('Tag.deleted IS NULL'),
			'fields' => array('Tag.name'),
		));

		//$tags = array_keys($tags);


		$this->set('tags', $tags);
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
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
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
