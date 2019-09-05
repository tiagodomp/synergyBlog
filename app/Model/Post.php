<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property User $User
 * @property Comment $Comment
 * @property Tag $Tag
 */
class Post extends AppModel {

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
	);

	public $uses = array('Tag');

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
		),
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'comment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => array('id', 'name'),
			'order' => ''
		)
	);

	public function afterFind($results, $primary = false){
		parent::afterFind($results, $primary);
		foreach ($results as &$val) {
			if(isset($val['Post']['tag_id']) && isset($val['Tag'])){
				$val['Tag'] = [];
				$tagsArray = json_decode($val['Post']['tag_id'], true)?:[];
				foreach($tagsArray as $tag_id){
					$val['Tag'][] = $this->Tag->find('list', array(
									'conditions' => array('id' => $tag_id)
								),
							);
				}
			}
		}
		return $results;


	}
}
