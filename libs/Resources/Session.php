<?php

class Session{

	/**
     * Prefix for sessions.
     *
     * @var string
     */
    private static $prefix = 'alsi_';

    /**
     * Determine if session has started.
     *
     * @var bool
     */
    private static $sessionStarted = false;

    /**
     * Set prefix for sessions.
     *
     * @param mixed $prefix → prefix for sessions
     *
     * @return bool
     */
    public static function setPrefix($prefix)
    {
        return is_string(self::$prefix = $prefix);
    }

    /**
     * Get prefix for sessions.
     *
     * @since 1.1.6
     *
     * @return string
     */
    public static function getPrefix()
    {
        return self::$prefix;
    }

    /**
     * If session has not started, start sessions.
     *
     * @param int $lifeTime → lifetime of session in seconds
     *
     * @return bool
     */
    public static function init($lifeTime = 0)
    {
        if (self::$sessionStarted == false) {
            session_set_cookie_params($lifeTime);
            session_start();

            return self::$sessionStarted = true;
        }

        return false;
    }

    /**
     * Add value to a session.
     *
     * @param string $key   → name the data to save
     * @param mixed  $value → the data to save
     *
     * @return bool true
     */
    public static function set($key, $value = false)
    {
        if (is_array($key) && $value == false) {
            foreach ($key as $name => $value) {
                $iv        = openssl_random_pseudo_bytes(openssl_cipher_iv_length(config('app.encryption_method')));
				$encrypted = bin2hex($iv) . openssl_encrypt($value, config('app.encryption_method'), config('app.encryption_key'), 0, $iv);
				$_SESSION[self::$prefix . $name] = $encrypted;
            }
        } else {
        	$iv        = openssl_random_pseudo_bytes(openssl_cipher_iv_length(config('app.encryption_method')));
			$encrypted = bin2hex($iv) . openssl_encrypt($value, config('app.encryption_method'), config('app.encryption_key'), 0, $iv);
            $_SESSION[self::$prefix . $key] = $encrypted;
        }

        return true;
    }

    /**
     * Extract session item, delete session item and finally return the item.
     *
     * @param string $key → item to extract
     *
     * @return mixed|null → return item or null when key does not exists
     */
    public static function pull($key)
    {
        if (isset($_SESSION[self::$prefix . $key])) {
            $value = $_SESSION[self::$prefix . $key];
            unset($_SESSION[self::$prefix . $key]);

            return $value;
        }

        return null;
    }

    /**
     * Get item from session.
     *
     * @param string      $key       → item to look for in session
     * @param string|bool $secondkey → if used then use as a second key
     *
     * @return mixed|null → key value, or null if key doesn't exists
     */
    public static function get($key = '', $secondkey = false)
    {
        $name = self::$prefix . $key;

        if (isset($_SESSION[$name])) {
            $iv_strlen = 2  * openssl_cipher_iv_length(config('app.encryption_method'));

		    if (preg_match("/^(.{" . $iv_strlen . "})(.+)$/", $_SESSION[$name], $regs)) {
		      
		      list(, $iv, $crypted_string) = $regs;

		      if (ctype_xdigit($iv) && strlen($iv) % 2 == 0) {
		        return openssl_decrypt($crypted_string, config('app.encryption_method'), config('app.encryption_key'), 0, hex2bin($iv));
		      }
		    }
        } elseif ($secondkey == true) {
            if (isset($_SESSION[$name][$secondkey])) {
                $iv_strlen = 2  * openssl_cipher_iv_length(config('app.encryption_method'));

			    if (preg_match("/^(.{" . $iv_strlen . "})(.+)$/", $_SESSION[$name][$secondkey], $regs)) {
			      
			      list(, $iv, $crypted_string) = $regs;

			      if (ctype_xdigit($iv) && strlen($iv) % 2 == 0) {
			        return openssl_decrypt($crypted_string, config('app.encryption_method'), config('app.encryption_key'), 0, hex2bin($iv));
			      }
			    }
            }
        }
        
	    return FALSE; // failed to decrypt
    }

    /**
     * Get session id.
     *
     * @return string → the session id or empty
     */
    public static function id()
    {
    	$generated_id = session_id();
        $session_id   = fopen("storage/session/" . $generated_id. ".ses", 'w');
        fwrite($session_id, $generated_id);
        	return $generated_id;
    }

    /**
     * Regenerate session_id.
     *
     * @return string → session_id
     */
    public static function regenerate()
    {
        session_regenerate_id(true);
        $generated_id = session_id();
        $session_id   = fopen("storage/session/" . $generated_id. ".ses", 'w');
        fwrite($session_id, $generated_id);
        	return $generated_id;
    }

    /**
     * Empties and destroys the session.
     *
     * @param string $key    → session name to destroy
     * @param bool   $prefix → if true clear all sessions for current prefix
     *
     * @return bool
     */
    public static function destroy($key = '', $prefix = false)
    {
        if (self::$sessionStarted == true) {
            if ($key == '' && $prefix == false) {
                session_unset();
                session_destroy();
            } elseif ($prefix == true) {
                foreach ($_SESSION as $index => $value) {
                    if (strpos($index, self::$prefix) === 0) {
                        unset($_SESSION[$index]);
                    }
                }
            } else {
                unset($_SESSION[self::$prefix . $key]);
            }

            return true;
        }

        return false;
    }
}