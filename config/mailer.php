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
		
		'smtp'        => _env('MAIL_SMTP', true),
		'smtp_auth'   => _env('MAIL_AUTH', true),
		'smtp_secure' => _env('MAIL_SECURE', 'tls'),
		'port'        => _env('MAIL_PORT'),
		'host'        => _env('MAIL_HOST', 'smtp'),
		'email'       => _env('MAIL_USERNAME'),
		'password'    => _env('MAIL_PASSWORD'),

	];