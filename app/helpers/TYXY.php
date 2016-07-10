<?php

class TYXY {
    
    public static function isAdmin()
    {
        return true;
        // return (Session::get('user_role') == 'admin') ? true : false;
    }

    public static function isTeacher()
    {
        return (Session::get('user_role') == 'teacher') ? true : false;
    }
}