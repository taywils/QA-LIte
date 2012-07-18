<?php

namespace app\models;

class Answers extends \lithium\data\Model {
	const MAX = 10; //Default number of answers to view on the homepage

	public static function topAnswers($x = self::MAX) {
		$x = $x > self::MAX ? self::MAX : $x;

		$answers = Answers::find('all', array('limit' => $x))->to('array');

		if(!empty($answers)) {
            return $answers;
        } else {
            $message = "There are currently no answers, login to add some!";
            return $message;
        }
	}

    public static function getAnswersByOwnerName($owner) {
    	$query = array('conditions' => array('owner' => $owner));
    	$answers = Answers::find('all', $query)->to('array');

        return $answers;
    }

    public static function getAnswersByQuestionId($questionId) {
        $query = array('conditions' => array('questionId' => $questionId));
        $answers = Answers::find('all', $query)->to('array');

        return $answers;
    }
}