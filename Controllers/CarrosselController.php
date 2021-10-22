<?php

namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Post;
use \Models\Carrossel;
use \Utils\Inputs;
use \Models\Contatos;

class CarrosselController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new Users();
       /* if(!$_SESSION['perfil']==1){
            header("Location:" . BASE_URL . "login");
            exit;
        }*/
        if (!$this->user->verifyLogin()) {
            header("Location:" . BASE_URL . "login");
            exit;
        }
    }

    public function index()
    {
        $array = [
            'user_info' => $this->user->infoUser(),
        ];

        $carrossel = new Carrossel();
        $array['total'] = $carrossel->getCarrosselAll();
        $this->loadTemplate('carrossel/datatable', $array);
    }

    public function noticia_form()
    {
        $array = [
            'user_info' => $this->user->infoUser()
        ];

        $this->loadTemplate('carrossel/cadastrar_noticia', $array);
    }

    public function noticia_action()
    {
        $id_user = Inputs::input($_POST['id_user']);
        $titulo = Inputs::input($_POST['titulo']);
        
        if (isset($_POST['btn-salvar'])) {

                if (!empty($titulo)) {
                    $carrossel = new Carrossel();
                    $last_id = $carrossel->add($titulo, $id_user);
                    if ($last_id) {
                        $_SESSION['last_id'] = $last_id;
                        header("Location:" . BASE_URL . "carrossel/img_carousel_form?last_id=$last_id");
                        exit;
                    }
                } else {
                    $_SESSION['errorMsg'] = 'Campo título é obrigatório.';
                    header("Location:" . BASE_URL . "carrossel/noticia_form");
                    exit;
                }
        }
    }

    public function img_carousel_form()
    {
        $array = [
            'user_info' => $this->user->infoUser(),
        ];

        $this->loadTemplate('carrossel/upload_img_main', $array);
    }

    public function img_upload_carousel_form()
    {
        $carrossel = new Carrossel();
        $array = [
            'user_info' => $this->user->infoUser(),
            'id_carrossel' => $carrossel->getCarrosselId($_GET['id'])
        ];

        $this->loadTemplate('carrossel/update_img_main', $array);
    }

    public function img_upload_carousel_action($id_carrossel)
    {
        if (!empty($_FILES['file']['tmp_name'])) {
            $types_allowed = ['image/jpeg', 'image/jpg', 'image/png'];
            if (in_array($_FILES['file']['type'], $types_allowed)) {
                $new_name = md5(time() . rand(0, 999) . rand(0, 999)) . '.jpg';
                move_uploaded_file($_FILES['file']['tmp_name'], './media/upload/images/' . $new_name);
                $carrossel = new Carrossel();
                $carrossel->updateImg($id_carrossel, $new_name, $_POST['id_user']);
                header("Location:" . BASE_URL . "carrossel");
                exit;
            }
        }
    }

    public function img_carousel_action($id_carrossel)
    {
        if (!empty($_FILES['file']['tmp_name'])) {
            $types_allowed = ['image/jpeg', 'image/jpg', 'image/png'];
            if (in_array($_FILES['file']['type'], $types_allowed)) {
                $new_name = md5(time() . rand(0, 999) . rand(0, 999)) . '.jpg';
                move_uploaded_file($_FILES['file']['tmp_name'], './media/upload/images/' . $new_name);
                $carrossel = new Carrossel();
                $carrossel->updateImg($id_carrossel, $new_name, $_POST['id_user']);
                header("Location:" . BASE_URL . "carrossel");
                exit;
            }
        }
    }

    /**UPLOAD DOS ARQUIVO DO EDITOR TINYMCE */
    public function upload_tinymce()
    {
        if (!empty($_FILES['file']['tmp_name'])) {
            $types_allowed = ['image/jpeg', 'image/jpg', 'image/png'];
            if (in_array($_FILES['file']['type'], $types_allowed)) {
                $new_name = md5(time() . rand(0, 999) . rand(0, 999)) . '.jpg';
                move_uploaded_file($_FILES['file']['tmp_name'], './media/pages/' . $new_name);

                $array = [
                    'location' => BASE_URL . './media/pages/' . $new_name
                ];
                echo json_encode($array);
                exit;
            }
        }
    }

    /**CARREGA FORMULARIO DA NOTICIA */
    public function noticia_update_form()
    {
        $array = [
            'user_info' => $this->user->infoUser(),
        ];
        $carrossel = new Carrossel();
        $array['info_carrossel'] = $carrossel->getCarrosselId($_GET['id']);
        $this->loadTemplate('carrossel/update_img', $array);
    }

    /**ENVIA PARA ATUALIZAR NOTICIA */
    public function noticia_update_action()
    {
        $carrossel = new Carrossel();
        $id_carrossel = Inputs::input($_POST['id_carrossel']);
        $carrossel->updateInfo($id_carrossel, $_POST['titulo'], $_POST['id_user']);
        header("Location:" . BASE_URL . "carrossel/noticia_update_form?id=" . $id_carrossel);
        exit;
    }

    public function curriculos()
    {
        $array = array('error' => '', 'user_info' => $this->user->infoUser());
        $contatos = new Contatos();
        $array['emails_curriculo'] = $contatos->listar_estagiarios();
        $array['total_cadastros'] = $contatos->lista_total_cadastro();
        $array['aguardando'] = $contatos->lista_aguardando();
        $array['entrevistado'] = $contatos->lista_entrevistados();
        $array['selecionado'] = $contatos->lista_selecionados();
        $this->loadTemplate('estagio/curriculos_view', $array);
    }

    public function obs_entrevista($id)
    {
        $contato = new Contatos();
        $array = [
            'error' => '',
            'user_info' => $this->user->infoUser(),
            'contato' => $contato->estagiario_id($id)
        ];

        $this->loadTemplate('estagio/entrevista', $array);
    }

    public function obs_entrevista_action($id)
    {

        $id = Inputs::input($_POST['id_estagiario']);
        $nome_c = Inputs::input($_POST['nome_completo']);
        $cpf = Inputs::input($_POST['cpf']);
        $email = Inputs::input($_POST['email']);
        $nome_curso = Inputs::input($_POST['nome_curso']);
        $ira = Inputs::input($_POST['ira']);
        $phone = Inputs::input($_POST['phone']);
        $prev_cc = $_POST['prev_conclusao_curso'];
        $ops = Inputs::input($_POST['opcoes']);
        $obs = Inputs::input($_POST['observacao']);
        $contato = new Contatos();

        $contato->estagio_action($nome_c, $cpf, $email, $nome_curso, $ira, $phone, $ops, $prev_cc, $obs, $id);

        $url = 'media/upload/documentos/';

        if (!empty($_FILES['historico']["tmp_name"])) {
            $types_allowed = ['application/pdf'];
            if (in_array($_FILES['historico']['type'], $types_allowed)) {
                $contato->unlinkEstagios($id, $url);
                $new_name_h = md5(time() . rand(0, 999) . rand(0, 999)) . '.pdf';
                move_uploaded_file($_FILES['historico']['tmp_name'], $url . $new_name_h);
                $contato->historic_update($new_name_h, $id);
            }
        }

        if (!empty($_FILES['curriculo']["tmp_name"])) {
            $types_allowed = ['application/pdf'];
            if (in_array($_FILES['curriculo']['type'], $types_allowed)) {
                $contato->unlinkEstagios($id, $url);
                $new_name_c = md5(time() . rand(0, 999) . rand(0, 999)) . '.pdf';
                move_uploaded_file($_FILES['curriculo']['tmp_name'], $url . $new_name_c);
                $contato->curriculo_update($new_name_c, $id);
            }
        }

        header("Location:" . BASE_URL . "carrossel/curriculos");
        exit;
    }

    public function arquivo_delete() 
    {
        $carrossel = new Carrossel();
        $carrossel->deleteCarrossel($_GET['id'], $_GET['id_user']);
        echo json_encode($_GET['id']);
        exit;
    }

    public function user_all()
    {
        $array = [
                'error' => '', 
                'user_info' => $this->user->infoUser(),
                'user_list' => $this->user->userList(),
                
            ];
       
      
        $this->loadTemplate('users/users_list_view', $array);
    }
    public function user_all1() 
    {
       $carrossel = new Carrossel();
       $carrossel->deleteCarrossel($_GET['id'], $_GET['id_user']);
       echo json_encode($_GET['id']);
       exit;
    }
}
