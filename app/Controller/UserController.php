<?php

use Illuminate\Support\Facades\DB;
use Library\Resources\Controller;
use App\Model\User;

Class UserController Extends Controller
{

  /**
    *@return parent class construct
    *
    * Note: Do not remove/delete this code else will
    *       return an error
    */

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{  
		$this->auth->check();
		$user = User::find(Session::Get('id'));
		$this->view->render('user', compact('user'));
	}

}