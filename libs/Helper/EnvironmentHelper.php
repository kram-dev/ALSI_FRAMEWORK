<?php

function _env($key, $default = null)
{
	if (isset($_ENV[$key]) && $default != null) {
		return $_ENV[$key] = $default;
	}
	return isset($_ENV[$key])? $_ENV[$key]: null;
}