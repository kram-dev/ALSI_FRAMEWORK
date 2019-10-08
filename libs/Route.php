<?php

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\SimpleRouter\Route\IGroupRoute;
use Pecee\SimpleRouter\Route\RouteGroup;

class Route extends SimpleRouter
{
	public static function group(array $settings, \Closure $callback): IGroupRoute
    {
        if (\is_callable($callback) === false) {
            throw new InvalidArgumentException('Invalid callback provided. Only functions or methods supported');
        }
		
		foreach ($settings as $key => $value) {
			switch ($key) {
				case 'middleware':
					$group = new RouteGroup();
					$group->setCallback($callback);
					$group->setSettings([$key => config('app.middleware.'.$value)]);
					static::router()->addRoute($group);
					break;
				default:
					$group = new RouteGroup();
					$group->setCallback($callback);
					$group->setSettings($settings);
					static::router()->addRoute($group);
					break;
			}
    	}
        return $group;
    }
}

