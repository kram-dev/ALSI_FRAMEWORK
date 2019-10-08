<?php
	
use Illuminate\Support\Facades\DB;
use Library\Resources\Controller;

Class LandingController Extends Controller
{

  /**
    * @return parent class construct
    *
    */
  
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->view->render('landing');
	}

	public function mark($g, $w, $q, $qq){
		view('landing');
	}

	public function asd($test){
		echo 'ASD page ' . $test;
		$this->view->render('landing');
	}

	public function test(){
		echo 'TEST page ';
		$this->view->render('landing');
	}

}