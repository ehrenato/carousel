<?php
namespace Models;
use Core\Model;

class Users extends Model
{
    private $uid;

    public function verifyLogin()
    {
        if (!empty($_SESSION['chathashlogin'])) {
            $s = $_SESSION['chathashlogin'];
            $sql = "SELECT id FROM users WHERE loginhash=:hash AND status=1";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':hash', $s);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $data = $sql->fetch();
                $this->uid = $data['id'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
        
    }

    public function validateUsername($u) {
        if (preg_match('/^[a-z0-9]+$/',$u)) {
            return true;
        } else {
            return false;
        }
    }

    public function userExists($u, $id='') {
        $sql="SELECT * FROM users WHERE username='{$u}'";
        
        if(!empty($id) && isset($id)){
            $sql .= " AND id <> '{$id}'";
        }
//var_dump($sql);exit;
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':u',$u);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function userRegister($username, $pass) {
        $passHash = \password_hash($pass, PASSWORD_DEFAULT);
        $primeiro_insert = date('Y-m-d H:i:s');
        $sql="INSERT INTO users(username, pass, status, create_at, update_at)VALUES(:user, :pass, 1, :create, :update)";
        $sql=$this->db->prepare($sql);
        $sql->bindValue(':user', $username);
        $sql->bindValue(':pass', $passHash);
        $sql->bindValue(':create', $primeiro_insert);
        $sql->bindValue(':update', $primeiro_insert);
        $sql->execute();
    }

    public function validateUser($username, $pass) {
        try {
            $sql="SELECT * FROM users WHERE username = :u";
            $sql=$this->db->prepare($sql);
            $sql->bindValue(':u', $username);
            $sql->execute();
            if($sql->rowCount() > 0){
                $info = $sql->fetch(\PDO::FETCH_ASSOC);
                if (password_verify($pass, $info['pass'])) {
                    $loginhash = md5(rand(0,9999).time().$info['id'].$info['username']);
                    $this->setLoginHash($info['id'], $loginhash);
                    $_SESSION['chathashlogin'] = $loginhash;
                    $_SESSION['info_id']=$info['id'];
                    $_SESSION['perfil']=$info['perfil'];
                    $_SESSION['setor_id']=$info['setor_id'];
                    return true;
                } else {
                    return false;
                }
            }else{
                return false;
            }
        } catch (\PDOException $error) {
                echo $error;
        }
    }

    public function getUser(){
        return $this->uid;
    }

    public function infoUser()
    {  
        try {
            if(isset($_SESSION['info_id'])){
                $sql="SELECT * FROM users WHERE id=:id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(':id',$_SESSION['info_id']);
                $sql->execute();
    
                if ($sql->rowCount() > 0) {
                    return $sql->fetch(\PDO::FETCH_ASSOC);
                } else {
                    return false;
                }
            }
        } catch (\PDOException $error) {
             echo $error->getMessage();
        }
    }

    public function updateUser($user, $pass, $id) {
        try {
            $sql="UPDATE users SET username=:user, pass=:pass, update_at=:update WHERE id=:id";
            $update = date('Y-m-d H:i:s');
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':user', $user);
            $sql->bindValue(':pass', $pass);
            $sql->bindValue(':update', $update);
            $sql->bindValue(':id', $id);
            $sql->execute();
            if($_FILES){

            }
        } catch (\PDOException $error) {
            echo $error->getMessage();
        }
    }
    private function setLoginHash($uid, $hash) { 
        try {
            $sql="UPDATE users SET loginhash=:hash WHERE id=:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':hash', $hash);
            $sql->bindValue(':id', $uid);
            $sql->execute();
        } catch (\PDOException $error) {
            echo $error->getMessage();
        }
    }
    //APAGAR IMAGENS DOS USUARIO
    public function unlinkImageUser($id, $url)
    {
        try {
            $sql = "SELECT image FROM users WHERE id='{$id}'";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                $sql = $sql->fetch();
                
                $url_historico =  $url . $sql['image'];
                unlink($url_historico);
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo "ERROR (LIST GET_ALL UNLINK)" . $e->getMessage();
        }
    }

    public function userUpagetImage($image, $id)
    {
        try {
            $sql="UPDATE users SET image=:image WHERE id=:id";
            $sql=$this->db->prepare($sql);
            $sql->bindValue(':image', $image);
            $sql->bindValue(':id', $id);
            $sql->execute();
        } catch (\PDOException $e) {
            echo "ERROR UPDATE IMG USER" . $e->getMessage();
        }
    }

    public function userUpdate($usuario, $user_id)
    {
        try {
            $sql="UPDATE users SET username=:username WHERE id=:id";
            $sql=$this->db->prepare($sql);
            $sql->bindValue(':username', $usuario);
            $sql->bindValue(':id', $user_id);
            $sql->execute();
        } catch (\PDOException $e) {
            echo "ERROR UPDATE IMG USER" . $e->getMessage();
        }
    }

