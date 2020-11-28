<?php
class db{
// live	
	private $_dbhost = 'https://a2plcpnl0334.prod.iad2.secureserver.net';
	private $_dbname = 'cncadmin';
	private $_dbuser = 'cncmaster';
	private $_dbpass = '6fYY3zJrnqHkaML';
	private $_dbconn = null;

	//cindys local -- not working
	private $_dbhost_dev = 'localhost';	
	private $_dbname_dev = 'cncadmin';
	private $_dbuser_dev = 'cncmaster';
	private $_dbpass_dev = 'textu$adm!n';

	public $roles = null;


	public function __construct($host=''){
		if ($host==='dev'):
			$this->_dbconn = new mysqli($this->_dbhost, $this->_dbuser_dev, $this->_dbpass_dev, $this->_dbname_dev);
		else:
			$this->_dbconn = new mysqli($this->_dbhost_dev, $this->_dbuser, $this->_dbpass, $this->_dbname);
		endif;	
		if (mysqli_connect_errno()) {
			printf("Database Connection Error: %s\n", mysqli_connect_error());
			exit();
		} else {
			$this->roles = $this->getRoles();
		}
	}



	/**
	 * get all roles
	 */
	public function getRoles(){
		return $this->doQuery("SELECT * FROM roles");
	}

	/**
	 * check username and password sent from login page
	 */
	public function doLogin($post){

		$username =  $this->realscape($post['username']);
		$password =  $this->realscape($post['password']);
		
		$sql = "SELECT userid, password FROM users WHERE username='".$username."'";
		$result = $this->doFetch($sql);
		if ($result['userid'] > 0):
			if (password_verify($password, $result['password'])):
				return true;
			else:
				return false;
			//if has password and password_verify($password, $result['password']) -- success
			//note: on register or create, use password_hash ($selected_pw, config['pwhash']) to store a pw
			endif;
		endif;
		return false;
	}

// supporting functions for db queries

	public function dbClose(){
		mysqli_close($this->_dbconn);
	}
	public function doFetch($sql){
		return $this->sqldata($sql);
	}

	public function doQuery($sql){
		return $this->sqlquery($sql);
	}

	public function dbError(){
		return mysqli_error($this->_dbconn);
	}
	
	//supporting database methods
	private function sqlquery($sqlstr){
		return mysqli_query($this->_dbconn,$sqlstr);
	}

    private function sqldata($sqlstr){
        $sqlquery = $this->sqlquery($sqlstr);
        return $sqlquery->fetch_object();
    }
	private function numrows($sqlstr){
		$sqlquery = $this->sqlquery($sqlstr);
        return $sqlquery->num_rows;
	}
    private function realscape($string){
        return $this->_dbconn->real_escape_string($string);
    }


	private function encryptCC($cardNumber){
		$key='P$alm23TheLORdiSMy$h3phrdISh@lLnotWaNT';
		$plaintext = $cardNumber;
		$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
		$iv = openssl_random_pseudo_bytes($ivlen);
		$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
		$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
		$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
		return $ciphertext;
	}

	private function decryptCC($ciphertext){
		//decrypt later....
		$key='P$alm23TheLORdiSMy$h3phrdISh@lLnotWaNT';
		$c = base64_decode($ciphertext);
		$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
		$iv = substr($c, 0, $ivlen);
		$hmac = substr($c, $ivlen, $sha2len=32);
		$ciphertext_raw = substr($c, $ivlen+$sha2len);
		$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
		$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
		if (hash_equals($hmac, $calcmac)
		)//PHP 5.6+ timing attack safe comparison
		{
		    return $original_plaintext;
		}
	}
}