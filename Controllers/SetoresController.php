<?php

namespace Controllers;

use Core\Controller;
use Models\Setores;
use Models\Users;

class SetoresController extends Controller
{

	private $user;
	private $arrayInfo;

	public function __construct()
	{
		$this->user = new Users();
		if (!$this->user->verifyLogin()) {
			header("Location:" . BASE_URL . "login");
			exit;
		}

		$this->arrayInfo = array(
			'user' => $this->user,
			'menuActive' => 'setores'
		);
	}

	public function index()
	{
		$this->loadTemplate('setor/index', $this->arrayInfo);
	}

	public function form()
	{

		$this->loadTemplate('setor/form_cadastro', $this->arrayInfo);
	}
	public function searchSetores()
	{
		$setores = new Setores();
		$json = $setores->searchSetores($_GET['searchTerm']);
		$response = array();

		// Read Data
		foreach($json as $setor){
			$response[] = array(
				"id" => $setor['id'],
				"text" => $setor['sigla_nova']." - ". $setor['nome_novo']
			);
		}

		echo json_encode($response);
		exit();
		//foreach($pessoaAtribuida->searchPessoasPorCpf($busca)
	}
}
