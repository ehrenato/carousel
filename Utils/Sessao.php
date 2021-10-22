<?php

namespace Utils;

class Sessao{

    public static function sessionCheck($value){
        if (isset($_SESSION[$value])) {
            echo $_SESSION[$value];
            unset($_SESSION[$value]);
        }
    }

}