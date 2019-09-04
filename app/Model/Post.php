<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property User $User
 */
class Post extends AppModel {


	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'body' => array(
			// 'notBlank' => array(
			// 	'rule' => array('notBlank'),
			// 	'message' => 'não é possivel salvar um Post em branco',
			// 	//'allowEmpty' => true,
			// 	//'required' => false,
			// 	//'last' => false, // Stop validation after this rule
			// 	//'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
			'validateBody' => array(
				'rule' => array('validateBody'),
				'message' => 'Tipo de POST inválido'
			),
		),

	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function validateBody($check){

		//salvo no BD
		return $this->atualizarJson('posts', 'body', ["user_id" => $this->data[$this->alias]['user_id']], '$.body', [$check['body']]);
	}
}
