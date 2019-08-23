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

	public $virtualFields = array();

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