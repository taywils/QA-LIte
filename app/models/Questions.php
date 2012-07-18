<?php

namespace app\models;

class Questions extends \lithium\data\Model {

	const MAX = 10; // The default limit to show for the find methods
    // Sorting order flags
	const DESC = false;
	const ASC = true;

	/**
	 * Sorts a tabled array by the given key
	 * @param array $array A single dimensional array 
	 * @param string $key name of the key
	 * @param boolean $asc ASC if TRUE else DESC
	 * @return array $results sorted by the given key
	 * @see http://php.net/manual/en/function.uasort.php
	 */
	private static function sortByOneKey(array $array, $key, $asc = true) {
		$result = array();

		$values = array();
		foreach ($array as $id => $value) {
			$values[$id] = isset($value[$key]) ? $value[$key] : '';
		}

		if ($asc) {
			asort($values);
		}
		else {
			arsort($values);
		}

		foreach ($values as $key => $value) {
			$result[$key] = $array[$key];
		}

		return $result;
	}
	
	/**
	 * Returns the 'x' most recently asked questions where
	 * 'x' is a positive integer
	 * @param int $x the number of questions to return
	 * @return Questions array
	 */
	public static function findTop($x = self::MAX) {
		if (isset($x) and $x <= 0) {
			return null;
		} 
		
		$x = $x > self::MAX ? self::MAX : $x;

		$questions = Questions::find('all', array('limit' => $x))->to('array');
        $questions = array_reverse($questions, false);

		if (count($questions) > 0) {
			return $questions;
		} else {
			return null;
		}
	}
	
	/**
	 * Finds the top questions ordered by the number of unique views
	 * @param none
	 * @return array
	 */
	public static function findPopular() {
		$questions = Questions::find('all')->to('array');
		$preSort = array();
		$sorted = null;
		$popularQuestions = null;
		
		if (count($questions) > 0) {
			foreach($questions as $question) {
				$preSort[] = array('_id' => $question['_id'],
					'uniqueViews' => $question['uniqueViews']);
			}
			
			$sorted = Questions::sortByOneKey($preSort, 'uniqueViews', self::DESC);
			
			$tempMax = count($questions) < self::MAX ? count($questions) : self::MAX;
			for($i = 0; $i < $tempMax; ++$i) {
				$popularQuestions[] = Questions::find($sorted[$i]['_id'])->to('array');
			}

			return $popularQuestions;
		} else {
			return null;
		}
	}

    /**
     * Finds all questions without answers.
     * @static
     * @return array $nonAnsweredQuestions
     */
	public static function findUnAnswered() {
		$questions = Questions::find('all', array('limit' => self::MAX))->to('array');
		$noAns = array();

        foreach($questions as $q) {
            if(empty($q['answers'])) {
                $noAns[] = $q;
            }
        }

        return $noAns;
	}

    public static function topTags() {
        $questions = Questions::find('all', array('fields' => array('tags') ) )->to('array');
        $tags = array();

        foreach($questions as $q) {
            $tags = array_merge($tags, $q['tags']);
        }

        $tags = array_count_values($tags);
        ksort($tags);

        return $tags;
    }
}

?>