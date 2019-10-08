<?php
	
  /**
    *
    *-------------------------------------------------
    * Load all the core files and vendor autoload
    *-------------------------------------------------
    *
    **/

  	require_once 'vendor/autoload.php';
	  
	use Pecee\SimpleRouter\SimpleRouter;
	use Pecee\Http\Request;
	use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

  	$dotenv = new Symfony\Component\Dotenv\Dotenv();
	$dotenv->load(__DIR__.'../../.env');

	SimpleRouter::error(function(Request $request, \Exception $exception) {

		if ($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
			echo
			'
				<!doctype html>
				<html lang="en">
					<head>
						<meta charset="utf-8">
						<title>Page Not Found</title>
						<meta name="viewport" content="width=device-width, initial-scale=1">
						<style>
							* { line-height: 1.2; margin: 0; }
							html { color: #888; display: table; font-family: sans-serif; height: 100%; text-align: center; width: 100%; }
							body { display: table-cell; vertical-align: middle; margin: 2em auto; }
							h1 { color: #555; font-size: 2em; font-weight: 400; }
							p { margin: 0 auto; width: 280px; }
							@media only screen and (max-width: 280px)
							{
								body, p { width: 95%; }
								h1 { font-size: 1.5em; margin: 0 0 0.3em 0; }
							}
						</style>
					</head>
					<body>
						<h1>Page Not Found</h1>
						<p>Sorry, but the page you were trying to view does not exist.</p>
					</body>
				</html>
				<!-- IE needs 512+ bytes: http://blogs.msdn.com/b/ieinternals/archive/2010/08/19/http-error-pages-in-internet-explorer.aspx -->
			';
			die;
		}
		
	});

	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();

	foreach (glob("libs/Helper/*.php") as $filename) {
		if (file_exists($filename)) {
			require_once $filename;
		}
	}
	
	date_default_timezone_set(config('app.timezone'));

	require_once 'libs/Resources/Middleware.php';

	require_once 'libs/Database/Connection.php';

	require_once 'Route.php';

	foreach (glob("app/Handler/Boot/*.php") as $filename) {
		if (file_exists($filename)) {
			require_once $filename;
		}
	}

	foreach (glob("app/Handler/Event/*.php") as $filename) {
		if (file_exists($filename)) {
			
		}
	}

	foreach(config('app.handler.boot') as $key => $value){
		if (class_exists($value)) {
			Route::addBootHandler(new $value);
		}
	}

	foreach(config('app.handler.event') as $key => $value){
		if (class_exists($value)) {
			Route::addEventHandler(new $value);
		}
	}

	foreach (glob("storage/cache/*.php") as $filename) {
		if (file_exists($filename)) {
			unlink($filename);
		}
	}

	foreach (glob("app/Middleware/*.php") as $filename) {
		if (file_exists($filename)) {
			require_once $filename;
		}
	}

	foreach (glob("libs/Resources/*.php") as $filename) {
		if($filename != 'app/Resources/Middleware.php') {
			if (file_exists($filename)) {
				require_once $filename;
			}
		}
	}
	Session::init(60);
	foreach (glob("app/Handler/*.php") as $filename) {
		if (file_exists($filename)) {
			require_once $filename;
		}
	}
  	