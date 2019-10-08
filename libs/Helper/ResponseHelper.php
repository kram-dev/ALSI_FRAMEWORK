<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Response;

/**
 * @return \Pecee\Http\Response
 */
function response(): Response
{
    return Router::response();
}