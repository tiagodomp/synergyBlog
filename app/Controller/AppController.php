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
			'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authError' => 'Faça login novamente para acessar essa Página',
			'loginError' => 'Username ou senha estão incorretos'
		)
	);

	public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'));

	public function beforeFilter() {
		$this->Auth->allow(array('login', 'home', 'register'));
		$this->Auth->loginAction = array(
			'controller' => 'users',
			'action' => 'login'
		  );
		  $this->Auth->logoutRedirect = array(
			'controller' => 'pages',
			'action' => 'home'
		  );
		  $this->Auth->loginRedirect = array(
			'controller' => 'pages',
			'action' => 'admin_home'
		  );
	}

	public function isAuthorized($user) {
		// inserir verificação de role

		return true;
	}
}
