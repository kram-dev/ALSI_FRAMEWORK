<?php
	
use Illuminate\Support\Facades\DB;
use Library\Resources\Controller;

Class SampleController Extends Controller
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
        $this->view->render('sample');
	}

    public function send_mail()
    {
        $this->form->validate([
            'email'    => 'require|validate_email', 
            'name'     => 'require',
            'subject'  => 'require',
            'message'  => 'require',
            'userfile' => 'size:10|require|type:csv'
        ]);

        /*echo $_FILES['userfile']['type'] . ' <br> ';
        echo $_FILES['userfile']['size'];
        
        echo Form::Error('userfile');
        
        die;*/
        $this->mailer->body($this->input->post('message'))
                     ->subject($this->input->post('subject'))
                     ->from([ $this->input->post('email') => $this->input->post('name') ])
                     ->attachment('userfile')
                     ->send();
    }

}