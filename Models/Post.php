<?php

namespace Models;

use Core\Model;
use PDO;
use PDOException;

class Post extends Model
{
    public function add($titulo, $subtitulo, $corpo, $id_user, $setores)
    {
        try {
            $primeiro_insert = date('Y-m-d H:i:s');
            $sql = "INSERT INTO posts(titulo, subtitulo, post, image, id_user, setores, create_at, update_at)VALUES(:titulo, :subtitulo, :post, :image, :id_user,:setores , :create_at, :update_at)";
            $img = 'assets/imagens/default.jpg';
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':titulo', $titulo);
            $sql->bindValue(':subtitulo', $subtitulo);
            $sql->bindValue(':post', $corpo);
            $sql->bindValue(':image', $img);
            $sql->bindValue(':setores', $setores);
            $sql->bindValue(':id_user', $id_user);
            $sql->bindValue(':create_at', $primeiro_insert);
            $sql->bindValue(':update_at', $primeiro_insert);
            $sql->execute();

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo "ERROR (POST ADD)" . $e->getMessage();
        }
    }

    /**UPDATE DA IMAGEN DO CAROUSEL */
    public function updateImg($id_post, $img, $id_user)
    {
        try {
            $update = date('Y-m-d H:i:s');

            $sql = "UPDATE posts SET image=:image, update_at=:update_at, id_user=:id_user WHERE id=:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id',  $id_post);
            $sql->bindValue(':image',   $img);
            $sql->bindValue(':update_at',   $update);
            $sql->bindValue(':id_user', $id_user);
            $sql->execute();
        } catch (PDOException $e) {
            echo "ERROR (UPDATE IMG)" . $e->getMessage();
        }
    }

    public function updateFile($id_post, $arquivo, $id_user)
    {
        try {
            $update = date('Y-m-d H:i:s');
            $sql = "UPDATE posts SET arquivo=:arquivo, update_at=:update_at, id_user=:id_user WHERE id=:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id',  $id_post);
            $sql->bindValue(':arquivo',   $arquivo);
            $sql->bindValue(':update_at',   $update);
            $sql->bindValue(':id_user', $id_user);
            $sql->execute();
        } catch (PDOException $e) {
            echo "ERROR (UPDATE IMG)" . $e->getMessage();
        }
    }
    /**ATUALIZA NOTICIA */
    public function updateInfo($id_post, $titulo, $subtitulo, $corpo, $id_user)
    {
        try {
            $update = date('Y-m-d H:i:s');
            $sql = "UPDATE posts SET titulo=:titulo, subtitulo=:subtitulo, post=:post, update_at=:update_at, id_user=:id_user WHERE id=:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id', $id_post);
            $sql->bindValue(':titulo', $titulo);
            $sql->bindValue(':subtitulo', $subtitulo);
            $sql->bindValue(':post', $corpo);
            $sql->bindValue(':update_at', $update);
            $sql->bindValue(':id_user', $id_user);
            $sql->execute();
        } catch (PDOException $e) {
            echo "ERROR (UPDATE DADOS)" . $e->getMessage();
        }
    }

    public function getPostLimit()
    {
        try {
            $sql = "SELECT id, titulo, subtitulo, post, image, id_user, arquivo, status, create_at FROM posts WHERE posts.status='1' ORDER BY id DESC LIMIT 6";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo "ERROR (LIST GET_ALL)" . $e->getMessage();
        }
    }

    public function postId($post_id)
    {
        try {
            $sql = "SELECT p.id AS id, p.titulo, p.subtitulo, p.post, p.image, p.create_at, u.username, p.setores  FROM posts p, users u WHERE p.id_user=u.id AND p.id='{$post_id}' LIMIT 1";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return $sql->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo "ERROR (LIST GET_ID)" . $e->getMessage();
        }
    }

    public function postAll($offset, $limit)
    {
        try {
            $sql = "SELECT p.id, p.titulo, p.subtitulo, p.post, p.image, p.create_at, u.username FROM posts p, users u WHERE p.id_user=u.id AND p.status='1' ORDER BY p.id DESC LIMIT $offset, $limit";

            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo "ERROR (LIST GET_ALL)" . $e->getMessage();
        }
    }

    public function getTotalPosts()
    {
        $sql = "SELECT COUNT(id)AS count FROM posts WHERE status='1'";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();
        return $sql['count'];
    }

    public function getPostAll()
    {
        try {
            $sql = "SELECT p.id, p.fixo, p.titulo, p.subtitulo, p.post, p.image, p.arquivo, p.create_at, u.username  FROM posts p, users u WHERE p.id_user=u.id AND p.status=1 ORDER BY p.id DESC";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo "ERROR (LIST POST_ALL)" . $e->getMessage();
        }
    }

    public function getPostId($id)
    {
        try {
            $sql = "SELECT p.id, p.titulo, p.subtitulo, p.fixo, p.post, p.image, p.setores, p.arquivo, p.create_at, u.username  FROM posts p, users u WHERE p.id_user=u.id AND p.id='{$id}' ORDER BY p.id DESC";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return $sql->fetch(\PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo "ERROR (POST_ID)" . $e->getMessage();
        }
    }

    public function unlinkPost($id, $url)
    {
        try {
            $sql = "SELECT p.image AS image_post FROM posts p, users u WHERE p.id_user=u.id AND p.id='{$id}'";
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
            echo "ERROR (LIST GET_ALL UNLINK)" . $e->getMessage();
        }
    }

    public function deletePost($id_post, $id_user)
    {
        try {
            $deleted_at = date('Y-m-d H:i:s');
            $sql = "UPDATE posts SET deleted_at=:deleted_at, id_user=:id_user, status=0 WHERE id=:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id', $id_post);
            $sql->bindValue(':deleted_at', $deleted_at);
            $sql->bindValue(':id_user', $id_user);
            $sql->execute();
        } catch (PDOException $e) {
            echo "ERROR (UPDATE DADOS)" . $e->getMessage();
        }
    }
}
