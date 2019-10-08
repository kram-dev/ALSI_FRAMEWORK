<?php

namespace Library\Provider;

Class AuthenticationProvider
{

  /**
    *
    *-------------------------------------------------
    * Authenticate User
    *-------------------------------------------------
    *
    * @param string $key      - Session name | default 
    *                           by id
    * @param string $redirect - redirect page | default
    *                           by base url
    *
    **/

    public function check($key = 'id', $redirect = '')
    {
        if (isset($_SESSION[$key]) || isset($_SESSION['facebook_id']) || isset($_SESSION['google_id'])) {
            return true;
        } else {
            redirect($redirect);
        }
    }

  /**
    *
    *-------------------------------------------------
    * Check if User is already logged
    *-------------------------------------------------
    *
    * @param string $key      - Session name | default 
    *                           by id
    * @param string $redirect - redirect page | default
    *                           by base url
    *
    **/

    public function isLogged($key = 'id', $redirect = '')
    {
        if (isset($_SESSION[$key]) || isset($_SESSION['facebook_id']) || isset($_SESSION['google_id'])) {
            redirect($redirect);
        }
    }

  /**
    *
    *-------------------------------------------------
    * Check if User is Administrator
    *-------------------------------------------------
    *
    * @param string $role     - User role | default by 
    *                           admin
    * @param string $redirect - redirect page | default
    *                           by base url
    * @param string $key      - Session name | default 
    *                           by role
    *
    **/

    public function isAdmin($role = 'admin', $redirect = '', $key = 'role')
    {
        if ($_SESSION[$key] == $role) {
            redirect($redirect);
        } else {
            redirect($redirect);
        }
    }

}