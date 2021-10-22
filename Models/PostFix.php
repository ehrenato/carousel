<?php

namespace Models;

use Core\Model;
use PDO;
use PDOException;

class PostFix extends Model
{
  public function add($titulo, $corpo, $id_user, $setores)
  {
    try {
      $primeiro_insert = date('Y-m-d H:i:s');
      $sql = "INSERT INTO post_fix(titulo, post, image, id_user, setores, created_at, updated_at)VALUES(:titulo, :post, :image, :id_user,:setores , :create_at, :update_at)";
      $img = 'assets/imagens/default.jpg';
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':titulo', $titulo);
      $sql->bindValue(':post', $corpo);
      $sql->bindValue(':image', $img);
      $sql->bindValue(':setores', $setores);
      $sql->bindValue(':id_user', $id_user);
      $sql->bindValue(':create_at', $primeiro_insert);
      $sql->bindValue(':update_at', $primeiro_insert);
      $sql->execute();

      return $this->db->lastInsertId();
    } catch (PDOException $e) {
      throw $e;
    }
  }

  /**UPDATE DA IMAGEN DO CAROUSEL */
  public function updateImg($id_post, $img, $id_user)
  {
    try {
      $update = date('Y-m-d H:i:s');

      $sql = "UPDATE post_fix SET image=:image, update_at=:updated_at, id_user=:id_user WHERE id=:id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id',  $id_post);
      $sql->bindValue(':image',   $img);
      $sql->bindValue(':update_at',   $update);
      $sql->bindValue(':id_user', $id_user);
      $sql->execute();
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function updateFile($id_post, $arquivo, $id_user)
  {
    try {
      $update = date('Y-m-d H:i:s');
      $sql = "UPDATE post_fix SET arquivo=:arquivo, updated_at=:update_at, id_user=:id_user WHERE id=:id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id',  $id_post);
      $sql->bindValue(':arquivo',   $arquivo);
      $sql->bindValue(':update_at',   $update);
      $sql->bindValue(':id_user', $id_user);
      $sql->execute();
    } catch (PDOException $e) {
      throw $e;
    }
  }
  /**ATUALIZA NOTICIA */
  public function updateInfo($id_post, $titulo, $corpo, $id_user)
  {
    try {
      $update = date('Y-m-d H:i:s');
      $sql = "UPDATE post_fix SET titulo=:titulo, post=:post, updated_at=:update_at, id_user=:id_user WHERE id=:id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', $id_post);
      $sql->bindValue(':titulo', $titulo);
      $sql->bindValue(':post', $corpo);
      $sql->bindValue(':update_at', $update);
      $sql->bindValue(':id_user', $id_user);
      $sql->execute();
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function getPostLimit()
  {
    try {
      $sql = "SELECT id, titulo, post, image, id_user, arquivo, status, created_at FROM post_fix WHERE post_fix.status='1' AND post_fix.fixo =0 ORDER BY id DESC LIMIT 6";
      var_dump($sql);
      $sql = $this->db->query($sql);
      if ($sql->rowCount() > 0) {
        return $sql->fetchAll(PDO::FETCH_ASSOC);
      }
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function postId($post_id)
  {
    try {
      $sql = "SELECT p.id AS id, p.titulo, p.post, p.image, p.created_at, u.username, p.setores  FROM post_fix p, users u WHERE p.id_user=u.id AND p.id='{$post_id}' LIMIT 1";
      $sql = $this->db->query($sql);
      if ($sql->rowCount() > 0) {
        return $sql->fetch(PDO::FETCH_ASSOC);
      }
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function postAll($offset, $limit)
  {
    try {
      $sql = "SELECT p.id, p.titulo, p.post, p.image, p.created_at, u.username FROM post_fix p, users u WHERE p.id_user=u.id AND p.status='1' ORDER BY p.id DESC LIMIT $offset, $limit";
      $sql = $this->db->query($sql);
      if ($sql->rowCount() > 0) {
        return $sql->fetchAll(PDO::FETCH_ASSOC);
      }
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function getTotalPosts()
  {
    $sql = "SELECT COUNT(id)AS count FROM post_fix WHERE status='1'";
    $sql = $this->db->query($sql);
    $sql = $sql->fetch();
    return $sql['count'];
  }

  public function getPostAll()
  {
    try {
      $sql = "SELECT p.id, p.fixo, p.titulo, p.post, p.image, p.arquivo, p.created_at, u.username  FROM post_fix p, users u WHERE p.id_user=u.id AND p.status=1 ";
      $sql = $this->db->query($sql);
      if ($sql->rowCount() > 0) {
        return $sql->fetchAll(PDO::FETCH_ASSOC);
      }
    } catch (PDOException $e) {
      throw $e;
    }
  }
  public function getPostByIdUser()
  {
    try {
      $sql = "SELECT DISTINCT p.id, p.titulo, p.post, p.id_user, p.status, p.fixo, p.arquivo, p.image, p.setores, u.username, p.created_at, p.updated_at
       FROM post_fix AS p INNER JOIN users AS u ON p.id_user = u.id WHERE p.id_user =".$_SESSION['info_id'];
      $sql = $this->db->query($sql);
    
      if ($sql->rowCount() > 0) {
        return $sql->fetchAll(PDO::FETCH_ASSOC);
      } else {
        return false;
      }
    } catch (PDOException $e) {
      throw $e;
    }
  }
  public function getPostId($id)
  {
    try {
      $sql = "SELECT p.id, p.titulo, p.fixo, p.post, p.image, p.setores, p.arquivo, p.created_at, u.username  FROM post_fix p, users u WHERE p.id_user=u.id AND p.id='{$id}' ORDER BY p.id DESC";
      $sql = $this->db->query($sql);
      if ($sql->rowCount() > 0) {
        return $sql->fetch(\PDO::FETCH_ASSOC);
      }
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function unlinkPost($id, $url)
  {
    try {
      $sql = "SELECT p.image AS image_post FROM post_fix p, users u WHERE p.id_user=u.id AND p.id='{$id}'";
      $sql = $this->db->query($sql);
      if ($sql->rowCount() > 0) {
        $sql = $sql->fetch();
        $url_image = $url . $sql['image_post'];
        unlink($url_image);
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function deletePost($id_post, $id_user)
  {
    try {
      $deleted_at = date('Y-m-d H:i:s');
      $sql = "UPDATE post_fix SET deleted_at=:deleted_at, id_user=:id_user, status=0 WHERE id=:id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', $id_post);
      $sql->bindValue(':deleted_at', $deleted_at);
      $sql->bindValue(':id_user', $id_user);
      $sql->execute();
    } catch (PDOException $e) {
      throw $e;
    }
  }
}
