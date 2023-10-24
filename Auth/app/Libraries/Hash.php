<?php

    namespace App\Libraries;

    class Hash
    {
        // Ecnrypt the password
        public static function encrypt($password)
        {
            return password_hash($password, PASSWORD_BCRYPT);
        }

          // Check password is match or not

    public static function check($userPassword, $dbUserPassword)
    {
        if(password_verify($userPassword, $dbUserPassword))
        {
            return true;
        }

        return false;
    }

    }

  
?>