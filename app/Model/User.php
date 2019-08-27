<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Core'); // esta em todas
App::uses('CakeEvent', 'Event');
App::uses('Router', 'Core'); // esta em todas


/**
 * user Model
 *
 */
class User extends AppModel {


	public $name = 'User';
	public $primaryKey = 'uuid';
	public $displayField = 'username';
	public $hasOne = array(
        'Profile' => array(
            'className'  => 'Profile',
			'conditions' => array('Profile.deleted' => null),
			'foreignKey' => 'users_uuid',
            'dependent'  => true
        )
    );

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
		'email' => array(
			'required' => array(
				'rule' => array('email', true),
				'message' => array('Este endereço de E-mail é inválido'),
				'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => 'isUniqueEmail',
				'message' => 'Este E-mail ja esta em uso'
			),
			'between' => array(
				'rule' => array('between', 6, 60),
				'message' => 'O e-mail deve conter mais do que 6 caracteres',
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Não é permitido a senha em Branco',
				'allowEmpty' => false,
				'required' => true,
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
				'allowEmpty' => false,
				'required' => true,
			),
			'equaltofield' => array(
				'rule' => array('equaltofield', 'password'),
				'message' => 'A senha esta diferente!'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'workerMaster', 'worker')),
				'message' => 'Esta regra de usuário é invalida',
				'allowEmpty' => false
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
	);

	public $virtualFields = array();

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
					'User.uuid',
					'User.username'
				),
				'conditions' => array(
					'User.username' => $check['username']
				)
			)
		);

		if(!empty($username)){
			return ($this->data[$this->alias]['uuid'] == $username['User']['uuid'])? true:false;
		}else{
			return true;
		}
	}

	/**
	 * Before isUniqueEmail
	 * @param array $options
	 * @return boolean
	 */
	public function isUniqueEmail($check) {
		$email = $this->find(
			'first',
			array(
				'fields' => array(
					'User.uuid'
				),
				'conditions' => array(
					'User.email' => $check['email']
				)
			)
		);

		if(!empty($email)){
			return $this->data[$this->alias]['uuid'] == $email['User']['uuid'];
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
		// $this->virtualFields['lastFivePassword'] = "info->>'$.lastFivePassword'";
		// $senhas = json_decode($this->field('lastFivePassword', array('password' => $check['password'])), true);
		$senhas = (array) $this->query("SELECT info->>'$.lastFivePassword' FROM blog.users WHERE 'uuid' = ".$this->data[$this->uuid]);
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
		return $this->atualizarJson('users', 'info', ["uuid" => $this->data[$this->uuid]], '$.lastFivePassword', $senhas);
	}


	public function equaltofield($check,$otherfield) {
		//get name of field
		$fname = '';
		foreach ($check as $key => $value){
			$fname = $key;
			break;
		}
		return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
	}

	/**
	 * @param array $options
	 * @return boolean
	 */
	public function beforeSave($options = array()) {
		//
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}

		// Ao atualizar a senha
		if (!empty($this->data[$this->alias]['password_update'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
		}

		// fallback to our parent
		return parent::beforeSave($options);
	}
}
