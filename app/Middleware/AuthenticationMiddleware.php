<?php

namespace App\Middleware;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;
use App\Model\User;

class AuthenticationMiddleware implements IMiddleware {

    public function handle(Request $request): void 
    {
    
        // Authenticate user, will be available using request()->user
        $request->user = User::find(1);
        // If authentication failed, redirect request to user-login page.
        if($request->user === null) {
            $request->setRewriteUrl(url('user.login'));
        }

    }
}