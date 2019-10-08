<?php

use Library\Resources\Controller;
use Pecee\Http\Request;
use App\Model\User;

Class HomeController extends Controller
{	

	public function index()
	{
		$asd = User::paginate(6);

		$this->view->render('pages.landing');
	}

	public function test()
	{	
		echo 'asdasdsad';
	}

}