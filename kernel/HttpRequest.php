<?php namespace Kernel;
/*
 |-----------------------------------------------------
 | Class: HttpRequest
 | @package: app\kernel
 |-----------------------------------------------------
 | This class is the one that manages all http request
 | We use it to catch data passed in the browser url
 | and posted data too.
 */
class HttpRequest {

    /**
     * @var array the posted data
     */
    private $data = null;

    /**
     * @var array the posted file
     */
    private $file = null;

    /**
     * @var string the url passed in the browser
     */
    private $url;

    /**
     * @var float|int the page number
     */
    private $page = 1;

    /**
     * @var bool the prefix
     */
    private $prefix = false;

    /**
     * @var null the controller name
     */
    private $controller = null;

    /**
     * @var null the action name
     */
    private $action = null;

    /**
     * @var array lists of parameters
     */
    private $params = [];

    /**
     * Allows to create one instance of the HttpRequest object
     */
    public function __construct() {
        $this->url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
        if(isset($_GET['page']) && is_numeric($_GET['page']) && ($_GET['page'] > 0)) {
            $this->page = round($_GET['page']);
        }

        if(isset($_POST)) {
            foreach ($_POST as $key => $value) {
                $this->data[$key] = $value;
            }
        }

        if(isset($_FILES['file'])) {
            foreach ($_FILES['file'] as $key => $value) {
                $this->file[$key] = $value;
            }
        }
    }

    public function data($key = null) {
        if($key === null) {
            return $this->data;
        } else {
            if(isset($this->data[$key])) return $this->data[$key];
        }
        return null;
    }

    public function file($key = null) {
        if($key === null) {
            return $this->file;
        } else {
            if(isset($this->file[$key])) return $this->file[$key];
        }
        return null;
    }

    /**
     * Allows get the url stored in the object
     * @return string the url stored in the object
     */
    public function url(){
        return $this->url;
    }

    /**
     * Allows to set in the instance a new url
     * @param $url the url to set in instance
     */
    public function setUrl($url) {
        $this->url = $url;
    }

    /**
     * Allows to know the number of pages
     * @return float|int the number of pages
     */
    public function page() {
        return $this->page;
    }

    /**
     * Allows to change the page number in the instance
     * @param $page the page number to set in instance
     */
    public function setPage($page) {
        $this->page = $page;
    }

    /**
     * Allows to get one prefix value
     * @return bool the prefix in the url
     */
    public function prefix() {
        return $this->prefix;
    }

    /**
     * Allows to change the prefix used in the urls
     * @param $prefix the prefix value to store in instance
     */
    public function setPrefix($prefix) {
        $this->prefix = $prefix;
    }

    /**
     * Allows to get the specified controller in the url
     * @return null the controller name
     */
    public function controller() {
        return $this->controller;
    }

    /**
     * Allows to change the controller in the request object
     * @param $controller the new controller to store in instance
     */
    public function setController($controller) {
        $this->controller = $controller;
    }

    /**
     * Allows to get the specified action name in the url
     * @return null the action in the url
     */
    public function action() {
        return $this->action;
    }

    /**
     * Allows to set a new action name in the request object
     * @param $action the action to store in instance
     */
    public function setAction($action) {
        $this->action = $action;
    }

    /**
     * Allows to get all the parameters passed in the url request
     * @return array a list of the parameters passed in the url
     */
    public function params() {
        return $this->params;
    }

    /**
     * Allows to change the list of parameters in the request object
     * @param $params the new list of parameters
     */
    public function setParams($params) {
        $this->params = $params;
    }

    /**
     * Allows to add one parameter in the list of parameters in instance
     * @param $param the parameter to add to the list
     */
    public function addOneParam($param) {
        $this->params += $param;
    }

}