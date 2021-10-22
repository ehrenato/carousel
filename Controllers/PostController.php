<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Post;

class PostController extends Controller {

	private $user;

	public function __construct()
	{
		$this->user = new Users();
		if(!$this->user->verifyLogin()) {
			header("Location:".BASE_URL."site");
			exit;
		}
	}

	public function index() {
		$array = [ 'error'=>''
			,'user_info'=>$this->user->infoUser()
		];
		$this->loadTemplate('home', $array);
	}

	public function updatePost() {
		
		$post = new Post();

		$id_user = filter_input(INPUT_POST,$_POST['id_user'],FILTER_SANITIZE_SPECIAL_CHARS);
		$id_post = $_POST['id_post'];
		$titulo = $_POST['titulo'];
		$subtitulo = $_POST['subtitulo'];
		$corpo = $_POST['corpo'];
		$fotos = $_FILES;
		
		if(!empty($titulo) || !empty($corpo)){
			$post->updateInfo($id_post, $subtitulo, $titulo, $corpo, $id_user);
		}
		if(!empty($fotos)){
			$url = 'media/upload/images/';
			$img = $fotos['img']['tmp_name'];
			$tipo = $fotos['img']['type'];
			
			if (in_array($tipo, ['image/jpeg', 'image/png'])) {
					$tmpName = md5(time() . rand(0, 9999)) . '.jpg';
						$post->unlinkPost($id_post,$url);
						move_uploaded_file($fotos['img']['tmp_name'],$url.$tmpName);
						list($width_orig, $height_orig) = getimagesize($url.$tmpName);
						$ratio = $width_orig / $height_orig;
		
						$width = 500;
						$height = 500;
		
						if ($width / $height > $ratio) {
							$width = $height * $ratio;
						} else {
							$height = $width / $ratio;
						}
		
						$img = \imagecreatetruecolor($width, $height);
		
						if ($tipo == 'image/jpeg') {
							$origi = imagecreatefromjpeg($url.$tmpName);
						} elseif ($tipo == 'image/png') {
							$origi = imagecreatefrompng($url.$tmpName);
						}
		
						imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
						imagejpeg($img, $url.$tmpName, 80);
						$post->updateImg($id_post, $tmpName, $id_user);
						header("Location:".BASE_URL."info/updatePost/".$id_post);
						exit;
				}
		}
        header("Location:".BASE_URL."info/updatePost/".$id_post);
        exit;
	}
	
	public function deletePost($id){
		try {
			$post = new Post();
			$id_user = $_SESSION['info_id'];
			$post->deletePost($id, $id_user);
		} catch (\PDOException $error) {
			echo "ERRO NO DELETE POSTS:".$error->getMessage();
		}
	}
}