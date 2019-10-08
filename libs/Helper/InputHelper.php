<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Request;

/**
 * Get input class
 * @param string|null $index Parameter index name
 * @param string|null $defaultValue Default return value
 * @param array ...$methods Default methods
 * @return \Pecee\Http\Input\InputHandler|array|string|null
 */
function input($index = null, $defaultValue = null, ...$methods)
{
    if ($index !== null) {
        return Router::request()->getInputHandler()->value($index, $defaultValue, ...$methods);
    }

    return Router::request()->getInputHandler();
}