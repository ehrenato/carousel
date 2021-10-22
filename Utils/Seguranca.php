<?php

namespace Seguranca;

class Seguranca
{
}
class Cargo
{
  /**
   * __construct
   *
   * @return void
   */
  function __construct()
  {
  }

  private int $id;
  private int $cargo;
  private string $classe;
  private string $descricao;
  private string $escolaridade;
  private string $experiencia;
  private string $nome;

  /**
   * getCargo
   *
   * @return int
   */
  public function getCargo()
  {
    return $this->cargo;
  }
  /**
   * setCargo
   *
   * @param  mixed $cargo
   * @return void
   */
  public function setCargo($cargo)
  {
    $this->cargo = $cargo;
  }
  /**
   * getId
   *
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }
  /**
   * setId
   *
   * @param  mixed $id
   * @return void
   */
  public function setId($id)
  {
    $this->id = $id;
  }
}
class Menu
{
}
class Notificacao
{
}
class Perfil
{
}
class Permissao
{
}
class Regional
{
}
class Setor
{
}
class Sistema
{
}
class TokenConexao
{
}
class Unidade
{
}
class Usuario
{
}
class UsuarioSimplificado
{
}
