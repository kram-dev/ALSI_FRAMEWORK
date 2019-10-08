<?php

return 

  /**
    *
    *-------------------------------------------------
    * Database Configuration
    *-------------------------------------------------
    *
    **/
  
	[  	
		
		'driver'    => _env('DB_CONNECTION', 'mysql'),
		'host'      => _env('DB_HOST', 'alsi.test'),
		'user'      => _env('DB_USERNAME', 'root'),
		'pass'      => _env('DB_PASSWORD', ''),
		'dbname'    => _env('DB_DATABASE', 'alsi'),
		'charset'   => _env('DB_CHARSET', 'utf8'),
		'collation' => _env('DB_COLLATION', 'utf8_unicode_ci'),
		'prefix'    => _env('DB_PREFIX', ''),

	];

