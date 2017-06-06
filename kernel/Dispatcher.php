<?php namespace Kernel;
/*
 |--------------------------------------------------------------------
 | Class Dispatcher
 | @package app\kernel
 |--------------------------------------------------------------------
 */
class Dispatcher {

    /**
     * @var HttpRequest the request object
     */
    var $request;

    /**
     * The constructor of the object; this method is the heart of the app.
     */
    public function __construct() {
        $this->request = new HttpRequest();
        Router::parse($this->request->url(), $this->request);
        $controller = $this->loadController();
        $action = $this->request->action();
        if($this->request->prefix()) {
            $action = $this->request->prefix().'_'.$action;
        }
        if($controller === null) {
            $this->error('le controller '.$this->request->controller().' n\'existe pas');
        }
        else {
            $class_methods = get_class_methods($controller);
            $parent_methods = get_class_methods(get_parent_class($controller));
            $class_methods =  array_diff($class_methods, $parent_methods);

            if(!in_array($action, $class_methods)) {
                $this->error('Le controller ' . $this->request->controller(). ' n\'a pas de méthode '.$action);
            }
            else {
                call_user_func_array([$controller, $action], $this->request->params());
                $controller->render($action);
            }
        }
    }

    /**
     * Allows to load one controller
     * @return null|string null if no controller to load and string if one controller has been found
     */
    public function loadController() {
        $controller = ucfirst($this->request->controller()) . 'Controller';
        $controllerFile = ROOT . DS . 'controller' . DS . $controller . '.php';
        $controller = '\\Controller\\' . $controller;
        if(is_file($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controller($this->request);
            $controller->Session = new Session();
            return $controller;
        }
        return null;
    }

    /**
     * Allows to send one error message to the error pages
     * @param $message the message to send to the error page
     */
    public function error($message) {
        $controller = new BaseController($this->request);
        $controller->e404($message);
    }

}