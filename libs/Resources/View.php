<?php

namespace Library\Resources;

use Jenssegers\Blade\Blade;

class View
{

	private $blade;
	private $errors =[];
  /**
    *
    *-------------------------------------------------
    * Set Blade and Csrf Directive
    *-------------------------------------------------
    *
    **/

	public function __construct()
	{	

		$this->blade = new Blade('views', 'storage/cache');
	}

  /**
    *
    *-------------------------------------------------
    * Render Blade
    *-------------------------------------------------
    *
    * @param string $name - Blade name
    * @param array $data  - Data that will be pass in
    *                       blade
    *
    **/

	public function render($name, array $data = [])
	{	
		$this->blade->directive('auth', function () {
          return "<?php if (Auth::test() == 'test'): ?>";
	      });

		$this->blade->directive('endauth', function (){
		      return '<?php endif; ?>';
		});

		echo $this->blade->make($name, $data);
	}
	
}
