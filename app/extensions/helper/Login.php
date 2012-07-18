<?php

namespace app\extensions\helper;

use lithium\security\Auth;

class Login extends \lithium\template\Helper {

	public function getUserName() {

		$user = Auth::check('user');

		if(!empty($user)) {
			return $user['username'];
		} else {
			return null;
		}
	}

}

?>