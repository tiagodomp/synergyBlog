<?php

// namespace App\Controller;

App::uses('AppController', 'Controller');

class PostsController extends AppController
{

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array('Html', 'Form');
	public $name = 'Posts';

	public function beforeFilter(){
		$this->Auth->allow(array(
			'blog_news',
			'blog_timeline',
			'blog_investment',
			'blog_analyze',
			'blog_insurance',
			'blog_view',
		));
	}
	public $virtualFields = array();
	public function index(){
		$posts = $this->Post->find('all');
		$this->set(array(
			'posts' => $posts,
			'_serialize' => array('posts')
		));
	}

	public function view(string $uuid){
		$post = $this->Post->findById($id);
		$this->set(array(
			'post' => $post,
			'_serialize' => array('post')
		));
	}

	public function add(){
		//$this->Post->id = $id;
		if ($this->Post->save($this->request->data)) {
			$message = array(
				'text' => __('Saved'),
				'type' => 'success'
			);
		} else {
			$message = array(
				'text' => __('Error'),
				'type' => 'error'
			);
		}
		$this->set(array(
			'message' => $message,
			'_serialize' => array('message')
		));
	}

	public function edit($id){
		$this->Post->id = $id;
		if ($this->Post->save($this->request->data)) {
			$message = array(
				'text' => __('Saved'),
				'type' => 'success'
			);
		} else {
			$message = array(
				'text' => __('Error'),
				'type' => 'error'
			);
		}
		$this->set(array(
			'message' => $message,
			'_serialize' => array('message')
		));
	}

	public function delete($id)	{
		if ($this->Post->delete($id)) {
			$message = array(
				'text' => __('Deleted'),
				'type' => 'success'
			);
		} else {
			$message = array(
				'text' => __('Error'),
				'type' => 'error'
			);
		}
		$this->set(array(
			'message' => $message,
			'_serialize' => array('message')
		));
	}

	public function admin_home(){
		$this->layout 	= 'dashboard';
	}

	public function admin_news(){
		$this->layout 	= 'dashboard';
	}

	public function admin_analyzes(){
		$this->layout 	= 'dashboard';
	}


	public function admin_notification(string $uuid){
		$this->layout 	= 'dashboard';
	}


	public function admin_message(){
		$this->layout 	= 'dashboard';
	}

	public function getPost(){
		$data = array(
			"posts" => array(
				0 => array(
					'stamp' => '',
					'title'	=> '',
					'description' => '',
					'img' => array(
						'path'  => '',
						'alt'	=> '',
					),
					'author' => array(
						'name'	=> '',
						'uuid'	=> '',
						'img'	=> '',
						'description'	=> '',
					),
					'likes'	=> 0,
					'comments'	=> array(
						'count' => 0,
					),
					'created'	=> '',
					'modified'	=> '',
				),
			),
		);

		$this->set(compact('data'));
		$this->layout = 'blog';
	}

	public function blog_news(string $param = null){
		$this->layout = 'blog';
		if(empty($param)){

		}

		if($param == 'destaque'){

		}

		if($param == 'editores'){

		}
		/**
		 implementar
		 */
	}

	public function blog_timeline(){
		$this->layout = 'blog';
		/**
		 implementar
		 */
	}

	public function blog_investment(){
		$this->layout = 'blog';
		/**
		 implementar
		 */
	}

	public function blog_insurance(){
		$this->layout = 'blog';
		/**
		 implementar
		 */
	}

	public function blog_view(string $stamp){
		$this->layout = 'blog';
		/**
		 implementar
		 */
	}

	public function blog_analyze(){
		$this->layout = 'blog';
		/**
		 implementar
		 */
	}
}
