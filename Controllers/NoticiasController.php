<?php

namespace Controllers;

use Core\Controller;
use Models\PostFix;
use Models\Users;
use Utils\Inputs;

class NoticiasController extends Controller
{
  private $user;

  public function __construct()
  {
    $this->user = new Users();
    if (!$this->user->verifyLogin()) {
      header("Location:" . BASE_URL . "site");
      exit;
    }
  }

  public function index()
  {
    $noticias = new PostFix();

    $array = [
      'error' => '', 'user_info' => $this->user->infoUser()
    ];

    $array['noticias'] = $noticias->getPostByIdUser();
    $this->loadTemplate('noticias/home', $array);
  }
  public function noticia_form()
  {
    $array = [
      'user_info' => $this->user->infoUser()
    ];

    $this->loadTemplate('noticias/cadastrar_noticia', $array);
  }

  public function noticia_action()
  {
    $id_user = Inputs::input($_POST['id_user']);
    $titulo = Inputs::input($_POST['titulo']);
    $subtitulo = Inputs::input($_POST['subtitulo']);
    $corpo = Inputs::input($_POST['corpo']);
    $setores = $_POST['ck_suinin'];
    if (isset($_POST['btn-salvar'])) {

      if (!empty($setores)) {
        if (!empty($titulo) && !empty($corpo)) {
          $setores_implode = implode(',', $setores);
          $post = new PostFix();
          $last_id = $post->add($titulo, $subtitulo, $corpo, $id_user, $setores_implode);
          if ($last_id) {
            $_SESSION['last_id'] = $last_id;
            header("Location:" . BASE_URL . "noticias/img_carousel_form?last_id=$last_id");
            exit;
          }
        } else {
          $_SESSION['errorMsg'] = 'Campo título, subtitulo e/ou descrição são obrigatórios.';
          header("Location:" . BASE_URL . "noticias/noticia_form");
          exit;
        }
      } else {
        $_SESSION['errorMsg'] = 'Campo Setores é obrigatório selecionar pelo menos um.';
        header("Location:" . BASE_URL . "noticias/noticia_form");
        exit;
      }
    }
  }
  public function img_carousel_form()
  {
    $array = [
      'user_info' => $this->user->infoUser(),
    ];

    $this->loadTemplate('noticias/upload_img_main', $array);
  }

  public function img_upload_carousel_form()
  {
    $post = new PostFix();
    $array = [
      'user_info' => $this->user->infoUser(),
      'id_post' => $post->getPostId($_GET['id'])
    ];

    $this->loadTemplate('noticias/update_img_main', $array);
  }
  public function img_upload_carousel_action($id_post)
  {
    if (!empty($_FILES['file']['tmp_name'])) {
      $types_allowed = ['image/jpeg', 'image/jpg', 'image/png'];
      if (in_array($_FILES['file']['type'], $types_allowed)) {
        $new_name = md5(time() . rand(0, 999) . rand(0, 999)) . '.jpg';
        move_uploaded_file($_FILES['file']['tmp_name'], './media/upload/images/' . $new_name);
        $post = new PostFix();
        $post->updateImg($id_post, $new_name, $_POST['id_user']);
        header("Location:" . BASE_URL . "noticias");
        exit;
      }
    }
  }

  public function img_carousel_action($id_post)
  {
    if (!empty($_FILES['file']['tmp_name'])) {
      $types_allowed = ['image/jpeg', 'image/jpg', 'image/png'];
      if (in_array($_FILES['file']['type'], $types_allowed)) {
        $new_name = md5(time() . rand(0, 999) . rand(0, 999)) . '.jpg';
        move_uploaded_file($_FILES['file']['tmp_name'], './media/upload/images/' . $new_name);
        $post = new PostFix();
        $post->updateImg($id_post, $new_name, $_POST['id_user']);
        header("Location:" . BASE_URL . "noticias");
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
    $post = new PostFix();
    $array['info_post'] = $post->getPostId($_GET['id']);
    $this->loadTemplate('noticias/update_img', $array);
  }

  /**ENVIA PARA ATUALIZAR NOTICIA */
  public function noticia_update_action()
  {
    $post = new PostFix();
    $id_post = Inputs::input($_POST['id_post']);
    $post->updateInfo($id_post, $_POST['titulo'], $_POST['subtitulo'], $_POST['corpo'], $_POST['id_user']);
    header("Location:" . BASE_URL . "noticias/noticia_update_form/?id=" . $id_post);
    exit;
  }
}
