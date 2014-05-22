<?php
App::uses('PostAppModel', 'Post.Model');
App::import('Sluggable', 'Utils.Sluggable');
/**
 * Post Model
 *
 */
class Post extends PostAppModel
{

/**
 * Define Custom Find Type
 *
 * With this we'll have all published posts
 *
 * @var array
 */
    public $findMethods = array('published' =>  true);

/**
 * Define the usage for the slug behaviour
 *
 * @var array
 */
	public $actsAs = array(
	    'Utils.Sluggable' => array(
	        'label' => 'title',
	        'method' => 'multibyteSlug',
	        'separator' => '-'
	    ),
	    'Utils.Toggleable' => array(
	        'fields' => array(
	        	'published' => array(1, 0)
	        )
	    )
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'slug' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'keywords' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'content' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

    /**
     * Custom find method to return only published posts
     *
     * @param string $state   of the find
     * @param array  $query   of the find
     * @param array  $results of the find
     *
     * @return mixed
     */
    protected function _findPublished($state, $query, $results = array()) {
        if ($state === 'before') {
            $query['conditions']['Post.published'] = true;
            return $query;
        }
        return $results;
    }

    /**
     * slugExists
     *
     * @param string $slug to check if exists
     *
     * @return mixed
     */
    public function slugExists($slug)
    {
        return $this->find('count', array('conditions' => array('slug' => $slug), 'recursive' => -1));
    }
}
