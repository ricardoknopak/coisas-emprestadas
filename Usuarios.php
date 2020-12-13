<?php

// namespace App\Usuarios;

include_once 'App.php';

class Usuarios extends \App\App
{
  public function __construct()
  {
    parent::__construct();
  }

  public function logarUsuario($username, $password)
  {
    $cmd = $this->db->query("SELECT id FROM usuarios WHERE username = '$username' AND password = MD5('$password')");
    $result = $cmd->fetch(PDO::FETCH_ASSOC);
    if (empty($result['id'])) {
      return false;
    }
    return $result['id'];
  }

  public function getUsuario($id)
  {
    $cmd = $this->db->prepare("SELECT id, nome, username, password, email,
              date_format(data_criacao, '%d/%m/%Y') as data_registro from usuarios where id = :id");
    $cmd->bindValue(":id", $id);
    $cmd->execute();
    $user = $cmd->fetch(PDO::FETCH_ASSOC);
    return $user;
  }

  public function criarUsuario($nome, $username, $password, $email)
  {
    $cmd = $this->db->prepare("INSERT INTO usuarios VALUES (null, '$nome', '$username', md5('$password'), '$email', NOW())");
    $cmd->bindValue(':nome', $nome);
    $cmd->bindValue(':username', $username);
    $cmd->bindValue(':password', $password);
    $cmd->bindValue(':email', $email);

    if (!$cmd->execute()) {
      return false;
    }
    return true;
  }

  public function deletaUsuario($id_usuario)
  {
    $cmd = $this->db->prepare("DELETE FROM Usuario WHERE id = :id_usuario");
    $cmd->bindValue(":id", $id_usuario);

    if (!$cmd->execute()) {
      return false;
    }
    return true;
  }

  public static function avatarColor()
  {
    $color = mt_rand(1, 5);
    switch ($color) {
      case '1':
        $colorName = 'blue';
        break;
      case '2':
        $colorName = 'red';
        break;
      case '3':
        $colorName = 'green';
        break;
      case '4':
        $colorName = 'black';
        break;
      case '5':
        $colorName = 'purple';
        break;
      default:
        $colorName = 'orange';
        break;
    }
    return $colorName;
  }
}
