<?php

namespace app\models;
use app\models\Questions;

class Users extends \lithium\data\Model {

	public static function getQuestionsByUserName($username) {
        $myQuestions = Questions::find('all', array(
            'conditions' => array('owner' => $username)
        ))->to('array');

        return $myQuestions;
    }

    public static function getUserInfo($username, array $fields) {
        $query = array('conditions' => array('username' => $username), 'fields' => $fields, 'limit' => 1);

        $info = Users::find('all', $query)->to('array');

        return $info[0];
    }
}

Users::applyFilter('save', function($self, $params, $chain){
	$record = $params['entity'];
	
	if (!$record->id) {
		$record->password = \lithium\util\String::hash($record->password);
	}
	
	if (!empty($params['data'])) {
		$record->set($params['data']);
	}
	
	$params['entity'] = $record;
	
	return $chain->next($self, $params, $chain);
});

?>