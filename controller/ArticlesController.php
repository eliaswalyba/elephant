<?php namespace Controller;

use Kernel\BaseController;

class ArticlesController extends BaseController {

    public function index() {
        $this->set(['view_style'  => ['articles/index','elements/blog_header']]);
        $this->loadModel('article');
        $articles = $this->Article->findAll();
        $this->set([
            'articles' => $articles,
            'title_for_layout' => 'Le Blog'
        ]);
    }

    public function view($id) {
        $this->loadModel('article');
        $articles = $this->Article->findAll(['conditions' => 'id='.$id]);
        $this->set('articles', $articles);
    }


    public function admin_index() {
        $this->loadModel('article');
        $articles = $this->Article->findAll();
        $total = $this->Post->findCount();
        $data['articles'] = $articles;
        $data['total'] = $total;
        $this->set($data);
    }

}