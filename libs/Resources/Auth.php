<?php

use Pecee\Http\Url;
use Pecee\Http\Request;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter as Route;
use Jenssegers\Blade\Blade;

class Auth
{

   private static $user;

   public static function setToken($id) : void
   {
       echo Session::id();
   }

   public static function check() 
   {    
        foreach (glob("storage/session/*") as $session) {
            $split = explode('/', $session);
            if ($split[2] == @$_SESSION['_idToken']) {
                return true;
            }
        }
        
   }

   public static function id()
   {
       if (isset($_SESSION['_id'])) {
            return $_SESSION['_id'];
       }
   }

   public static function storeUser($data)
   {
        static::$user = $data;
   }

   public static function getUser()
   {
        return static::$user;
   }

   public static function logout()
   {
        unset($_SESSION);
        session_destroy();
        redirect(url('home'));
   }

   public static function test()
   {
      return 'test';
   }
		
   public static function routes()
   {
        Route::get('ALSI/logout', function(){
                static::logout();
        })->name('logout');
   }

}