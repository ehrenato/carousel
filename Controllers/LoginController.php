<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Utils\Inputs;

class LoginController extends Controller 
{
    public function index()
    {
        $data = [
            'msg' => ''
        ];
        if(!empty($_GET['error'])) {
            if($_GET['error'] == '1'){
                $data['msg'] = ' Usuário e/ou senha inválidos!';
            }
        }
        $this->loadView('login', $data);
    }

    public function signin() 
    {
        if(!empty($_POST['username'])) {
            $username = \strtolower($_POST['username']);
            $pass = $_POST['pass'];

            $user = new Users;
            if ($user->validateUser($username, $pass)) {
                \header('Location:'.BASE_URL);
                exit;
            } else {
                \header('Location:'.BASE_URL.'login?error=1');
                exit;
            }
        } else {
            \header("Location:".BASE_URL."login");
            exit;
        }
    }

    /*public function signup() 
    {
        $data = [
            'msg'=>''
        ];
        if(isset($_POST['btn-acessar'])) {
            if(!empty($_POST['username']) && !empty($_POST['pass'])) {
                unset($_POST['msg']);
                $username = \strtolower(Inputs::input($_POST['username']));
                $pass = $_POST['pass'];
                $passConfirm = $_POST['pass_confirm'];
                if($pass !== $passConfirm) {
                    $data['msg'] = '<span id="msg_corpo" style="color:red;">Senhas não são iguais!</span>
                    </div>';
                } else {
                    $user = new Users;
                    if ($user->validateUsername($username)) {
                        if(!$user->userExists($username)) {
                            $user->userRegister($username, $pass);
                            \header("Location:".BASE_URL."login");
                        } else {
                            $data['msg']='Usuário já existente!';
                        }
                    } else {
                        $data['msg'] = 'Usuário não válido (Digite apenas letras e números).';
                    }
                }
            }else{
                $data['msg'] = '<span id="msg_corpo" style="color:red;">Usuário e/ou senha são campos obrigátorios!</span>
                </div>';
            }
        }
        $this->loadView('signup', $data);
    }*/
}