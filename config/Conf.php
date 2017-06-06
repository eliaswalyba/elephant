<?php namespace Config;
/*
 |-------------------------------------------------------------------
 | Class Conf
 | @package App\Config
 |-------------------------------------------------------------------
 */
class Conf
{

    /**
     * Allows to control the debugging level
     * @var int the debug level
     */
    public static $debug = 1;

    /**
     * Allows to store all information about accessing the database
     * @var array the database key access
     */
    public static $databases = [
        'default' => [
            'host'     =>  'localhost',
            'name'     => 'lab_e-bang',
            'login'    =>      'root',
            'password' =>          ''
        ]
    ];

}