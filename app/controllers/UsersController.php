<?php

namespace app\controllers;

use app\models\Users;
use app\models\Answers;
use app\models\Questions;

use lithium\security\Auth;
use lithium\security\Password;
use lithium\util\String;

class UsersController extends \lithium\action\Controller {
	
	public function login() {
		if (Auth::check('user', $this->request)) {
			return $this->redirect('/?login=true');
		}

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$username = $this->request->data['username'];
			$badPass = false;
			$badUser = false;
			
			$doc = Users::find('all', array(
					'conditions' => array('username' => $username),
                    'limit' => 1
            ));

			if ($username == "") {
                $badUser = true;
                $error = true;
			} else if ($doc[0]['username'] != $username) {
				$error = true;
				$badUser = true;
			} else {
                $badPass = true;
                $error = true;
            }

            return compact('error', 'badUser', 'badPass', 'username');
		} else {
            $error = false;
            return compact('error');
        }
	}
	
	public function logout() {
		Auth::clear('user');
		return $this->redirect('/?logout=true');
	}

    public function myQuestions() {
        $user = Auth::check('user', $this->request);

        if(isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
            $search = $_REQUEST['search'];
            $query = array('conditions' =>
                array('title' => array('like' => '/'.$search.'/i'), 'owner' => $user['username'])
            );
            $questions = Questions::find('all', $query)->to('array');
            $searched = true;
        } else {
            $questions = Users::getQuestionsByUserName($user['username']);
        }

        return compact('questions', 'user', 'searched', 'search');
    }

    public function aboutMe() {
        $user = Auth::check('user', $this->request);

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newBio = $this->request->data['biography'];
            $newBio = trim($newBio);
            $update = array('biography' => $newBio);
            $who = array('username' => $user['username']);
            $success = Users::update($update, $who);

            $query = array('username' => $user['username']);

            $biographyDoc = Users::find('first', array(
                'conditions' => $query,
                'fields' => 'biography'
            ))->to('array');

            $biography = $biographyDoc['biography'];

            return compact('success', 'biography');
        } else {
            $query = array('username' => $user['username']);

            $biographyDoc = Users::find('first', array(
                'conditions' => $query,
                'fields' => 'biography'
            ))->to('array');

            $biography = $biographyDoc['biography'];

            return compact('biography');
        }
    }

    public function myAnswers() {
        $user = Auth::check('user', $this->request);

        if(isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
            $search = $_REQUEST['search'];
            $query = array('conditions' =>
                array('body' => array('like' => '/'.$search.'/i'), 'owner' => $user['username'])
            );
            $answers = Answers::find('all', $query)->to('array');
            $searched = true;
        } else {
            $answers = Answers::getAnswersByOwnerName($user['username']);
        }

        return compact('answers', 'user', 'search', 'searched');
    }

	public function register() {

		if(isset($this->request->data['register'])) {
			$username = $this->request->data['username'];
			$password = $this->request->data['password'];
            $iconUri = "/img/".$this->request->data['icon'].".png";
            $biography = $this->request->data['biography'];

			$repeat = $this->request->data['repeatPassword'];

            $badPass = null;
			$badUser = null;
			
			if(strtolower($password) != strtolower($repeat)) {
				$badPass = "Passwords did not match!";
			}
			
			$badUser = Users::find('all', array(
			    'conditions' => array('username' => $username), 'limit' => 1)
			);
			
			if(isset($badUser[0]['username'])) {
				$badUser = "The name \"".$badUser[0]['username']."\" is already taken!";
				return compact('badUser', 'username');
			}
			
			if(!isset($badPass)) {
				$newUser = Users::create(array("username" => $username, "password" => $password,
                    "iconUri" => $iconUri, 'biography' => $biography));
		
				$saved = $newUser->save();
				
				if($saved) {
					return $this->redirect('/?register=true');
				}
			} else {
				return compact('badPass', 'username');
			}
		}
	}
}

?>