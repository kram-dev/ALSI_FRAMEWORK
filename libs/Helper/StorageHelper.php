<?php

function storage($type, $value)
{
	$explode_type = explode('.', $type);

	switch($explode_type[0]) {
		case 'session':
			switch ($explode_type[1]) {
				case 'set':
					$session_file = fopen("storage/session/".$value , 'w');
		    		fwrite($session_file, $value);
				break;
				case 'validate':
					foreach (glob("storage/session/*") as $session) {
			            if (file_exists($session)){
			            	$content = file_get_contents($session);
				            if ($content == $value) {
				              	return true;
				            }
			            }
			        }
				break;
			}
		default:
			return false;
		break;
	}
}