<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('JsHelper', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
		'Acl',
		'DebugKit.Toolbar',
		'Session',
		'Auth' => array(
			'authorize'		=> array('Controller'),
			'loginRedirect' => array('controller' => 'Pages', 'action' => 'admin_home'),
			'logoutRedirect' => array('controller' => 'Pages', 'action' => 'blog_home'),
			'authError' => 'Você não tem permissão para acessar essa página',
			'loginError' => 'Username ou senha estão incorretos'
		),
		'Paginator'
	);

	public $helpers = array('Html', 'Form', 'Session', 'Js', 'Paginator');

	public function beforeFilter() {
		//$this->Auth->allow(array('admin_login', 'blog_home', 'admin_register'));
		$this->Auth->loginAction = array(
			'controller' => 'Users',
			'action' => 'admin_login'
		);
		$this->Auth->logoutRedirect = array(
			//'plugin'	=> 'blog',
			'controller' => 'Pages',
			'action' => 'blog_home'
		);
		$this->Auth->loginRedirect = array(
			'controller' => 'Pages',
			'action' => 'admin_home'
		);

	}

	public function isAuthorized($user) {
		// Verifica se o usuário esta ativo
		if(!empty($user['deleted']) || !$user['status'])
			$this->redirect(array('controller' => 'Users', 'action' => 'admin_lock', base64_encode($user['email'])));

		$aco = 'controllers/'.$this->params['controller'];

		//Informando qual grupo o usuario pertence
		$aro = $this->Auth->user('role_uuid');

		//Retornando a validação do privilégio solicitante - recurso/privilegio
		return $this->Acl->check($aro, $aco, $this->params['action']);
	}

	public function beforeRender() {
		parent::beforeRender();

		$redis = new Redis();
		$redis->connect('redis', 6379);

		if(!empty($this->Auth->user('uuid'))){
			$admin_data =[
				'notifications' => [
					'count'	=> 0,
					'all' 	=> [
						[
							'uuid'	=> null,
							'type'	=> '',
							'title'	=> '',
							'created'	=> '',
						],
					],
				],
				'messages' => [
					'count' => 0,
					'all'	=> [
						[
							'uuid'	=> '',
							'author' => [
								'uuid'	=> null,
								'name' 	=> null,
								'img'	=> null,
								'msg' 	=> null,
							],
							'created' => '',
						]
					],
				],
				'profile'	=> [
					'uuid'	=> null,
					'img'	=> null,
					'name'	=> null,
					'first_name'	=> null,
				],
			];
			$redis->set('admin_data', json_encode($admin_data));
		}else{
			$blog_data = [
				'posts'	=> [
					[
						'stamp' => '',
						'title'	=> '',
						'description' => '',
						'img' => [
							'path'  => '',
							'alt'	=> '',
						],
						'author' => [
							'name'	=> '',
							'uuid'	=> '',
							'img'	=> '',
							'description'	=> '',
						],
						'likes'	=> 0,
						'comments'	=> [
							'count' => 0,
						],
						'created'	=> '',
						'modified'	=> '',
					]
				],
				'news'	=> [
					[
						'stamp' => '',
						'title'	=> '',
						'description' => '',
						'img' => [
							'path'  => '',
							'alt'	=> '',
						],
						'author' => [
							'name'	=> '',
							'uuid'	=> '',
							'img'	=> '',
							'description'	=> '',
						],
						'likes'	=> 0,
						'comments'	=> [
							'count' => 0,
						],
						'created'	=> '',
						'modified'	=> '',
					]
				],
				'money'	=> [
					'USD' => [
						'name' => '',
						'bid' => '',
					],
					'EUR' => [
						'name' => '',
						'bid' => '',
					],
					'BTC' => [
						'name' => '',
						'bid' => '',
					],
					'LTC' => [
						'name' => '',
						'bid' => '',
					],
					'JPY' => [
						'name' => '',
						'bid' => '',
					],
					'CNY' => [
						'name' => '',
						'bid' => '',
					],
				],
				'postPop' => [
					[
						'stamp' => '',
						'title'	=> '',
						'description' => '',
						'img' => [
							'path'  => '',
							'alt'	=> '',
						],
						'author' => [
							'name'	=> '',
							'uuid'	=> '',
							'img'	=> '',
							'description'	=> '',
						],
						'likes'	=> 0,
						'comments'	=> [
							'count' => 0,
						],
						'created'	=> '',
						'modified'	=> '',
					]
				],
			];
			$redis->set('blog_data', json_encode($blog_data));
		}
    }
}
