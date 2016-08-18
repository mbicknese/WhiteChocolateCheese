<?php

App::uses('AppModel', 'Model');

/**
 * A new login attempt is saved every time a code is posted
 *
 * These attempts can be used to limit the amount of tries one can submit before being throttled or
 * completely banned from the log in system.
 */
class LoginAttempt extends AppModel
{

	public static function createFromRequest($request, $user = null)
	{
		$attempt = new LoginAttempt();
		$attempt->save(['LoginAttempt' => [
			'useragent'	=> $request->header('User-Agent'),
			'ip' 	    => $request->clientIp(),
			'session'   => session_id(),
			'user_id'   => $user ? $user['id'] : null,
		]]);

		return $attempt;
	}
}
