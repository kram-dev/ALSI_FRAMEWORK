<?php

namespace Library\Provider;

use Pecee\SimpleRouter\SimpleRouter as Route;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Handlers\IExceptionHandler;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

Class FormValidationProvider
{

	/**
    *
	* @var string
    *
    **/

	private static $auth_error;

	/**
    *
	* @var array
    *
    **/

	private static $set_rules_message = [];



  /**
    *
    *-------------------------------------------------
    * Validate Form
    *-------------------------------------------------
    *
    * @param array $posts  - post data that you want to
    *                        validate
    *
    * @param array $custom - Custom error message
    **/

	public static function validate(array $posts, array $custom = [])
	{
		$set      = isset($_GET['url']) ? $_GET['url'] : NULL;
		$trim     = rtrim($set, '/');
		$sanitize = filter_var($trim, FILTER_SANITIZE_URL);
		$url      = explode('/', $sanitize);
		$_method  = (isset($_POST['_method'])) ? count($_POST['_method']) : 0;
				if ((count($posts) + 1 + $_method)== count($_POST) + count($_FILES)) {
						if (array_keys($posts) !== range(0, count($posts) - 1)) {
							foreach ($posts as $post_key => $post_value) {
								if (isset($_POST[$post_key])) {
									 $explode_value = explode('|', $post_value);
									  foreach($explode_value as $value) {
									  	 if (strpos($value, ':') !== false) {
									  	 	$rules_value = explode(':', $value);
									  	 	 	switch ($rules_value[0]) {
									  	 	 		case 'confirm':
									  	 	 			$check_empty = explode('|', $post_value);
									  	 				if ($check_empty[0] == 'require' && empty($_POST[$post_key])) {
									  	 	 		    	self::$auth_error .= 'true ';
										  	 	 		    if (isset(self::$set_rules_message['require'])) {
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['require'];
										  	 	 			} else if (isset(self::$set_rules_message[$post_key]['require'])){
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['require'];
										  	 	 			} else {
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; This field is required.';
										  	 	 			}
									  	 	 		    }  else {
										  	 	 			if ($_POST[$post_key] == $_POST[$rules_value[1]]) {
										  	 	 				self::$auth_error .= 'false ';
										  	 	 			} else {
										  	 	 				self::$auth_error .= 'true ';
										  	 	 				if (isset(self::$set_rules_message['confirm'])) {
										  	 	 					$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['confirm'];
										  	 	 				} else if (isset(self::$set_rules_message[$post_key]['confirm'])){
										  	 	 					$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['confirm'];
										  	 	 				}
										  	 	 					$_SESSION[$post_key .'_message'] = '&#9888; Password confirm does not match.';
										  	 	 			}
									  	 	 			}
									  	 	 		break;
									  	 	 		case 'min':
									  	 	 		    $check_empty = explode('|', $post_value);
									  	 				if ($check_empty[0] == 'require' && empty($_POST[$post_key])) {
									  	 	 		    	self::$auth_error .= 'true ';
										  	 	 		    if (isset(self::$set_rules_message['require'])) {
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['require'];
										  	 	 			} else if (isset(self::$set_rules_message[$post_key]['require'])){
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['require'];
										  	 	 			} else {
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; This field is required.';
										  	 	 			}
									  	 	 		    } else {
										  	 	 			if (strlen($_POST[$post_key]) < $rules_value[1]) {
										  	 	 				self::$auth_error .= 'true ';
										  	 	 				if (isset(self::$set_rules_message['min'])) {
										  	 	 					$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['min'];
												  	 	 		} else if (isset(self::$set_rules_message[$post_key]['min'])){
												  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['min'];
												  	 	 		} else {
												  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; This field is too short, minimum is ' . $rules_value[1] . ' characters.';
												  	 	 		}
										  	 	 		    } else {
										  	 	 		    	self::$auth_error .= 'false ';
										  	 	 		    }
									  	 	 		    }
									  	 	 		break;
									  	 	 		case 'max':
									  	 	 			$check_empty = explode('|', $post_value);
									  	 				if ($check_empty[0] == 'require' && empty($_POST[$post_key])) {
									  	 	 		    	self::$auth_error .= 'true ';
										  	 	 		    if (isset(self::$set_rules_message['require'])) {
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['require'];
										  	 	 			} else if (isset(self::$set_rules_message[$post_key]['require'])){
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['require'];
										  	 	 			} else {
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; This field is required.';
										  	 	 			}
									  	 	 		    } else {
										  	 	 			if (strlen($_POST[$post_key]) > $rules_value[1]) {
										  	 	 				self::$auth_error .= 'true ';
										  	 	 				if (isset(self::$set_rules_message['max'])) {
										  	 	 					$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['max'];
												  	 	 		} else if (isset(self::$set_rules_message[$post_key]['max'])){
												  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['max'];
												  	 	 		} else {
												  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; This field is too short, maximum is ' . $rules_value[1] . ' characters.';
												  	 	 		}
										  	 	 		    } else {
										  	 	 		    	self::$auth_error .= 'false ';
										  	 	 		    }
									  	 	 		    }
									  	 	 		break;
									  	 	 		default:
									  	 	 		break;
									  	 	 	}
									  	 } else {
									  	 	switch ($value) {
									  	 		case 'trim' :
									  	 			trim($_POST[$post_key]);
									  	 		break;
									  	 		case 'require' :
									  	 			if (!empty($_POST[$post_key])) {
									  	 				self::$auth_error .= 'false ';
									  	 				$_SESSION[$post_key .'_value'] = $_POST[$post_key];
									  	 			} else {
									  	 				self::$auth_error .= 'true ';
									  	 				if (isset(self::$set_rules_message['require'])) {
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['require'];
										  	 	 		} else if (isset(self::$set_rules_message[$post_key]['require'])){
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['require'];
										  	 	 		} else {
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; This field is required.';
										  	 	 		}
									  	 			}
									  	 		break;
									  	 		case 'string' :
									  	 			$check_empty = explode('|', $post_value);
									  	 			if ($check_empty[0] == 'require' && empty($_POST[$post_key])) {
									  	 	 		    self::$auth_error .= 'true ';
										  	 	 		if (isset(self::$set_rules_message['require'])) {
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['require'];
										  	 	 		} else if (isset(self::$set_rules_message[$post_key]['require'])){
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['require'];
										  	 	 		} else {
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; This field is required.';
										  	 	 		}
									  	 	 		} else {
									  	 	 			if (filter_var($_POST[$post_key], FILTER_SANITIZE_STRING)) {
										  	 				self::$auth_error .= 'false ';
										  	 			} else {
										  	 				self::$auth_error .= 'true ';
										  	 				if (isset(self::$set_rules_message['string'])) {
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['string'];
											  	 	 		} else if (isset(self::$set_rules_message[$post_key]['string'])){
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['string'];
											  	 	 		} else {
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; This field must have letters and numbers only.';
											  	 	 		}
										  	 			}
									  	 	 		}
									  	 		break;
									  	 		case 'integer' :
									  	 			$check_empty = explode('|', $post_value);
									  	 			if ($check_empty[0] == 'require' && empty($_POST[$post_key])) {
									  	 	 		    self::$auth_error .= 'true ';
										  	 	 		if (isset(self::$set_rules_message['require'])) {
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['require'];
										  	 	 		} else if (isset(self::$set_rules_message[$post_key]['require'])){
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['require'];
										  	 	 		} else {
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; This field is required.';
										  	 	 		}
									  	 	 		} else {
										  	 			if (filter_var($_POST[$post_key], FILTER_SANITIZE_NUMBER_INT)) {
										  	 				self::$auth_error .= 'false ';
										  	 			} else {
										  	 				self::$auth_error .= 'true ';
										  	 				if (isset(self::$set_rules_message['integer'])) {
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['integer'];
											  	 	 		} else if (isset(self::$set_rules_message[$post_key]['integer'])){
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['integer'];
											  	 	 		} else {
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; This field must have numbers only.';
											  	 	 		}
										  	 			}
									  	 			}
									  	 		break;
									  	 		case 'validate_email' :
									  	 			$check_empty = explode('|', $post_value);
									  	 			if ($check_empty[0] == 'require' && empty($_POST[$post_key])) {
									  	 	 		    self::$auth_error .= 'true ';
										  	 	 		if (isset(self::$set_rules_message['require'])) {
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['require'];
										  	 	 		} else if (isset(self::$set_rules_message[$post_key]['require'])){
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['require'];
										  	 	 		} else {
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; This field is required.';
										  	 	 		}
									  	 	 		} else {
									  	 	 			if (filter_var($_POST[$post_key], FILTER_VALIDATE_EMAIL)) {
										  	 				self::$auth_error .= 'false ';
										  	 			} else {
										  	 				self::$auth_error .= 'true ';
										  	 	 		    if (isset(self::$set_rules_message['validate_email'])) {
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['validate_email'];
											  	 	 		} else if (isset(self::$set_rules_message[$post_key]['validate_email'])){
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['validate_email'];
											  	 	 		} else {
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; Invalid email address.';
											  	 	 		}
										  	 			}
									  	 	 		}
									  	 	 	break;
									  	 	 	case 'secure' :
									  	 			$check_empty = explode('|', $post_value);
									  	 			if ($check_empty[0] == 'require' && empty($_POST[$post_key])) {
									  	 	 		    self::$auth_error .= 'true ';
										  	 	 		if (isset(self::$set_rules_message['require'])) {
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['require'];
										  	 	 		} else if (isset(self::$set_rules_message[$post_key]['require'])){
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['require'];
										  	 	 		} else {
										  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; This field is required.';
										  	 	 		}
									  	 	 		} else {
									  	 	 			if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST[$post_key]) && preg_match('/[A-Za-z]/', $_POST[$post_key]) && preg_match('/[0-9]/', $_POST[$post_key])) {
										  	 				self::$auth_error .= 'false ';
										  	 			} else if (strlen($_POST[$post_key]) < $rules_value[1]) {
										  	 				self::$auth_error .= 'true ';
										  	 				$_SESSION[$post_key .'_message'] = '&#9888; This field is too short, minimum is ' . $rules_value[1] . ' characters.';
										  	 			} else {
										  	 				self::$auth_error .= 'true ';
										  	 				if (isset(self::$set_rules_message['secure'])) {
										  	 	 				$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['secure'];
											  	 	 		} else if (isset(self::$set_rules_message[$post_key]['secure'])){
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['secure'];
											  	 	 		} else {
											  	 	 			$_SESSION[$post_key .'_message'] = "&#9888; This field must have Special Characters, Numbers and Letters.";
											  	 	 		}
										  	 			}
									  	 	 		}
									  	 	 	break;
									  	 		default:
									  	 		break;
									  	 	}
									  	 }
									  }
								} else {
									if (isset($_FILES[$post_key])) {
										$explode_value = explode('|', $post_value);
									  	foreach($explode_value as $value) {
									  		if (strpos($value, ':') !== false) {
										  	 	$rules_value = explode(':', $value);
										  		switch ($rules_value[0]) {
										  			case 'size':
										  				$size = !empty($rules_value[1]) ? $rules_value[1] : 0;
										  				if ($_FILES[$post_key]['size'] > ($size * 1024)) {
										  					self::$auth_error .= 'true ';
										  	 				if (isset(self::$set_rules_message['size'])) {
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['size'];
											  	 	 		} else if (isset(self::$set_rules_message[$post_key]['size'])){
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['size'];
											  	 	 		} else {
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; File is too big.';
											  	 	 		}
										  				} else {
										  					self::$auth_error .= 'false ';
										  				}
										  			break;
										  			case 'type':
										  					$explode_type = explode(',', $rules_value[1]);
										  					if ($rules_value[1] == '*') {
										  						self::$auth_error .= 'false ';
										  					} else {
										  						foreach ($explode_type as $type) {
										  							switch ($type) {
											  							case 'txt':
											  								if ($_FILES[$post_key]['type'] == 'text/plain') {
											  									self::$auth_error .= 'false ';
											  								} else {
											  									
											  								}
											  							break;
											  							case 'html':
											  							echo 'text/html';
											  							break;
											  							case 'png':
											  							echo 'image/png';
											  							break;
											  							case 'jpg':
											  							echo 'image/jpeg';
											  							break;
											  							case 'tga':
											  							echo 'image/targa';
											  							break;
											  							case 'ppt':
											  							 echo 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
											  							break;
											  							case 'csv':
											  							echo 'application/vnd.ms-excel';
											  							break;
											  							case 'xls':
											  							echo 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
											  							break;
											  							case 'doc':
											  							echo'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
											  							break;
											  							case 'pdf':
											  							echo 'application/pdf';
											  							break;
											  							case 'psd':
											  							echo 'application/octet-stream';
											  							break;
											  							default:
											  							break;
											  						} 
										  						}
										  					}
										  			break;
										  			default:
										  			break;
										  		}
									  		} else {
									  			switch ($value) {
										  	 		case 'require' :
										  	 			if (!empty($_FILES[$post_key]['name'])) {
										  	 				self::$auth_error .= 'false ';
										  	 			} else {
										  	 				self::$auth_error .= 'true ';
										  	 				if (isset(self::$set_rules_message['require'])) {
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message['require'];
											  	 	 		} else if (isset(self::$set_rules_message[$post_key]['require'])){
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; ' . self::$set_rules_message[$post_key]['require'];
											  	 	 		} else {
											  	 	 			$_SESSION[$post_key .'_message'] = '&#9888; This field is required.';
											  	 	 		}
										  	 			}
													break;
													default:
													break;									  	 			
									  	 		}
									  		}
									    }
									} else {
										request()->setRewriteCallback('\App\Handler\ErrorExceptionHandler@pagenotfound');
									}						
								}
							}
						} else {
							request()->setRewriteCallback('\App\Handler\ErrorExceptionHandler@pagenotfound');
						}
					} else {
						request()->setRewriteCallback('\App\Handler\ErrorExceptionHandler@pagenotfound');
					}
	}

	/**
    *
    *-------------------------------------------------
    * Set for Custom Rules Message
    *-------------------------------------------------
    *
    **/

	public function set_rules_message(array $custom_rules_messsage)
	{
		self::$set_rules_message = $custom_rules_messsage;
	}

	/**
    *
    *-------------------------------------------------
    * Check Form Validation
    *-------------------------------------------------
    *
    **/

	public function run()
	{
		$has_error = explode(' ', self::$auth_error);

			if (in_array("true", array_values($has_error))) {
			    return false;
			} else {
				return true;
			}
	}

}