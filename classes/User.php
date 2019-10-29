<?php
/*
 * Copyright (C) 2019+ MasterkinG32 <https://masterking32.com>
 * Copyright (C) 2017+ AzerothCore <www.azerothcore.org>, released under GNU GPL v2 license: http://github.com/azerothcore/azerothcore-wotlk/LICENSE-GPL2
 * Copyright (C) 2008-2016 TrinityCore <http://www.trinitycore.org/>
 * Copyright (C) 2005-2009 MaNGOS <http://getmangos.com/>
*/

class User {
	private $_db,
			$_data,
			$_sessionName,
			$_isLoggedIn;

	public function __construct($user = null) {
		$this->_db = DB::getInstance();

		$this->_sessionName = Config::get('session/session_name');

		if(!$user) {
			if(Session::exists($this->_sessionName)) {
				$user = Session::get($this->_sessionName);

				if($this->find($user)) {
					$this->_isLoggedIn = true;
				} else {
					//Logout
					//$this->logout() ;
				}
			}
		} else {
			$this->find($user);
		}
	}

	public function create($fields = array()) {
		if(!$this->_db->insert('account', $fields)) {
			throw new Exception('There was a problem creating your account.');
		}
	}

	public function find($user = null) {
		if($user) {
			echo $user;
			//var_dump(is_numeric($user)) ;
			$field = (is_numeric($user)) ? 'account_id' : 'username';
			$data  = $this->_db->get('account', array($field, '=', $user));
            //var_dump($data );
			if($data->count()) {
				$this->_data = $data->first();
				return true;
			}
			else{
			    echo "not find";
			}
		}
	}

	public function login($username = null, $password = null) {
		$user = $this->find($username);
		$hash = strtoupper(sha1(strtoupper(($username)).":".strtoupper(($password))));

		if($user) {
			if(strtoupper($this->data()->pass_hash) == $hash) {
				$_SESSION["account_id"] = $this->data()->account_id;
				Session::put($this->_sessionName, $this->data()->account_id);

				return true;
			}
		}

		return false;
	}

	public function logout() {
		Session::delete($this->_sessionName);
	}

	public function data() {
		return $this->_data;
	}

	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}
}