<?php
App::uses('AppModel', 'Model');

/**
 * Data management model for users
 */
class User extends AppModel {
    public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'A username is required',
			),
		),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is required',
            ),
        ),
    );

	public function beforeSave($options = [])
	{
		if (!empty($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}

	/**
	 * Builds a consistent username based on password
	 *
	 * @fixme Store salt in save and per environment location
	 * @param  $password string
	 * @return string
	 */
	public static function generateUsername($password)
	{
		$hash = md5($password . 'unsavesalt12345');
		return substr($hash, 1, 16);
	}
}
