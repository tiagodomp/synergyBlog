<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	public $helpers = array('Js');

/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */


	public function beforeFilter()
	{
		$this->Auth->allow(array(
			'home',
			'admin_home',
			'blog_home',
			'blog_aboutUs',
			'blog_contacts',
		));
	}
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		if (in_array('..', $path, true) || in_array('.', $path, true)) {
			throw new ForbiddenException();
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

	public function home(){
	}

	public function admin_home(){
		$this->layout 	= 'dashboard';
		$this->title	= 'teste';
	}

	public function cotationMoney(){
		$http = new HttpSocket();
		$result = json_decode($http->get('https://economia.awesomeapi.com.br/all'), true);

		// EXEMPLO
		// {
		// 	"USD": {
		// 		"code": "USD",
		// 		"codein": "BRL",
		// 		"name": "Dólar Comercial",
		// 		"high": "4,1572",
		// 		"low": "4,1474",
		// 		"varBid": "-0,0044",
		// 		"pctChange": "-0,10",
		// 		"bid": "4,1518",
		// 		"ask": "4,1533",
		// 		"timestamp": "1566907678",
		// 		"create_date": "2019-08-27 09:07:59"
		// 	},
		// 	"USDT": {
		// 		"code": "USD",
		// 		"codein": "BRLT",
		// 		"name": "Dólar Turismo",
		// 		"high": "4.15",
		// 		"low": "4.13",
		// 		"varBid": "-0.16",
		// 		"pctChange": "-3.704",
		// 		"bid": "4.15",
		// 		"ask": "4.16",
		// 		"timestamp": "1566907200000",
		// 		"create_date": "2019-08-27 09:06:00"
		// 	},
		// 	"CAD": {
		// 		"code": "CAD",
		// 		"codein": "BRL",
		// 		"name": "Dólar Canadense",
		// 		"high": "3,1423",
		// 		"low": "3,1348",
		// 		"varBid": "0,0038",
		// 		"pctChange": "0,12",
		// 		"bid": "3,1383",
		// 		"ask": "3,1396",
		// 		"timestamp": "1566907674",
		// 		"create_date": "2019-08-27 09:07:55"
		// 	},
		// 	"EUR": {
		// 		"code": "EUR",
		// 		"codein": "BRL",
		// 		"name": "Euro",
		// 		"high": "4,6184",
		// 		"low": "4,6048",
		// 		"varBid": "-0,0023",
		// 		"pctChange": "-0,05",
		// 		"bid": "4,6100",
		// 		"ask": "4,6125",
		// 		"timestamp": "1566907675",
		// 		"create_date": "2019-08-27 09:07:55"
		// 	},
		// 	"GBP": {
		// 		"code": "GBP",
		// 		"codein": "BRL",
		// 		"name": "Libra Esterlina",
		// 		"high": "5,1008",
		// 		"low": "5,0728",
		// 		"varBid": "0,0164",
		// 		"pctChange": "0,32",
		// 		"bid": "5,0920",
		// 		"ask": "5,0955",
		// 		"timestamp": "1566907675",
		// 		"create_date": "2019-08-27 09:07:56"
		// 	},
		// 	"ARS": {
		// 		"code": "ARS",
		// 		"codein": "BRL",
		// 		"name": "Peso Argentino",
		// 		"high": "0,0752",
		// 		"low": "0,0750",
		// 		"varBid": "-0,0001",
		// 		"pctChange": "-0,13",
		// 		"bid": "0,0751",
		// 		"ask": "0,0751",
		// 		"timestamp": "1566907674",
		// 		"create_date": "2019-08-27 09:07:55"
		// 	},
		// 	"BTC": {
		// 		"code": "BTC",
		// 		"codein": "BRL",
		// 		"name": "Bitcoin",
		// 		"high": "43.100,0",
		// 		"low": "42.200,4",
		// 		"varBid": "-112,0",
		// 		"pctChange": "-0,26",
		// 		"bid": "42.356,0",
		// 		"ask": "42.360,0",
		// 		"timestamp": "1566907650",
		// 		"create_date": "2019-08-27 09:07:30"
		// 	},
		// 	"LTC": {
		// 		"code": "LTC",
		// 		"codein": "BRL",
		// 		"name": "Litecoin",
		// 		"high": "303,89",
		// 		"low": "299,00",
		// 		"varBid": "0,00",
		// 		"pctChange": "0,00",
		// 		"bid": "299,39",
		// 		"ask": "301,00",
		// 		"timestamp": "1566907647",
		// 		"create_date": "2019-08-27 09:07:27"
		// 	},
		// 	"JPY": {
		// 		"code": "JPY",
		// 		"codein": "BRL",
		// 		"name": "Iene Japonês",
		// 		"high": "0,03934",
		// 		"low": "0,03915",
		// 		"varBid": "0,00010",
		// 		"pctChange": "0,26",
		// 		"bid": "0,03924",
		// 		"ask": "0,03926",
		// 		"timestamp": "1566907665",
		// 		"create_date": "2019-08-27 09:07:45"
		// 	},
		// 	"CHF": {
		// 		"code": "CHF",
		// 		"codein": "BRL",
		// 		"name": "Franco Suíço",
		// 		"high": "4,2508",
		// 		"low": "4,2327",
		// 		"varBid": "-0,0067",
		// 		"pctChange": "-0,16",
		// 		"bid": "4,2373",
		// 		"ask": "4,2393",
		// 		"timestamp": "1566907674",
		// 		"create_date": "2019-08-27 09:07:55"
		// 	},
		// 	"AUD": {
		// 		"code": "AUD",
		// 		"codein": "BRL",
		// 		"name": "Dólar Australiano",
		// 		"high": "2,8188",
		// 		"low": "2,8031",
		// 		"varBid": "-0,0050",
		// 		"pctChange": "-0,18",
		// 		"bid": "2,8099",
		// 		"ask": "2,8112",
		// 		"timestamp": "1566907673",
		// 		"create_date": "2019-08-27 09:07:54"
		// 	},
		// 	"CNY": {
		// 		"code": "CNY",
		// 		"codein": "BRL",
		// 		"name": "Yuan Chinês",
		// 		"high": "0,5816",
		// 		"low": "0,5792",
		// 		"varBid": "0,0025",
		// 		"pctChange": "0,43",
		// 		"bid": "0,5792",
		// 		"ask": "0,5795",
		// 		"timestamp": "1566907623",
		// 		"create_date": "2019-08-27 09:07:03"
		// 	},
		// 	"ILS": {
		// 		"code": "ILS",
		// 		"codein": "BRL",
		// 		"name": "Novo Shekel Israelense",
		// 		"high": "1,1819",
		// 		"low": "1,1783",
		// 		"varBid": "0,0072",
		// 		"pctChange": "0,61",
		// 		"bid": "1,1786",
		// 		"ask": "1,1791",
		// 		"timestamp": "1566907625",
		// 		"create_date": "2019-08-27 09:07:06"
		// 	},
		// 	"ETH": {
		// 		"code": "ETH",
		// 		"codein": "BRL",
		// 		"name": "Ethereum",
		// 		"high": "798,00",
		// 		"low": "782,00",
		// 		"varBid": "16,00",
		// 		"pctChange": "2,05",
		// 		"bid": "771,00",
		// 		"ask": "785,99",
		// 		"timestamp": "1566907673",
		// 		"create_date": "2019-08-27 09:07:53"
		// 	},
		// 	"XRP": {
		// 		"code": "XRP",
		// 		"codein": "BRL",
		// 		"name": "Ripple",
		// 		"high": "1,12",
		// 		"low": "1,10",
		// 		"varBid": "-0,01",
		// 		"pctChange": "-1,29",
		// 		"bid": "1,10",
		// 		"ask": "1,11",
		// 		"timestamp": "1566907653",
		// 		"create_date": "2019-08-27 09:07:34"
		// 	}
		// }
	}

	public function blog_home(){
		$this->layout = 'blog';

		$data = array(
			"posts" => array(
				0 => array(
					'stamp' => '',
					'title'	=> 'teste',
					'description' => 'descrição de teste',
					'img' => array(
						'path'  => '',
						'alt'	=> '',
					),
					'author' => array(
						'name'	=> 'Tiago',
						'uuid'	=> '001a',
						'img'	=> '',
						'description'	=> '',
					),
					'likes'	=> 6,
					'comments'	=> array(
						'count' => 10,
					),
					'created'	=> gmdate('Y-m-d H:i:s'),
					'modified'	=> '',
				),
				1 => array(
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
				2 => array(
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
				3 => array(
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
				4 => array(
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
				5 => array(
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
				6 => array(
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
	}

	public function blog_aboutUs(){
		/**
		 implementar
		 */
	}

	public function blog_contacts(){
		/**
		 implementar
		 */
	}
}
