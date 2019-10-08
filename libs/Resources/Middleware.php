<?php

namespace Library\Resources;

class Middleware
{

	public function middleware($name): void
	{
		foreach(config('app.middleware') as $key => $value) {
			if ($key == $name) {
				$middleware = new $value;
				$middleware->handle(function($redirect){
					redirect($redirect);
				});
			}
		}
	}

	public function providers(): void
	{
		foreach (config('app.provider') as $provider_key => $provider_value) {
            $explode_class = explode('\\', $provider_value);
            if (strpos($explode_class[2], 'Provider') !== false) {
                if (file_exists('libs/Provider/' . $explode_class[2] . '.php')) {
                    require_once 'libs/Provider/' . $explode_class[2] . '.php';
                }
                    $this->{$provider_key} = new $provider_value;
            }   
        }
	}
}