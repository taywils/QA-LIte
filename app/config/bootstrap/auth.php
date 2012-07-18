<?php
use lithium\storage\Session;
use lithium\security\Auth;

Session::config(array(
		'default' => array('adapter' => 'Php')
));

Auth::config(array(
		'user' => array(
				'adapter' => 'Form',
				'model'   => 'Users',
				'fields'  => array('username', 'password')
		)
));
?>