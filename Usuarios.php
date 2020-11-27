<?php

class Usuarios
{
  public function __construct($dbname, $host, $usuario, $senha)
  {
    try {
      $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $usuario, $senha);
    } catch (PDOException $e) {
      echo "Erro com BD: " . $e->getMessage();
    } catch (Exception $e) {
      echo "Erro: " . $e->getMessage();
    }
  }

  public function logarUsuario($username, $password)
  {
    $cmd = $this->pdo->query("SELECT id FROM usuarios WHERE username = '$username' AND password = MD5('$password')");
    $result = $cmd->fetch(PDO::FETCH_ASSOC);
    if (empty($result['id'])) {
      header('Location: /login.php?error=1');
      return false;
    }
    $_SESSION['connected'] = true;
    $_SESSION['id_usuario'] = $result['id'];
    header('Location: /index.php');
    return false;
  }

  public function getUsuario($id)
  {
    $cmd = $this->pdo->prepare("SELECT id, nome, username, password, email, avatar, descricao,
              date_format(data_criacao, '%d/%m/%Y') as data_registro from usuarios where id = :id");
    $cmd->bindValue(":id", $id);
    $cmd->execute();
    $user = $cmd->fetch(PDO::FETCH_ASSOC);
    return $user;
  }

  public function criarUsuario($nome, $username, $password, $email, $avatar, $descricao)
  {
    $cmd = $this->pdo->prepare("INSERT INTO coisas (nome, descricao, id_proprietario) values (:nonme, :descricao, :proprietario)");
    $cmd->bindValue(":nome", $nome);
    $cmd->bindValue(":username", $username);
    $cmd->bindValue(":password", $password);
    $cmd->bindValue(":email", $email);
    $cmd->bindValue(":avatar", $avatar);
    $cmd->bindValue(":descricao", $descricao);

    if (!$cmd->execute()) {
      return false;
    }
    return true;
  }

  public function deletaUsuario($id_usuario)
  {
    $cmd = $this->pdo->prepare("DELETE FROM Usuario WHERE id = :id_usuario");
    $cmd->bindValue(":id", $id_usuario);

    if (!$cmd->execute()) {
      return false;
    }
    return true;
  }
}
