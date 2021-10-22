<?php

namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Carrossel;
use \Utils\Inputs;

class DashboardController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new Users();

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
        $this->loadTemplate('dashboard/datatable', $array);
    }

    public function noticia_form()
    {
        $array = [
            'user_info' => $this->user->infoUser()
        ];

        $this->loadTemplate('dashboard/cadastrar_noticia', $array);
    }

    public function noticia_action()
    {
        $id_user = Inputs::input($_POST['id_user']);
        $titulo = Inputs::input($_POST['titulo']);
        
        if (isset($_POST['btn-salvar'])) {

            if (!empty($setores)) {
                if (!empty($titulo) && !empty($corpo)) {
                    $setores_implode = implode(',', $setores);
                    $carrossel = new Carrossel();
                    $last_id = $carrossel->add($titulo, $subtitulo, $corpo, $id_user, $setores_implode);
                    if ($last_id) {
                        $_SESSION['last_id'] = $last_id;
                        header("Location:" . BASE_URL . "dashboard/img_carousel_form?last_id=$last_id");
                        exit;
                    }
                } else {
                    $_SESSION['errorMsg'] = 'Campo título, subtitulo e/ou descrição são obrigatórios.';
                    header("Location:" . BASE_URL . "dashboard/noticia_form");
                    exit;
                }
            } else {
                $_SESSION['errorMsg'] = 'Campo Setores é obrigatório selecionar pelo menos um.';
                header("Location:" . BASE_URL . "dashboard/noticia_form");
                exit;
            }
        }
    }

    public function img_carousel_form()
    {
        $array = [
            'user_info' => $this->user->infoUser(),
        ];

        $this->loadTemplate('dashboard/upload_img_main', $array);
    }

    public function img_upload_carousel_form()
    {
        $carrossel = new Carrossel();
        $array = [
            'user_info' => $this->user->infoUser(),
            'id_carrossel' => $carrossel->getCarrosselId($_GET['id'])
        ];

        $this->loadTemplate('dashboard/update_img_main', $array);
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
                header("Location:" . BASE_URL . "dashboard");
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
                header("Location:" . BASE_URL . "dashboard");
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
        $this->loadTemplate('dashboard/update_img', $array);
    }

    /**ENVIA PARA ATUALIZAR NOTICIA */
    public function noticia_update_action()
    {
        $carrossel = new Carrossel();
        $id_carrossel = Inputs::input($_POST['id_carrossel']);
        $carrossel->updateInfo($id_carrossel, $_POST['titulo'], $_POST['subtitulo'], $_POST['corpo'], $_POST['id_user']);
        header("Location:" . BASE_URL . "dashboard/noticia_update_form?id=" . $id_carrossel);
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
