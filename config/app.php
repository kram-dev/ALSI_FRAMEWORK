<?php

return  [

  /**
    *
    *-------------------------------------------------
    * Application Name
    *-------------------------------------------------
    *
    **/

	'name' => _env('APP_NAME', 'ALSI MVC FRAMEWORK'),

  /**
    *
    *-------------------------------------------------
    * Application Base Url
    *-------------------------------------------------
    *
    **/

	'url'  => _env('APP_URL'),

  /**
    *
    *-------------------------------------------------
    * Application Timezone
    *-------------------------------------------------
    *
	**/

	'timezone'  => _env('APP_TZ', 'Asia/Manila'),

  /**
    *
    *-------------------------------------------------
    * Application Encryption Key
    *-------------------------------------------------
    *
    **/

    'encryption_key'  => _env('ENCRYPT_KEY', 'YOUR_KEY'),

  /**
    *
    *-------------------------------------------------
    * Application Encryption Method
    *-------------------------------------------------
    *
    **/

    'encryption_method'  => _env('ENCRYPT_METHOD', 'aes-128-ctr'),


    /**
    *
    *-------------------------------------------------
    * Application Handler
    *-------------------------------------------------
    *
    **/

    'handler' => [
        
        'event' => [

            //'database' => App\Handler\Handler\DatabaseEventHandler::class
        
        ],

        'boot'  => [

            //'router' => App\Handler\Boot\RouterBootHandler::class
        
        ] 
    ],


  /**
    *
    *-------------------------------------------------
    * Application Middleware
    *-------------------------------------------------
    *
    **/

    'middleware' => [
        
        'auth' => App\Middleware\AuthenticationMiddleware::class,
    ],

  /**
    *
    *-------------------------------------------------
    * Application Providers
    *-------------------------------------------------
    *
    **/

    'provider' => [
        
        'auth'      => Library\Provider\AuthenticationProvider::class,
        'form'      => Library\Provider\FormValidationProvider::class,
        'hash'      => Library\Provider\PasswordHashingProvider::class,
        'encrypt'   => Library\Provider\EncryptionProvider::class,
        'mailer'    => Library\Provider\SendMailProvider::class,

    ],

  /**
	*
    *-------------------------------------------------
    * Application Autoload
    *-------------------------------------------------
    *
    **/

	#Do not include base url

	'autoload' => [


	]

];

