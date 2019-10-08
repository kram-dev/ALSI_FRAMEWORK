<?php

use Illuminate\Support\Facades\DB;
use Library\Resources\Controller;
use App\Model\Register;

Class RegisterController Extends Controller
{

  /**
    *
    * @return parent class construct
    *
    * Note: Do not remove/delete this code else will
    *       return an error
    *
    **/

	public function __construct()
	{

		parent::__construct();
	}

	public function index()
	{
		$this->auth->isLogged();
		$this->view->render('register');
	}

	public function do_register()
	{  
		$this->form->validate([
            'fname'     => 'require', 
            'email'     => 'require|validate_email', 
            'password'  => 'require|min:6|secure',
            'rpassword' => 'require|confirm:password'
		]);

        if ($this->form->check() == true) {
            if (Register::where('email', $this->input->post('email'))->exists()) {    
                $_SESSION['toastr_error'] = 'Email Address is already exists!';
                redirect('register');
            } else {
                Register::Create([
                    'name'     => $this->input->post('fname'), 
                    'email'    => $this->input->post('email'), 
                    'password' => $this->hash->make($this->input->post('password'), 'bcrypt')
                ]);
                    $_SESSION['toastr_success'] = 'Successful Register!';
                    redirect('login');
            }
        } else {
            redirect('register');
        }
        
	}

}