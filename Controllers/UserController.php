<?php

namespace Controllers;

use \Core\Controller;
use Models\Permissions;
use \Models\Users;

class UserController extends Controller
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
		$array = [
			'error' => '', 'user_info' => $this->user->infoUser()
		];

		$this->loadTemplate('home', $array);
	}

	public function viewUser()
	{
		$array = [
			'error' => '',
			'user_info' => $this->user->infoUser(),
			//'permissoes_lista' => $this->user->userPermission()
		];


		$this->loadTemplate('view_user', $array);
	}

	public function viewUserAction()
	{
		$arrayInfo = filter_input_array(INPUT_POST);

		if (!empty($_FILES['arquivo']["tmp_name"])) {
			$types_allowed = ['image/jpeg', 'image/jpg', 'image/png'];
			$url = 'assets/imagens/usuarios/';
			$type = $_FILES['arquivo']['type'];
			if (in_array($type, $types_allowed)) {
				$this->user->unlinkImageUser($arrayInfo['user_id'], $url);
				$new_name_user = md5(time() . rand(0, 999) . rand(0, 999)) . '.jpeg';
				move_uploaded_file($_FILES['arquivo']['tmp_name'], $url . $new_name_user);

				list($width_orig, $height_orig) = getimagesize($url . $new_name_user);
				$ratio = $width_orig / $height_orig;

				$width = 100;
				$height = 100;

				if ($width / $height > $ratio) {
					$width = $height * $ratio;
				} else {
					$height = $width / $ratio;
				}

				$img = \imagecreatetruecolor($width, $height);

				if ($type == 'image/jpeg') {
					$origi = imagecreatefromjpeg($url . $new_name_user);
				} elseif ($type == 'image/png') {
					$origi = imagecreatefrompng($url . $new_name_user);
				}

				imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
				imagejpeg($img, $url . $new_name_user, 80);
				$this->user->userUpagetImage($new_name_user, $arrayInfo['user_id']);
			}
		}
		$usuario = $arrayInfo['usuario'];
		$senha = $arrayInfo['senha'];
		$confirma_senha = $arrayInfo['confirma_senha'];

		if ($senha !== $confirma_senha) {
			$_SESSION['errorSenha'] = 'Senhas não são iguais';
			header("Location:" . BASE_URL . "user/viewUser");
			exit;
		} else {
			if (isset($senha) && !empty($senha)) {
				$passCrypt = password_hash($senha, PASSWORD_DEFAULT);
				$this->user->userUpdatePass($usuario, $passCrypt, $arrayInfo['user_id']);
				header("Location:" . BASE_URL . "home");
				exit;
			} else {
				$this->user->userUpdate($usuario, $arrayInfo['user_id']);
				header("Location:" . BASE_URL . "home");
				exit;
			}
		}
	}

	public function edit_view($id)
	{
		$permissions = new Permissions();
		$array = [
			'error' => '',
			'user_info' => $this->user->infoUser(),
			'list_permissions' => $permissions->list_permission(),
			'user_id' => $this->user->listUserId($id)
		];

		$this->loadTemplate('users/edit_view', $array);
	}

	public function edit_action()
	{
		$arrayPost = filter_input_array(INPUT_POST);
		// var_dump($this->user->userExists($arrayPost['usuario'], $arrayPost['id_user']));exit;
		if (!$this->user->userExists($arrayPost['usuario'], $arrayPost['id_user'])) {
			$sql = $this->user->edit($arrayPost['usuario'], $arrayPost['perfis'], $arrayPost['id_user']);
			$msg["resposta"] = "success";
		} else {
			$msg['userExists'] = 'Já existe um usuário cadastrado com esté nome';
			$msg["resposta"] = "error";
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
	}

	public function add()
	{
		$permissions = new Permissions();
		$array = [
			'error' => '',
			'user_info' => $this->user->infoUser(),
			'list_permissions' => $permissions->list_permission(),
			//'listar_permissoes' => $this->user->listPermission()
		];

		$this->loadTemplate('users/create_view', $array);
	}

	public function add_action()
	{
		$arrayInfo = filter_input_array(INPUT_POST);
		if ($arrayInfo['usuario'] !== '' && $arrayInfo['logado_id'] !== '' && $arrayInfo['perfis'] !== '') {
			if (!$this->user->userExists($arrayInfo['usuario'])) {
				$sql = $this->user->add($arrayInfo['usuario'], $arrayInfo['logado_id'], $arrayInfo['perfis']);
				echo json_encode($sql, JSON_UNESCAPED_UNICODE);
				exit;
			} else {
				$msg['userExists'] = 'Já existe um usuário cadastrado com esté nome';
				echo json_encode($msg, JSON_UNESCAPED_UNICODE);
				exit;
			}
		}
	}

	public function disable()
	{
		$arrayInfo = filter_input_array(INPUT_GET);
		$this->user->disable($arrayInfo['id']);
		header("Location:" . BASE_URL . "dashboard/user_all");
		exit;
	}

	public function reset_pass()
	{
		$arrayInfo = filter_input_array(INPUT_GET);
		$this->user->reset_pass($arrayInfo['id']);
		header("Location:" . BASE_URL . "dashboard/user_all");
		exit;
	}
}
