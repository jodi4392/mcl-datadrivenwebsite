<?php
class User
{
	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;
	public function __construct($user = null)
	{
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');
		if(Session::exists($this->_sessionName))
		{
			//sets current user
			$user = Session::get($this->_sessionName);
			if($this->find($user))
			{
				$this->_isLoggedIn = true;
			}
			else
			{
				//process logout
				$this->logout();
			}
		}
		else
		{
			//for a user that is defined
			// This grabs users that are not logged in
			$this->find($user);
		}
	}
	public function update($fields = array(), $id = null)
	{
		if(!$id && $this->isLoggedIn())
		{
			$id = $this->data()->id;
		}
		if(!$this->_db->update('users', $id, $fields))
		{
			throw new Exception('Update has a big problem');
		}
	}
	public function create($fields = array())
	{
		if(!$this->_db->insert('users', $fields))
		{
			throw new Exception('There was a problem creating an account.');
		}
	}
	public function createpost($fields = array())
	{
		if(!$this->_db->insertpost('users_post', $fields))
		{
			throw new Exception('There was a problem creating a post.');
		}
	}
	public function displaypost($fields = array())
	{
		if(!$this->_db->get('users_post'))
		{
			throw new Exception('There was a problem displaying posts.');
		}
	}
	public function find($user = null)
	{
		if($user)
		{
			// usernames can't be only numbers
			$field = (is_numeric($user)) ? 'id' : 'username';
			$data = $this->_db->get('users', array($field, '=', $user));
			if($data->count())
			{
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}
	public function login($username = null, $password = null, $remember = false)
	{
		//echo $this->_sessionName, $this->data()->id;
		//$user = $this->find($username);
		//print_r($this->_data);
		// Check to see if user exists or not
		// we need something for a user that is already logged in
		// first check if anything gets passed and there is a remember
		if(!$username && !$password && $this->exists())
		{
			//log user in with remembered data id
			Session::put($this->_sessionName, $this->data()->id);
		}
		else
		{
			$user = $this->find($username);
			if($user)
			{
				if($this->data()->password === Hash::make($password, $this->data()->salt))
				{
					//echo 'password ok';
					//set a session for user
					// places the user id inside the session
					Session::put($this->_sessionName, $this->data()->id);
					// for the remember, will generate a hash to be checked
					if($remember)
					{
						$hash = Hash::unique();
						// checks if there is already a hash stored in the DB
						$hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));
						//if there is no hash, insert a record
						if(!$hashCheck->count())
						{
							$this->_db->insert('users_session', array(
								'user_id' => $this->data()->id,
								'hash' => $hash
							));
						}
						else
						{
							$hash = $hashCheck->first()->hash;
						}
						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
					}
					return true;
				}
			}
		}
		return false;
	}
	public function hasPermission($key)
	{
		$group = $this->_db->get('groups', array('id', '=', $this->data()->group));
		//print_r($group->first());
		if($group->count())
		{
			//echo $permissions = $group->first()->permissions;
			// json decoder function in php to an array for php to read
			$permissions = json_decode($group->first()->permissions, true);
			//print_r ($permissions);
			if($permissions[$key] == true)
			{
				return true;
			}
		}
		return false;
	}
	public function exists()
	{
		return (!empty($this->_data)) ? true : false;
	}
	public function logout()
	{
		$this->_db->delete('users_session', array('user_id', '=', $this->data()->id));
		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}
	public function data()
	{
		return $this->_data;
	}
	public function isLoggedIn()
	{
		return $this->_isLoggedIn;
	}
}
?>