<?php namespace Kernel;

/*
 |------------------------------------------------------
 | Class Session
 | @package App\Kernel
 |------------------------------------------------------
 */

class Session {

    /**
     * Allows to store the instance for further usage
     * @var null the instance of App\Kernel\Session();
     */
    private static $_instance = null;


    /**
     * Allows to make this a singleton
     * @return Session|null the session stored in instance if one; if not it creates one;
     */
    public static function getInstance() {
        if(self::$_instance === null) {
            self::$_instance = new Session();
            return self::$_instance;
        }
        return self::$_instance;
    }

    /**
     * The constructor of the class we use it to build
     * the session object and start it by the way
     */
    public function __construct() {
        session_start();
    }

    /**
     * @return null returns null
     */
    public function flash() {
        if(isset($_SESSION['flash'])) {
            $flash = '<div class="flash-message-'.
                $_SESSION["flash"]["type"].'" id="flash-message-'.
                $_SESSION["flash"]["type"].'">'.
                $_SESSION["flash"]["message"].'</div>';
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }

    /**
     * Allows to store one flash message in the session
     * @param $message the message to store
     * @param $type the type of the message
     */
    public function setFlash($message, $type) {
        $_SESSION['flash'] = [
            'message' => $message,
            'type'    => $type
        ];
    }

    public function setUser($user) {
        $_SESSION['user'] = $user;
    }

    public function getUser() {
        if(isset($_SESSION['user']))
            return $_SESSION['user'];
        return null;
    }

    public function unsetUserID() {
        if(isset($_SESSION['id']))
            unset($_SESSION['id']);
        return null;
    }

}