    public function userUpdatePass($usuario, $senha, $user_id)
    {
        try {
            $sql="UPDATE users SET username=:username, pass=:pass WHERE id=:id";
            $sql=$this->db->prepare($sql);
            $sql->bindValue(':username', $usuario);
            $sql->bindValue(':pass', $senha);
            $sql->bindValue(':id', $user_id);
            $sql->execute();
        } catch (\PDOException $e) {
            echo "ERROR UPDATE IMG USER" . $e->getMessage();
        }
    }

    public function userList()
    {
        try {
            $sql="SELECT * FROM users WHERE deleted_at IS NULL";
            $sql=$this->db->query($sql);
           if($sql->rowCount() > 0){
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
           } else {
               return false;
           }
        } catch (\PDOException $e) {
            echo "ERROR UPDATE IMG USER" . $e->getMessage();
        }
    }

    public function userPermission()
    {
        $array = array();
        try {
            $sql="SELECT pu.id AS id_permissao,pu.id_user AS id_user FROM permissoes_usuario AS pu INNER JOIN users AS u ON u.id=pu.id_user INNER JOIN permissoes AS p ON p.id=pu.id_permissoes";
            $sql=$this->db->query($sql);
           if($sql->rowCount() > 0){
            $array['permissoes']=$sql->fetchAll(\PDO::FETCH_ASSOC);
            return  $array['permissoes'];
           } else {
               return false;
           }
        } catch (\PDOException $e) {
            echo "ERROR UPDATE IMG USER" . $e->getMessage();
        }
    }

    public function listPermission()
    {
        try {
            $sql="SELECT * FROM permissoes WHERE nome <> 'Master'";
            $sql=$this->db->query($sql);
           if($sql->rowCount() > 0){
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
           } else {
               return false;
           }
        } catch (\PDOException $e) {
            echo "ERROR LIST PERMISSIONs" . $e->getMessage();
        }
    }

    public function listUserId($id)
    {
        try {
            $sql="SELECT * FROM users WHERE id='{$id}'";
            $sql=$this->db->query($sql);
           if($sql->rowCount() > 0){
            return $sql->fetch(\PDO::FETCH_ASSOC);
           } else {
               return false;
           }
        } catch (\PDOException $e) {
            echo "ERROR LIST PERMISSIONs" . $e->getMessage();
        }
    }

    public function add($usuario, $id_user_cad, $perfis)
    {
        $passHash = \password_hash('123', PASSWORD_DEFAULT);
        $primeiro_insert = date('Y-m-d H:i:s');
        $perfisImplode = implode(',',$perfis);
        try {
            $sql="INSERT INTO users(username, pass, cadastrado_por, perfil, status, create_at, update_at)VALUES(:username, '{$passHash}', :cadastrado_por, :perfil, '1', '{$primeiro_insert}', '{$primeiro_insert}')";
            $sql=$this->db->prepare($sql);
            $sql->bindValue(':username', $usuario);
            $sql->bindValue(':cadastrado_por', $id_user_cad);
            $sql->bindValue(':perfil', $perfisImplode);
            $sql->execute();
            return true;
        } catch (\PDOException $e) {
            echo "ERROR INSERIR USUARIO" . $e->getMessage();
        }
    }

    public function edit($usuario, $perfis, $id)
    {
       try {
            $perfisImplode = implode(',',$perfis);
            $primeiro_insert = date('Y-m-d H:i:s');
            $sql="UPDATE users SET username=:username, cadastrado_por=:cadastrado_por, perfil=:perfil, status='1', update_at='{$primeiro_insert}' WHERE id=:id";
            $sql=$this->db->prepare($sql);
            $sql->bindValue(':username', $usuario);
            $sql->bindValue(':cadastrado_por', $_SESSION['info_id']);
            $sql->bindValue(':perfil', $perfisImplode);
            $sql->bindValue(':id', $id);
            $sql->execute();
       } catch (\PDOException $e) {
        echo "ERROR ATUALIZAR USUARIO" . $e->getMessage();
        exit;
       }
    }

    public function disable($id)
    {
        try {
           $primeiro_insert = date('Y-m-d H:i:s');
           $sql="UPDATE users SET deleted_at='{$primeiro_insert}' WHERE id=:id";
           $sql=$this->db->prepare($sql);
           $sql->bindValue(':id', $id);
           $sql->execute();
        } catch (\PDOException $e) {
            echo "ERROR A DELETAR USUARIO" . $e->getMessage();
            exit;
        }
    }

    public function reset_pass($id)
    {
        try {
            $primeiro_insert = date('Y-m-d H:i:s');
            $passHash = \password_hash('123', PASSWORD_DEFAULT);
            $sql="UPDATE users SET update_at='{$primeiro_insert}', pass='{$passHash}' WHERE id=:id";
            $sql=$this->db->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();
        } catch (\PDOException $e) {
            echo "ERROR RESET" . $e->getMessage();
            exit;
        }
    }
}