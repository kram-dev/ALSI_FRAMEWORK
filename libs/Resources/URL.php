<?php

  /**
    *
    *-------------------------------------------------
    * Redirect Page
    *-------------------------------------------------
	*
    * @param string $path    - redirect path | default
    *                          by base url
    * @param string $getdata - will return $_GET data
    *                          with base64_encode
    *
    **/
/*
	function redirect($path = '', $getdata = '')
	{
		$explode_path     = explode('/', $path);
		$explode_get      = explode('&', $getdata);
		$get              = [];

		if (app['encrypt_get_data'] == true) {	
			for ($x = 0; $x<count($explode_get) ; $x++) {
				$iv    = openssl_random_pseudo_bytes(openssl_cipher_iv_length(app['encryption_method']));
				$get[] = bin2hex($iv) . openssl_encrypt(filter_var($explode_get[$x], FILTER_SANITIZE_STRING), app['encryption_method'], app['encryption_key'], 0, $iv);
			}
		} else {
			for ($x = 0; $x<count($explode_get) ; $x++) {
				$get[] = str_replace([' '], ['-'], str_replace(['-'], [' '], filter_var($explode_get[$x], FILTER_SANITIZE_STRING)));
			}	
		}

			if (empty($getdata)) {
			    header('Location:' . app['url'] . $path);
			    die;
			} else {
				header('Location:' . app['url'] . $path . '?=' . implode('&', $get));
				die;
			}
	}
*/
  /**
    *
    *-------------------------------------------------
    * Url Path
    *-------------------------------------------------
	*
    * @param string $url     - url path | default
    *                          by base url
    * @param string $getdata - will return $_GET data
    *                          with base64_encode
    *
    **/

/*	function route($path = '', $getdata = '')
	{
		$explode_path       = explode('/', $path);
		$explode_get        = explode('&', $getdata);
		$get                = [];

		if (app['encrypt_get_data'] == true) {
			for ($x = 0; $x<count($explode_get) ; $x++) {
				$iv    = openssl_random_pseudo_bytes(openssl_cipher_iv_length(app['encryption_method']));
				$get[] = bin2hex($iv) . openssl_encrypt(filter_var($explode_get[$x], FILTER_SANITIZE_STRING), app['encryption_method'], app['encryption_key'], 0, $iv);
			}
		} else {
			for ($x = 0; $x<count($explode_get) ; $x++) {
				$get[] = str_replace([' '], ['-'], filter_var($explode_get[$x], FILTER_SANITIZE_STRING));
			}
		}
			if (empty($getdata)) {
			    echo app['url'] . $path;
			} else {
				echo app['url'] . $path . '?=' . implode('&', $get);
			}
	}

*/
