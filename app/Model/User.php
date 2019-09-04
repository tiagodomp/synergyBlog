<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Group $Group
 * @property Post $Post
 */
class User extends AppModel {
	public $name = 'User';
	public $displayField = 'username';
    public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        }
        return array('Group' => array('id' => $groupId));
    }
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Por favor preencha o campo Username',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'between' => array(
				'rule' => array('between', 5, 15),
				'required' => true,
				'message' => 'Username tem que conter de 5 a 15 caracteres'
			),
			'unique' => array(
				'rule' => array('isUniqueUsername'),
				'message' => 'Este username ja esta em uso tenten outro'
			),
			'alphaNumericDashUnderscore' => array(
				'rule' => array('alphaNumericDashUnderscore'),
				'message' => 'O username só pode conter letras números e/ou sublinhados'
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Não é permitido a senha em Branco',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'lengthBetween' => array(
				'rule' => array('lengthBetween', 8, 20),
				'message' => 'A senha tem que conter entre 8 a 20 caracteres'
			),
			'validatePassword' => array(
				'rule' => array('validatePassword'),
				'message' => 'A senha tem que incluir pelo menos um número, uma MAIÚSCULA um símbolo (@#$%!) e um caractere japonês :)'
			),
		),
		'password_confirm' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Por favor preencha o campo Username',
				'allowEmpty' => true,
				'required' => false,
			),
			'equaltofield' => array(
				'rule' => array('equaltofield', 'password'),
				'message' => 'A senha esta diferente!'
			)
		 ),
		 'password_update' => array(
			'lengthBetween' => array(
				'rule' => array('lengthBetween', 8, 20),
				'message' => 'A senha tem que conter entre 8 a 20 caracteres',
				'allowEmpty' => true,
				'required' => false,
				//'on' => 'update', // Limit validation to 'create' or 'update' operations
			),
			'validatePassword' => array(
				'rule' => 'validatePassword',
				'message' => 'A senha tem que incluir pelo menos um número, uma MAIÚSCULA um símbolo (@#$%!) e um caractere japonês :)',
				'allowEmpty' => true,
			),
			'compareLastFivePassword' => array(
				'rule'	=> 'compareLastFivePassword',
				'message' => 'Você utilizou esta mesma senha recentemente, crie outra!'
			),
		),
		'password_confirm_update' => array(
			'equaltofield' => array(
				'rule' => array('equaltofield', 'password_update'),
				'message' => 'A senha esta diferente!',
				'required' => false,
				//'on' => 'update', // Limit validation to 'create' or 'update' operations [a-z]+.*[A-Z]+.*[0-9]+.*[!@#$%*()_]+
			)
		),
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
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
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	/**
	 * Antes da regra isUniqueUsername
	 * @param array $options
	 * @return bool
	 */
	public function isUniqueUsername($check) {

		$username = $this->find(
			'first',
			array(
				'fields' => array(
					'User.id',
					'User.username'
				),
				'conditions' => array(
					'User.username' => $check['username']
				)
			)
		);

		if(!empty($username)){
			return ($this->data[$this->alias]['id'] == $username['User']['id'])? true:false;
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

	/**
	 *  Verifica se o valor passado contem no minimo 1 letra maiuscula e 1 minuscula, 1 número e 1 caractere especial
	 *  @param array $check
	 *  @return bool
	 */
	public function validatePassword($check){
		return preg_match('/^(?=.*[a-z])+(?=.*[A-Z])+(?=.*[0-9])+(?=.*[!@#$%\/*()_\/-])+.*/', array_values($check)[0]);
	}

	/**
	 * Compara as últimas 5 senhas salvas no BD e caso não tenha uma igual apaga a mais antiga e insere a nova mantendo sempre um total de 5 senhas
	 * @param array $check 	| [password_update => '']
	 */
	public function compareLastFivePassword($check){
		$senhas = (array) $this->query("SELECT info->>'$.lastFivePassword' FROM blog.users WHERE 'id' = ".$this->data[$this->alias]['id']);
		//Verifico se entre as ultimas 5 alguma é igual, caso positivo retorno falso
		foreach ($senhas as $key => $senha){
			if($senha[$key]['pass'] == $check['password_update']){
				return false;
			}
		}

		//verifico se contém 5 senhas e caso seja verdadeiro apago a última
		if(count($senhas) == 5){
			$senhas = array_pop($senhas);
		}

		//insiro no inicio a nova senha
		$senhas = (array) array_unshift($senhas, ['pass' => $check['password_update'], 'created' => gmdate('Y-m-d H:i:s')]);

		//salvo no BD
		return $this->atualizarJson('users', 'info', ["id" => $this->data[$this->alias]['id']], '$.lastFivePassword', $senhas);
	}


	public function equaltofield($check,$otherfield){
		//get name of field
		$fname = '';
		foreach ($check as $key => $value){
			$fname = $key;
			break;
		}
		return $this->data[$this->alias][$otherfield] === $this->data[$this->alias][$fname];
	}

	public function beforeSave($options = array()) {
        // $this->data['User']['password'] = AuthComponent::password(
        //   $this->data['User']['password']
		// );
		// 1º acesso
		if (isset($this->data[$this->alias]['password'])) {
			$crypto = AuthComponent::password($this->data[$this->alias]['password']);
			$this->data[$this->alias]['password'] = $crypto;
			$this->data[$this->alias]['info'] = json_encode(array('lastFivePassword' => [['pass' => $crypto, 'created' => gmdate('Y-m-d H:i:s')]]));
		}

		// Ao atualizar a senha
		if (!empty($this->data[$this->alias]['password_update'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
		}
		parent::beforeSave($options);
        return true;
	}

	public function bindNode($user) {
		return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
	}


}
