<?php
App::uses('AppModel', 'Model');
/**
 * Tag Model
 *
 * @property User $User
 */
class Tag extends AppModel {


	public $displayField = 'name';

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
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Não pode criar uma tag nula',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUniqueName' => array(
				'rule' => 'isUniqueName',
				'message' => 'Esta tag ja existe, por favor crie outra'
			),
			'between' => array(
				'rule' => array('between', 2, 14),
				'required' => true,
				'message' => 'A tag tem que conter de 3 a 12 caracteres'
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

	/**
	 * Antes da regra isUniqueName
	 * @param array $options
	 * @return bool
	 */
	public function isUniqueName($check) {

		$tag = $this->find(
			'first',
			array(
				'fields' => array(
					'Tag.id',
					'Tag.name'
				),
				'conditions' => array(
					'Tag.name' => $check['name']
				)
			)
		);
		if(!empty($tag)){
			return $this->data[$this->alias]['name'] != $tag[$this->alias]['name'];
		}else{
			return true;
		}
	}
}
