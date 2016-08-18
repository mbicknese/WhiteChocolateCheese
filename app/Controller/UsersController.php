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
				'CodeForm' => array(
					'passwordHasher' => 'Blowfish'
				)
			)
		)
	);

	/**
	 * Renders login page and handles login post attempts
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function login()
	{
		$this->set('failed_attempt', false);

		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Session->setFlash(__('Opgegeven code is niet bekend'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-danger'
			));

			$this->set('failed_attempt', true);
			$this->set('code', $this->request->data['User']['password']);
		}
	}

	public function signin()
	{

	}
}
