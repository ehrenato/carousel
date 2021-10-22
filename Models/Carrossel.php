<?php

namespace Models;

use Core\Model;
use PDO;
use PDOException;

class Carrossel extends Model
{
    //Número de argumentos para o controller
    public function add($titulo, $id_user)
    {
        try {
            $primeiro_insert = date('Y-m-d H:i:s');
            $sql = "INSERT INTO carrossel(titulo, image, id_user, create_at, update_at)VALUES(:titulo, :image, :id_user, :create_at, :update_at)";
            $img = 'assets/imagens/default.jpg';
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':titulo', $titulo);
            $sql->bindValue(':image', $img);
            $sql->bindValue(':id_user', $id_user);
            $sql->bindValue(':create_at', $primeiro_insert);
            $sql->bindValue(':update_at', $primeiro_insert);
            $sql->execute();

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo "ERROR (POST ADD)" . $e->getMessage();
        }
    }

    /**UPDATE DA IMAGEM DO CAROUSEL */
    public function updateImg($id_carrossel, $img, $id_user)
    {
        try {
            $update = date('Y-m-d H:i:s');

            $sql = "UPDATE carrossel SET image=:image, update_at=:update_at, id_user=:id_user WHERE id=:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id',  $id_carrossel);
            $sql->bindValue(':image',   $img);
            $sql->bindValue(':update_at',   $update);
            $sql->bindValue(':id_user', $id_user);
            $sql->execute();
        } catch (PDOException $e) {
            echo "ERROR (UPDATE IMG)" . $e->getMessage();
        }
    }

    public function updateFile($id_carrossel, $arquivo, $id_user)
    {
        try {
            $update = date('Y-m-d H:i:s');
            $sql = "UPDATE carrossel SET arquivo=:arquivo, update_at=:update_at, id_user=:id_user WHERE id=:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id',  $id_carrossel);
            $sql->bindValue(':arquivo',   $arquivo);
            $sql->bindValue(':update_at',   $update);
            $sql->bindValue(':id_user', $id_user);
            $sql->execute();
        } catch (PDOException $e) {
            echo "ERROR (UPDATE IMG)" . $e->getMessage();
        }
    }
    /**ATUALIZA NOTICIA */
    public function updateInfo($id_carrossel, $titulo, $id_user)
    {
        try {
            $update = date('Y-m-d H:i:s');
            $sql = "UPDATE carrossel SET titulo=:titulo, update_at=:update_at, id_user=:id_user WHERE id=:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id', $id_carrossel);
            $sql->bindValue(':titulo', $titulo);
            $sql->bindValue(':update_at', $update);
            $sql->bindValue(':id_user', $id_user);
            $sql->execute();
        } catch (PDOException $e) {
            echo "ERROR (UPDATE DADOS)" . $e->getMessage();
        }
    }

    public function getCarrosselLimit()
    {
        try {
            $sql = "SELECT id, titulo, image, id_user, arquivo, status, create_at FROM carrossel WHERE carrossel.status='1' ORDER BY id DESC LIMIT 6";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo "ERROR (LIST GET_ALL)" . $e->getMessage();
        }
    }

    public function carrosselId($carrossel_id)
    {
        try {
            $sql = "SELECT c.id AS id, c.titulo, c.image, c.create_at, u.username, FROM carrossel c, users u WHERE c.id_user=u.id AND c.id='{$carrossel_id}' LIMIT 1";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return $sql->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo "ERROR (LIST GET_ID)" . $e->getMessage();
        }
    }

    public function carrosselAll($offset, $limit)
    {
        try {
            $sql = "SELECT c.id, c.titulo, c.image, c.create_at, u.username FROM carrossel c, users u WHERE c.id_user=u.id AND c.status='1' ORDER BY c.id DESC LIMIT $offset, $limit";

            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo "ERROR (LIST GET_ALL)" . $e->getMessage();
        }
    }

    public function getTotalCarrossel()
    {
        $sql = "SELECT COUNT(id)AS count FROM carrossel WHERE status='1'";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();
        return $sql['count'];
    }

    public function getCarrosselAll()
    {
        try {
            $sql = "SELECT c.id, c.fixo, c.titulo, c.image, c.arquivo, c.create_at, u.username  FROM carrossel c, users u WHERE c.id_user=u.id AND c.status=1 ORDER BY c.id DESC";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo "ERROR (LIST POST_ALL)" . $e->getMessage();
        }
    }

    public function getCarrosselId($id)
    {
        try {
            $sql = "SELECT c.id, c.titulo, c.fixo, c.image, c.arquivo, c.create_at, u.username  FROM carrossel c, users u WHERE c.id_user=u.id AND c.id='{$id}' ORDER BY c.id DESC";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return $sql->fetch(\PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo "ERROR (POST_ID)" . $e->getMessage();
        }
    }

    public function unlinkCarrossel($id, $url)
    {
        try {
            $sql = "SELECT c.image AS image_carrossel FROM carrossel c, users u WHERE c.id_user=u.id AND c.id='{$id}'";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                $sql = $sql->fetch();
                $url_image = $url . $sql['image_carrossel'];
                unlink($url_image);
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR (LIST GET_ALL UNLINK)" . $e->getMessage();
        }
    }

    public function deleteCarrossel($id_carrossel, $id_user)
    {
        try {
            $deleted_at = date('Y-m-d H:i:s');
            $sql = "UPDATE carrossel SET deleted_at=:deleted_at, id_user=:id_user, status=0 WHERE id=:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id', $id_carrossel);
            $sql->bindValue(':deleted_at', $deleted_at);
            $sql->bindValue(':id_user', $id_user);
            $sql->execute();
        } catch (PDOException $e) {
            echo "ERROR (UPDATE DADOS)" . $e->getMessage();
        }
    }
}
