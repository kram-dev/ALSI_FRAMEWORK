<?php

function view($name, $data = [])
{
	$blade = new Jenssegers\Blade\Blade('views', 'storage/cache');

	$blade->directive('auth', function () {
          return "<?php if (Auth::test() == 'test'): ?>";
      });

	$blade->directive('endauth', function (){
	      return '<?php endif; ?>';
	});

	echo $blade->make($name, $data);
}