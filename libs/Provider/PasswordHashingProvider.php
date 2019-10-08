<?php

namespace Library\Provider;

Class PasswordHashingProvider
{

  /**
    *
    *-------------------------------------------------
    * Hash Password
    *-------------------------------------------------
    *
    * @param string $data  - Data that you want to hash
    * @param string $algo  - algorithm that you want to 
    *                       use
    * @param array $option - Manual salt
    *
    **/

	public function make($data, $algo, array $option = NULL)
	{
		switch ($algo) {
			case 'bcrypt':
			    if($option == NULL):
			       	return password_hash($data, PASSWORD_BCRYPT);
			    else:
			       	return password_hash($data, PASSWORD_BCRYPT, $option);
			    endif;
				break;
			case 'default':
				if($option == NULL):
					return password_hash($data, PASSWORD_DEFAULT);
				else:
					return password_hash($data, PASSWORD_DEFAULT, $option);
				endif;;
				break;
			default:
				return false;
				break;
		}

	}

  /**
    *
    *-------------------------------------------------
    * Password Hash Verify
    *-------------------------------------------------
    *
    * @param string $data     - data that will verify 
    *                           if match to hashdata
    * @param string $hashdata - hashed data
    *
    **/

	public static function check($data, $hashdata)
	{
		return password_verify($data, $hashdata);
	}

}
