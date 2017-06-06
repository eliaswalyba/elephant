<?php use Kernel\Router;

Router::prefix('cockpit','admin');
Router::connect('/', 'auth/index');
Router::connect('articles/:slug-:id', 'articles/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('blog/:action', 'articles/:action');