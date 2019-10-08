<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Request;

/**
 * @return \Pecee\Http\Request
 */
function request(): Request
{
    return Router::request();
}