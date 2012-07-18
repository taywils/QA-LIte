<?php

namespace app\controllers;

use app\models\Questions;
use app\models\Users;
use app\models\Answers;

class QuestionsController extends \lithium\action\Controller {
	
	public function ask() {
		if(isset($this->request->data['Title'])) {
			$owner = $this->request->data['Owner'];
			$title = $this->request->data['Title'];
			$body = $this->request->data['Body'];
			$dateCreated = date("Y-m-d H:m:s");
			$tags = preg_split("/[\s,]+/", trim($this->request->data['Tags']));
            $tags = array_unique($tags);
			foreach($tags as &$tag) {
				$tag = strtolower($tag);
			}
			$answers = array();

            $userInfo = Users::getUserInfo($owner, array('iconUri'));
			
			$doc = array("owner" => $owner, "title" => $title, "body" => $body, 
					"dateCreated" => $dateCreated, "tags" => $tags, "answers" => $answers,
					"uniqueViews" => 0, "icon" => $userInfo['iconUri']);
			
			$question = Questions::create($doc);
						
			$response = $question->save();
			
			return compact('response');
		}
	}
	
	public function view() {
		$query = array();
		$error = null;

		if(isset($_REQUEST['search']) && $_REQUEST['search'] != "") {
			$search = $_REQUEST['search'];
			$query = array('conditions' => 
				array('title' => array('like' => '/'.$search.'/i'))
			);
		} else if(isset($_REQUEST['tagSearch'])) {
			$tagSearch = $_REQUEST['tagSearch'];	
			$query = array('conditions' => array('tags' => $tagSearch));
		}

		$questions = Questions::find('all', $query)->to('array');
		$count = count($questions);

		if(0 == $count) {
			$error = "No results found for \"".$search."\"";
		}

		return compact('questions', 'count', 'error');
	}
	
	public function read() {
		if(!isset($this->request->data['AnswerText'])) {
			$id = $_REQUEST['id'];
			$question = Questions::find($id);
            $answersQuery = array('conditions' => array('questionId' => $id));
            $answers = Answers::find('all', $answersQuery)->to('array');
			
			return compact('question', 'answers');
		} else {
			$answerText = $this->request->data['AnswerText'];
			$owner = $this->request->data['Owner'];
			$questionId = $this->request->data['QuestionId'];
			$dateCreated = date("Y-m-d H:m:s");

			$newAnswer = array( 'owner' => $owner, 'body' => $answerText,
					'dateCreated' => $dateCreated, 'questionId' =>$questionId);

            $answer = Answers::create($newAnswer);
            $savedAnswer = $answer->save();

            if(true == $savedAnswer) {
                Questions::find($questionId);

                //@see http://stackoverflow.com/questions/4638368
                $updatedQuestion = Questions::update(array('$push' => array('answers' => $answer['_id'])),
                        array('_id' => $questionId));

                if(true == $updatedQuestion) {
                    $this->redirect("/");
                } else {
                    $error = "Failed to save new answer, please try again.";

                    return compact('error');
                }

            } else {
                $error = "Failed to save new answer, please try again.";

                return compact('error');
            }
		}
	}
	
	public function edit() {
        $id = $_REQUEST['id'];
        $question = Questions::find($id)->to('array');

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newTitle = $this->request->data['newTitle'];
            $newBody = $this->request->data['newBody'];

            $tags = preg_split("/[\s,]+/", trim($this->request->data['newTags']));
            $tags = array_unique($tags);
            foreach($tags as &$tag) {
                $tag = strtolower($tag);
            }

            $updates = array('title' => $newTitle, 'body' => $newBody, 'tags' => $tags);
            $success = Questions::update($updates, array('_id' => $id));

            if($success) {
                $this->redirect("/users/myQuestions?update=success");
            } else {
                $error = "Attempt to update failed, please try again";

                return compact('error', 'question');
            }
        } else {
            return compact('question');
        }
	}
	
	public function delete() {
		$id = $this->request->params['id'];
		$success = Questions::remove(array('_id' => $id));
		
		return compact('success');
	}
	
	public function homepage() {
		$newest = Questions::findTop();
		$popular = Questions::findPopular();
		$noAns = Questions::findUnAnswered();
        $answers = Answers::topAnswers();
        $tags = Questions::topTags();

		return compact('newest', 'popular', 'noAns', 'answers', 'tags');
	}
}

?>