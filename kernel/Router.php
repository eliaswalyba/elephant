<?php namespace Kernel;
/*
 |-------------------------------------------------
 | Class Router
 | @package App\Kernel
 |-------------------------------------------------
 | This class allows to catch
 */

class Router {

    /**
     * @var array all routes of the app;
     */
    private static $routes = [];

    /**
     * @var array all prefixes of the app;
     */
    private static $prefixes = [];


    /**
     * Allows to get one prefix in the prefixes
     * @param $url the url corresponding to the prefix
     * @param $prefix the prefix representing the url
     */
    public static function prefix($url, $prefix) {
        self::$prefixes[$url] = $prefix;
    }

    /**
     * Allows to parse one url
     * @param $url the url to parse
     * @param $request the request object in which we store the parsed url
     * @return bool we return true after all jobs
     */
    public static function parse($url, $request) {
        $url = trim($url, '/');
        if(empty($url)) {
            $url = Router::$routes[0]['url'];
        } else {
            foreach(Router::$routes as $route) {
                if(preg_match($route['catcher'],$url, $matches)) {
                    $request->setController($route['controller']);
                    $request->setAction(isset($matches['action']) ? $matches['action'] : $route['action']);
                    $params = [];
                    foreach($route['params'] as $k => $v) {
                        $params[$k] = $matches[$k];
                    }
                    $request->setParams($params);
                    if(!empty($matches['args'])) {
                        $request->addOneParam(explode('/', trim($matches['args'],'/')));
                    }
                    return $request;
                }
            }
        }
        $parts = explode('/', $url);
        if(in_array($parts[0], array_keys(self::$prefixes))) {
            $request->setPrefix(self::$prefixes[$parts[0]]);
            array_shift($parts);
        }
        $request->setController($parts[0]);
        $request->setAction(isset($parts[1]) ? $parts[1] : 'index');
        $request->setParams(array_slice($parts, 2));
        return true; //All's working pretty good
    }


    /**
     * Allows to connect one url to it's redirection
     * @param $redir the redirection
     * @param $url the url to redirect
     */
    public static function connect($redir, $url) {
        $r = [];
        $r['params'] = [];
        $r['url'] = $url;
        $r['redir'] = $redir;
        $r['origin'] = str_replace(':action','(?P<action>([a-z0-9]+))', $url);
        $r['origin'] = preg_replace('/([a-z0-9]+):([^\/]+)/', '${1}:(?P<${1}>${2})', $r['origin']);
        $r['origin'] = '/^'.str_replace('/','\/', $r['origin']).'(?P<args>\/?.*)$/';
        $params = explode('/', $url);
        foreach($params as $k => $v) {
            if(strpos($v, ':')) {
                $p = explode(':', $v);
                $r['params'][$p[0]] = $p[1];
            } else {
                if($k == 0) {
                    $r['controller'] = $v;
                } else if($k == 1) {
                    $r['action'] = $v;
                }
            }
        }
        $r['catcher'] = $redir;
        $r['catcher'] = str_replace(':action','(?P<action>([a-z0-9]+))', $r['catcher']);
        foreach($r['params'] as $k => $v) {
            $r['catcher'] = str_replace(":$k","(?P<$k>$v)", $r['catcher']);
        }
        $r['catcher'] = '/^'.str_replace('/','\/', $r['catcher']).'(?P<args>\/?.*)$/';
        self::$routes[] = $r;
    }

    /**
     * Allows to manufacture one url
     * @param $url the url to treat
     * @return string the right url
     */
    public static function url($url) {
        foreach(self::$routes as $route) {
            if(preg_match($route['origin'], $url, $match)) {
                foreach($match as $k=>$v) {
                    if(!is_numeric($k)) {
                        $route['redir'] = str_replace(":$k", $v, $route['redir']);
                    }
                }
                return BASE_URL.str_replace('//','/','/'.$route['redir']).$match['args'];
            }
        }

        foreach(self::$prefixes as $k => $v) {
            if(strpos($url,$v) === 0) {
                $url = str_replace($v,$k,$url);
            }
        }
        return BASE_URL.str_replace('//','/','/'.$url);
    }

}