<?php
App::uses('AppModel', 'Model');
/**
 * Profile Model
 *
 */
class Role extends AppModel {

	public $name = 'Role';
	public $primaryKey = 'uuid';
	public $displayField = 'name';
	public $hasMany = array(
        'User' => array(
            'className' => 	'User',
			'conditions'=> 	array('User.deleted' => null),
			'foreignKey'=> 	'role_uuid',
			'order'		=>	'User.role_uuid ASC',
            'dependent' => 	true,
		)
	);


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'É obrigatório definir um nome para esta nova regra',
				'allowEmpty' => false,
				'required' => true,
			),
			'between' => array(
				'rule' => array('between', 3, 10),
				'required' => true,
				'message' => 'o Nome da regra tem que conter entre 3 a 10 caracteres'
			),
			'unique' => array(
				'rule' => array('isUniqueName'),
				'message' => 'Esta regra ja foi definida, tente outro nome'
			),
			'alphaNumericDashUnderscore' => array(
				'rule' => array('alphaNumericDashUnderscore'),
				'message' => 'O nome da regra só pode conter letras números e/ou sublinhados'
			),
		)
	);

	public $virtualFields = array();

	/**
	 * verify if isUnique
	 * @param array $options
	 * @return bool
	 */
	public function isUniqueName($check) {

		$name = $this->find(
			'first',
			array(
				'fields' => array(
					'Role.uuid',
					'Role.name'
				),
				'conditions' => array(
					'Role.name' => $check['name']
				)
			)
		);

		if(!empty($name)){
			return ($this->data[$this->alias]['uuid'] == $name['Role']['uuid'])? true:false;
		}else{
			return true;
		}
	}

	/**
	 *  Verifica se o valor passado contém somente alfanuméricos e/ou _ ou -
	 *  @param array $check
	 *  @return bool
	 */
	public function alphaNumericDashUnderscore($check) {
		return preg_match('/^[a-zA-Z0-9_ \-]*$/', array_values($check)[0]);
	}
}
