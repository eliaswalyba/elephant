<?php namespace Controller;

use Kernel\BaseController;

class UsersController extends BaseController {

    public function home() {
        $this->set([
            'view_style' => ['users/home','elements/home_header'],
            'view_script' => ['login-flash-messages', 'dropDownMenu']
        ]);

    }

    public function share() {
        $this->loadModel('Post');
        $user = $this->Session->getUser();
        $data = $this->request->data();
        $file = $this->request->file();

        $this->Post->setNew($data, $user, $file);
        $this->Session->setFlash('Bravo '.$user->first_name.' Vous venez de participer','success');
        $this->redirect('users/home');
    }

    public function edit_profile() {
        $this->set([
            'view_style' => ['users/edit_profile','elements/login_header'],
            'view_script' => ['login-flash-messages']
        ]);
    }

}