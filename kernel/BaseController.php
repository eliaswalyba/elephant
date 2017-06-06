<?php namespace Kernel;
/*
 |-------------------------------------------------------------
 | Class BaseController
 | @package App\Kernel
 |-------------------------------------------------------------
 | This is the principle controller of the app. It manifactures
 | all common methods of other controllers
 |
 */
class BaseController {

    /**
     * @var bool determines one view has already been rendered
     */
    protected $rendered = false;

    /**
     * @var null the request object
     */
    protected $request = null;

    /**
     * @var array some vars to send to the views
     */
    protected $vars = [];


    /**
     * Allows to build the class and initialize the request object
     * @param $request the request object
     */
    public function __construct($request = null) {
        if($request !== null) {
            $this->request = $request;
        }
    }

    /**
     * Allows to render one view in a specifique layout
     * @param $view the view to render
     * @param string $layout the layout in which to render the view
     * @return bool|void false if one view has already been rendered and void if no view rendered before
     */
    public function render($view, $layout = 'default') {
        if($this->rendered) {
            return false;
        }
        extract($this->vars);
        if(strpos($view, '/') === 0) {
            $view = ROOT.DS.'view'.DS.$view.'.php';
        } else {
            $view = ROOT.DS.'view'.DS.'pages'.DS.$this->request->controller().DS.$view.'.php';
        }
        ob_start();
        require_once $view;
        $content_for_layout = ob_get_clean();
        require_once ROOT.DS.'view'.DS.'layouts'.DS.$layout.'.php';
        $this->rendered = true;
    }

    /**
     * Allows to set variables for sending them after to the views
     * @param $key the key of the variable
     * @param null $value the value of the variable
     */
    public function set($key, $value = null) {
        if(is_array($key)) {
            $this->vars += $key;
        } else {
            $this->vars[$key] = $value;
        }
    }

    /**
     * Allows to load one model in each controller
     * @param $name the model to load
     */
    public function loadModel($name) {
        $name = ucfirst($name);
        $file = ROOT.DS.'model'.DS.$name.'.php';
        if(!isset($this->$name)) {
            require_once $file;
            $model = '\\Model\\'.$name;
            $this->$name = new $model();
        }
    }

    /**
     * Allows to render a 404 Not Found error page
     * @param $message
     */
    public function e404($message) {
        header('HTTP/1.0 404 Not Found');
        $this->set('message', $message);
        $this->render('/errors/404');
        die();
    }

    /**
     * Allows to redirect to one url
     * @param $url the url of the page to render
     * @param null $code the code to associate with the page in which we redirect
     */
    public function redirect($url, $code = null) {
        if($code === 301) {
            header('HTTP/1.1 301 Moved Permanently');
        }
        header('location: '.Router::url($url));
    }


    /**
     * Allows to call one controller from a view
     * @param $controller the name of the controller to call
     * @param $action the action to call in that controller
     * @return mixed the action
     */
    public function request($controller, $action) {
        $controller = ucfirst($controller).'Controller';
        $file = ROOT.DS.'controller'.DS.$controller.'.php';
        if(is_file($file)) {
            require_once $file;
            $controller = '\\Controller\\'.$controller;
            $c = new $controller;
            return $c->$action();
        }
    }

    /**
     * Allows to check if one variable is empty or not
     * @param $param the parameter to check
     * @return bool true if one field is empty and false if not
     */
    public function emptyField($param) {
        $empty = false;
        if(is_array($param)) {
            foreach($param as $v) {
                if(empty($v)) $empty = true;
            }
        } else {
            if(empty($param)) $empty = true;
        }
        return $empty;
    }

    /**
     * Allows to avoid html injections
     * @param $param the variable to clean
     * @return array|string cleaned variable
     */
    public function cleanHTML($param) {
        if(is_array($param)) {
            foreach($param as $k => $v)
                $param[$k] = htmlspecialchars(trim($v));
        } else {
            $param = htmlspecialchars(trim($param));
        }
        return $param;
    }

    /**
     * Allows to divide the username entered in the register form into first name and last name
     * @param $n the full name to divide
     * @return array the array containing the first name and the last name
     */
    public function divideName($n) {
        $guesser = [];
        $n = explode(' ', $n);
        $lastName[] = end($n);
        $firstName = array_diff($n, $lastName);
        $guesser['last'] = '';
        $guesser['first'] = '';
        foreach($lastName as $v)
            $guesser['last'] .= $v;
        foreach($firstName as $v)
            $guesser['first'] .= $v.' ';
        $guesser['first'] = trim($guesser['first'],' ');
        return $guesser;
    }

    /**
     * Allows to create one directory in the server filesystem
     * @param $path the path of the directory
     * @return bool true if the directory is well created and false if not
     */
    public function createDir($path) {
        if(!is_dir($path)) {
            mkdir($path);
            chmod($path, 777);
            return true;
        }
        return false;
    }

    public function addUser($user) {
        $root = HOME.DS.'users'.DS.$user->id;
        $share = $root.DS.'share';
        $storage = $root.DS.'storage';
        $avatars = $root.DS.'avatars';
        $this->createDir($root);
        $this->createDir($share);
        $this->createDir($storage);
        $this->createDir($avatars);
    }

}