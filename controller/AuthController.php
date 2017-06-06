<?php namespace Controller;
/*
 |----------------------------------------------------------------------------------------------
 | Class AuthController
 | @package App\Controller
 |----------------------------------------------------------------------------------------------
 */
use Kernel\BaseController;

class AuthController extends BaseController {

    /**
     * Allows to render the login page
     */
    public function index() {
        $this->set([
            'view_style'  => ['auth/index','elements/login_header'],
            'view_script' => 'login-flash-messages'
        ]);
    }

    /**
     * Allows to manage the registering of a new member
     */
    public function register() {
        $this->loadModel('user');
        $data = $this->request->data();
        if($this->emptyField($data)) {
            $this->Session->setFlash('Veuillez remplir tous les champs correctement s\'il vous plait','danger');
            $this->redirect('/',200);
            die();
        } else {
            $data = $this->cleanHTML($data);
            $users = $this->User->findAll();
            extract($data);
            if(!$this->validEmail($email)) {
                $this->Session->setFlash("Veuillez entrez une adresse electronique de l'université", "danger");
                $this->redirect('/',200);
                die();
            } else if(!$this->freeEmail($email, $users)) {
                $this->Session->setFlash("Un compte a deja été attribué à cette adresse", "danger");
                $this->redirect('/',200);
                die();
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT);
                $name = $this->divideName($name);
                $firstName = $name['first'];
                $lastName = $name['last'];
                if($this->User->addNewUser($firstName, $lastName, $email, $password)) {
                    $lastUser = $this->User->findLast();
                    $this->addUser($lastUser);
                    $this->Session->setUser($lastUser);
                    $this->Session->setFlash("Bravo $firstName votre inscription a reussi avec succes. Veuillez activer compte en suivant le lien qui vous ai envoyé par email", "success");
                    $this->redirect('users/edit_profile',200);
                    die();
                } else {
                    $this->Session->setFlash('Le serveur présente des soucis techniques veuillez repasser plustard','danger');
                    $this->redirect('/',200);
                    die();
                }
            }
        }
    }

    /**
     * Allows to manage the login of a member
     */
    public function login() {
        $this->loadModel('user');
        $data = $this->request->data();
        if($this->emptyField($data)) {
            $this->Session->setFlash('Vous devez remplir tous les champs pour pouvoir vous connecter','danger');
            $this->redirect('/',200);
            die();
        } else {
            extract($data);
            $users = $this->User->findAll();
            foreach($users as $user) {
                if(
                    (
                        ($user->email === $login) ||
                        ($user->cellphone === $login) ||
                        ($user->pseudo === $login)
                    ) &&
                    password_verify($password, $user->password)
                ) {
                    $this->Session->setUser($user);
                    $this->Session->setFlash('Bonjour '.$user->first_name.'. Bienvenue dans Ebang et profitez pleinement de votre sagesse','success');
                    $this->redirect('users/home');
                    die();
                }
            }
            $this->Session->setFlash('Login ou mot de passe incorrecte','danger');
            $this->redirect('/',200);
            die();
        }
    }

    /**
     * Allows to log the current user out by killing the associated session
     */
    public function logout() {
        $this->Session->unsetUser();
        $this->redirect('auth/index');
    }

    /**
     * Allows to know if the email address is not already used by one account
     * @param $email the email address to validate
     * @param $users the object containing all email addresses present in the database
     * @return bool true id email is free and false if not
     */
    private function freeEmail($email, $users) {
        foreach($users as $user) {
            if($user->email == $email) return false;
        }
        return true;
    }

    /**
     * Allows to check if the entered email respects the format of the university
     * @param $email the email to check
     * @return bool true if valid and false if not
     */
    private function validEmail($email) {
        if(preg_match('/^[a-z]{1}\.[a-z]+[0-9]+@zig.univ.sn$/i',$email)) return true;
        return false;
    }

}
