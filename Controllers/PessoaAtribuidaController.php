<?php

namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\PessoaAtribuida;


class PessoaAtribuidaController extends Controller
{

  private $user;
  private $pessoaAtribuida;

  public function __construct()
  {
    $this->user = new Users();
    $this->pessoaAtribuida = new PessoaAtribuida();
    if (!$this->user->verifyLogin()) {
      header("Location:" . BASE_URL . "site");
      exit;
    }
  }

  public function searchPessoas()
  {
    
    $json = $this->pessoaAtribuida->searchPessoasPorCpf($_GET['searchTerm']);
    $response = array();

    // Read Data
    foreach($json as $pessoa){
        $response[] = array(
            "id" => $pessoa['id'],
            "text" => $pessoa['cpf']." - ". $pessoa['nome']
        );
    }

    echo json_encode($response);
    exit();
    //foreach($pessoaAtribuida->searchPessoasPorCpf($busca)
  }
  public function store(){
    $data = filter_input_array(INPUT_POST);
    $this->pessoaAtribuida->insertPessoa($data);
    echo json_encode(array("success"=>true));
  }
  public function update(){
    $data = filter_input_array(INPUT_POST);
    $this->pessoaAtribuida->updatePessoa($data);
    return true;
  }
  public function delete($id){
    $this->pessoaAtribuida->deletePessoa($id);
  }
}
