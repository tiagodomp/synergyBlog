<?php
App::uses('AppModel', 'Model');
/**
 * Profile Model
 *
 */
class Profile extends AppModel {

	public $name = 'Profile';
	public $primaryKey = 'uuid';
	public $displayField = 'first_name';
	public $hasOne = array(
        'Post' => array(
            'className' => 'Post',
			'conditions' => array('Post.deleted' => null),
			'foreignKey' => 'profiles_uuid',
            'dependent' => false
        )
	);

	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
			'conditions' => array('User.deleted' => null),
			'foreignKey' => 'users_uuid',
            'dependent' => true,
		)
	);


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		// 'uuid' => array(
		// 	'uuid' => array(
		// 		'rule' => array('uuid'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		'user_uuid' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				'message' => 'É necessário relacionar um usuário',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'È obrigatório o primeiro nome do Perfil',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => '',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'contacts' => array(
			'valid' => array(
				'rule' => array('serializeContacts'),
				'message' => 'Este contato é invalido',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'img' => array(
			'valid' => array(
				'rule' => array('serializeImg'),
				'message' => 'Esta imagem é invalida',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'gamification' => array(
			'valid' => array(
				'rule' => array('serializeGamification'),
				'message' => 'Erro ao inserir dados game',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'configuration' => array(
			'valid' => array(
				'rule' => array('serializeConfiguration'),
				'message' => 'Esse tipo de configuração é inválida',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'info' => array(
			'valid' => array(
				'rule' => array('serializeInfo'),
				'message' => 'Erro ao inserir dados game',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	public $virtualFields = array();
}
