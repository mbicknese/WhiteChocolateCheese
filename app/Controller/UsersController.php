<?php

App::uses('AppController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController
{
	public $helpers = array('Html', 'Form');

	public $components = array(
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'users',
				'action' => 'signin'
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'authenticate' => array(
				'Form' => array(
					'passwordHasher' => 'Blowfish'
				)
			)
		)
	);

	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	public function index()
	{
		// Not yet implemented
	}

	/**
	 * Renders login page and handles login post attempts
	 *
	 * @todo Move logic to own component?
	 * @return \Cake\Network\Response|null
	 */
	public function login()
	{
		$this->set('failed_attempt', false);

		if ($this->request->is('post')) {
			$data = $this->data['User'];
			$data['username'] = $this->User->generateUsername($data['password']);
			$this->request->data['User'] = $data;

			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Session->setFlash(__('Opgegeven code is niet bekend'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-danger'
			));

			$this->set('failed_attempt', true);
			$this->set('code', $data['password']);
		}
	}

	public function signin()
	{

	}
}
