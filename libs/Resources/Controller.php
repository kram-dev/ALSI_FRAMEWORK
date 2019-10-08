<?php
	
namespace Library\Resources;

use Library\Resources\Middleware as Authentication;
use Library\Resources\View;

Class Controller extends Authentication
{

  /**
    *
    *-------------------------------------------------
    * Creating new object of view and provider
    *-------------------------------------------------
    *
    **/

	public function __construct()
	{
		$this->view = new View;
        $this->providers();
	}

}
