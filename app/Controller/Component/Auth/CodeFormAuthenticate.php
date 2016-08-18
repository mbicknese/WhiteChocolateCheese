<?php

App::uses('FormAuthenticate', 'Controller/Component/Auth');
App::uses('User', 'Model');
App::uses('LoginAttempt', 'Model');

class CodeFormAuthenticate extends FormAuthenticate
{
	public function authenticate(CakeRequest $request, CakeResponse $response)
	{
		$userModel = $this->settings['userModel'];
		list(, $model) = pluginSplit($userModel);

		$fields = $this->settings['fields'];

		$request->data[$model][$fields['username']] =
			User::generateUsername($request->data[$model][$fields['password']]);

		$user = parent::authenticate($request, $response);
		LoginAttempt::createFromRequest($request, $user);
		return $user;
	}
}
