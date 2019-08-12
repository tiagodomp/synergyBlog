<?php

App::uses('AppController', 'Controller');

class PostController extends AppController {

	public $helpers = array ('Html','Form');
	public $name = 'Posts';

	function index() {
		$this->set('posts', $this->Post->find('all'));
	}
}