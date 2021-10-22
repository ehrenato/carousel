<?php

namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Permissions;

class HomeController extends Controller
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
		$permissions = new Permissions();

		$array = [
			'error' => '',
			'user_info' => $this->user->infoUser(),
			'list_permissions' => $permissions->list_permission(),
		];

		$this->loadTemplate('home', $array);
	}

	public function sair()
	{
		unset($_SESSION["chathashlogin"]);
		$_SESSION = [];
		header("Location:" . BASE_URL . "login");
		exit;
	}
}
