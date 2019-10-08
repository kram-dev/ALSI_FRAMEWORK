<?php

namespace Library\Provider;

class EncryptionProvider
{

  /**
	*
	*-------------------------------------------------
	* Encrypt Data Using Openssl
	*-------------------------------------------------
	*
	* @param string $data - Data to encrypt
	*
	**/  

    public function set($data)
    {
		$iv        = openssl_random_pseudo_bytes(openssl_cipher_iv_length(app['encryption_method']));
		$encrypted = bin2hex($iv) . openssl_encrypt($data, app['encryption_method'], app['encryption_key'], 0, $iv);
	    	return $encrypted;
    }

  /**
	*
	*-------------------------------------------------
	* Decrypt Data Using Openssl
	*-------------------------------------------------
	*
	* @param string $data - Data to decrypt
	*
	**/ 

    public function get($data)
    {	
	    $iv_strlen = 2  * openssl_cipher_iv_length(app['encryption_method']);

	    if (preg_match("/^(.{" . $iv_strlen . "})(.+)$/", $data, $regs)) {
	      
	      list(, $iv, $crypted_string) = $regs;

	      if (ctype_xdigit($iv) && strlen($iv) % 2 == 0) {
	        return openssl_decrypt($crypted_string, app['encryption_method'], app['encryption_key'], 0, hex2bin($iv));
	      }
	    }
	    return FALSE; // failed to decrypt
    }

}