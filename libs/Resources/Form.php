<?php

    /**
    *
    *-------------------------------------------------
    * Return error message
    *-------------------------------------------------
    *
    * @param string $data - POST name
    *
    **/

    function val($data)
    {
        if (isset($_SESSION[$data . '_value'])) {
            $value = $_SESSION[$data . '_value'];
            unset($_SESSION[$data . '_value']);
                return $value;
        }
    }

    /**
    *
    *-------------------------------------------------
    * Return error message
    *-------------------------------------------------
    *
    * @param string $data - POST name
    *
    **/

    function error($data)
    {
        if (isset($_SESSION[$data . '_message'])) {
            $message = $_SESSION[$data . '_message'];
            unset($_SESSION[$data . '_message']);
                return $message;
        }
    }