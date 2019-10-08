<?php

namespace App\Handler\Boot;

use Pecee\Http\Request;
use Pecee\SimpleRouter\IRouterBootManager;
use Pecee\SimpleRouter\Router;

class RouterBootHandler implements IRouterBootManager 
{

    /**
     * Called when router is booting and before the routes is loaded.
     *
     * @param \Pecee\SimpleRouter\Router $router
     * @param \Pecee\Http\Request $request
     */
    public function boot(\Pecee\SimpleRouter\Router $router, \Pecee\Http\Request $request): void
    {

        /**
         * These codes below is just for example only
         * You can do whatever you want to this boot
         * handler and register it to config/app.php
         **/

        $rewriteRules = [
            '/test/' => '/test/article'
        ];

        foreach($rewriteRules as $url => $rule) {

            // If the current url matches the rewrite url, we use our custom route

            if($request->getUrl()->getPath() == $url) {
                $request->setRewriteUrl($rule);
            }
        }

    }

}