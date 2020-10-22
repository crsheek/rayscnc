<?php
class db{
	private $_dbhost = 'localhost';
	private $_dbname = 'rayscnc';
	private $_dbuser = 'textus';
	private $_dbpass = '';
	private $_dbconn = null;

	public function __construct(){	
		$this->_dbconn = new mysqli($this->_dbhost, $this->_dbuser, $this->_dbpass, $this->_dbname);
		if (mysqli_connect_errno()) {
			printf("Database Connection Error: %s\n", mysqli_connect_error());
			exit();
		} else {
//			echo "<br> successful db connection";
		}
	}


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