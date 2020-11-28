<?php
class Users {
	private $db;

	public function __construct($db){
		$this->db = $db;

	}


	/**
	 * add a new user from registration page
	 * @param [type] $data [description]
	 */
	public function addPullUser($data){
		$query = "INSERT INTO `users` 
			(`userid`, 
			`firstname`, 
			`lastname`, 
			`email`, 
			`username`, 
			`password`, 
			`phone`, 
			`role`, 
			`status`, 
			`createdate`, 
			`note`, 
			`ipaddress`, 
			`lastlogin`) 
			VALUES
		    (NULL, 
		    ?s, ?s, ?s, ?s, ?s, ?s,
		    3,'A', 
		    CURRENT_TIMESTAMP,
		    '', 
		    ?s, 
		    NULL );";
		return $this->db->query($query, 
			$data['firstname'], $data['lastname'], $data['email'], $data['username'], $data['password'], $data['phone'], $data['ipaddress']);
	}


	/**
	 * get all users
	 */
	public function getAllUsers(){
		return $this->db->query("SELECT * FROM `users`");
	}

	/**
	 * get user by provided username
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	public function getUserByUserName($username=''){
		$result = [];
		if ($username <> ''):
			$result = $this->db->getAll("SELECT `userid`, `password` FROM `users` WHERE `username` = ?s", $username);
		endif;
		return $result;
	}


	/**
	 * get user by provided userid
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	public function getUserByUserID($userID=0){
		$result = [];
		if ($username <> ''):
			$result = $this->db->getOne("SELECT `userid` FROM `users` WHERE `userid` = ?i", $userID);
		endif;
		return $result;
	}


	/**
	 * check user exists and log them in to the dashboard
	 * @param  [type] $credentials [description]
	 * @return [type]              [description]
	 */
	public function login($credentials){

	}
}
