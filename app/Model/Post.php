<?php

// namespace App\Model;

use App\Model\Traits\CrudJsonTrait;

App::uses('AppModel', 'Model');
App::uses('CakeEvent', 'core');
// App::uses('CrudJsonTrait', 'Model/Traits');

class Post extends AppModel {

	// use CrudJsonTrait;

	public $name = 'Post';
	public $primaryKey = 'uuid';
	public $displayField = 'username';
	public $belongsTo = array(
        'Profile' => array(
            'className' => 'Profile',
			'conditions' => array('Profile.deleted' => null),
			'foreignKey' => 'profile_uuid',
            'dependent' => false,
		)
	);

	public $actsAs = array(
        'Upload.Upload' => array(
            'photo' => array(
                'fields' => array(
                    'dir' => 'photo_dir'
                )
            )
        )
	);

	public $virtualFields = array();

	public function buildBody(){
		$stamp = gmdate('\TYmdHis');
		$body = array(
			$stamp => array(
				'img' => array(
					'path'  => '',		//string
					'alt'	=> '',		//string
					'type'	=> '',		//MIMEType
					'size'	=> '',		//int -> kb
				),
				'title'	=> '',			//string - 128
				'description' => '',	//string - 256
				'likes'	=> 0,			//int
				'comments'	=> array(
					'count' => 0,		//int
					'msg'	=> array(

					)
				),
				'body'		=> array(
					'type'	=> '',		//MIMEType
					'data'	=> ''		//string
				),
				'created'	=> '',		//datetime
				'modified'	=> '',		//datetime
			)
		);
	}

	public function buildInfo(){

	}

	public function buildGamification(){

	}

	/**
	 * Após criar a tabela post significa que o usuario foi devidamente cadastrado e isso emitira uma notificação via REDIS
	 *
	 */
	public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);
        if ($created === true) {
            $Event = new CakeEvent('Model.Post.created.Notificacao', $this, array(
				'toRoom'=> $this->uuid,
				'event' => 'user.created',
				'url'	=> Router::url(['controller' => 'Profiles', 'action' => 'view', $this->profiles_uuid], true),
                'body' 	=> $this->data[$this->alias]
            ));
            $this->getEventManager()->dispatch($Event);
        }
    }
}