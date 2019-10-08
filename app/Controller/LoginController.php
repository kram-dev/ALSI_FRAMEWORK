<?php

use Illuminate\Support\Facades\DB;
use Library\Resources\Controller;
use App\Model\User;

Class LoginController Extends Controller
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
		$this->middleware('auth');
		$this->view->render('login');
	}

	public function do_login()
	{	

		$this->form->validate([
            'email'     => 'require', 
            'password'  => 'require',
		]);
			
		if ($this->form->run() == true) {
			if (User::where('email', input()->post('email'))->exists()) {    
            	$user = User::where('email', input()->post('email'))->first();
            		if ($this->hash->check(input()->post('password'), $user->password)) {
            			$_SESSION['toastr_success'] = 'Logging in...';
            			Auth::setToken($user->id);
            			redirect(url('login'));
            		} else {
            			$_SESSION['toastr_error'] = 'Invalid Username or Password';
            			redirect(url('login'));
            		}
			} else {
				$_SESSION['toastr_error'] = 'Invalid Username or Password';
				redirect('asd');
			}
		} else {
			redirect('asd');
		}
	}

}