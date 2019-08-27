<?php

App::uses('Component', 'Core');

class HomeComponent extends Component {

    public function __construct(){

	}

	/**
	 * Antes do beforeFilter do controller
	 */
    public function initialize(){

	}

	/**
	 * Antes do controller executar a ação
	 */
	public function startup(){

	}

	/**
	 * Executado após a lógica antes da view
	 */
	public function beforeRender(){

	}

	public function getPosts(){
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
					'gamification' => array(),
					'created'	=> '',
					'modified'	=> '',
				),
			),
		);

		return $data;
	}
}
