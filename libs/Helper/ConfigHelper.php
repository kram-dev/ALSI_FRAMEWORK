<?php


function config($index)
{
	$result = explode('.', $index);

	$config = file_exists('config/'.$result[0].'.php') ? include 'config/'.$result[0].'.php' : null;

	if (@array_key_exists($result[10], $config[$result[1]][$result[2]][$result[3]][$result[4]][$result[5]][$result[6]][$result[7]][$result[8]][$result[9]])) {
		return $config[$result[1]][$result[2]][$result[3]][$result[4]][$result[5]][$result[6]][$result[7]][$result[8]][$result[9]][$result[10]];
	} else if (@array_key_exists($result[9], $config[$result[1]][$result[2]][$result[3]][$result[4]][$result[5]][$result[6]][$result[7]][$result[8]])) {
		return $config[$result[1]][$result[2]][$result[3]][$result[4]][$result[5]][$result[6]][$result[7]][$result[8]][$result[9]];
	} else if (@array_key_exists($result[8], $config[$result[1]][$result[2]][$result[3]][$result[4]][$result[5]][$result[6]][$result[7]])) {
		return $config[$result[1]][$result[2]][$result[3]][$result[4]][$result[5]][$result[6]][$result[7]][$result[8]];
	} else if (@array_key_exists($result[7], $config[$result[1]][$result[2]][$result[3]][$result[4]][$result[5]][$result[6]][$result[6]])) {
		return $config[$result[1]][$result[2]][$result[3]][$result[4]][$result[5]][$result[6]][$result[7]];
	} else if (@array_key_exists($result[6], $config[$result[1]][$result[2]][$result[3]][$result[4]][$result[5]])) {
		return $config[$result[1]][$result[2]][$result[3]][$result[4]][$result[5]][$result[6]];
	} else if (@array_key_exists($result[5], $config[$result[1]][$result[2]][$result[3]][$result[4]])) {
		return $config[$result[1]][$result[2]][$result[3]][$result[4]][$result[5]];
	} else if (@array_key_exists($result[4], $config[$result[1]][$result[2]][$result[3]])) {
		return $config[$result[1]][$result[2]][$result[3]][$result[4]];
	} else if (@array_key_exists($result[3], $config[$result[1]][$result[2]])) {
		return $config[$result[1]][$result[2]][$result[3]];
	} else if (@array_key_exists($result[2], $config[$result[1]])) {
		return $config[$result[1]][$result[2]];
	} else if (@array_key_exists($result[1], $config)) {
		return $config[$result[1]];
	}

	return false;
}