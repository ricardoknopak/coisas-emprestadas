<?php

session_start();

use App\App;

include_once './Usuarios.php';
include_once './Coisas.php';

$actions = $_POST['actions'];

if ($actions == 'login') {
  $username = $_POST['username'];
  $senha = $_POST['senha'];

  $usuario = new Usuarios();
  $result = $usuario->logarUsuario($username, $senha);

  if (!$result) {
    echo "<script>window.location.href='login.php?error=1'</script>";
    exit;
  }
  $_SESSION['connected'] = true;
  $_SESSION['usuario'] = $result;
  echo "<script>window.location.href='index.php'</script>";
  exit;
}

if ($actions == 'signup') {
  $stop = 'here';
  $nome = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  $cmd = new Usuarios();
  $result = $cmd->criarUsuario($nome, $username, $password, $email);
  if (!$result) {
    App::response(array("message", "error"));
  }
  echo "<script>window.location.href='login.php'</script>";
  exit;
}

if ($actions == 'ADICIONAR') {
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $id_usuario = $_POST['id_usuario'];

  $coisa_nova = new Coisas();
  $coisa_nova->adicionaCoisa($id_usuario, $nome, $descricao);
  if (!$coisa_nova) {
    App::response(array("message", "algo errado ocorreu"));
  }
  App::response(array("message", "success"));
}

if ($actions == 'DEVOLVER') {
  $id_coisa = $_POST['id_coisa'];
  $usuario_id = $_POST['usuario_id'];

  $coisas_devolucao = new Coisas();
  $coisas_devolucao->devolverCoisa($id_coisa, $usuario_id);
  if (!$coisas_devolucao) {
    App::response(array("message", "algo errado ocorreu"));
  }
  App::response(array("message", "success"));
}

if ($actions == 'EMPRESTAR') {
  $id_coisa = $_POST['id_coisa'];
  $usuario_id = $_POST['usuario_id'];

  $coisas_emprestar = new Coisas();
  $coisas_emprestar->emprestarCoisas($id_coisa, $usuario_id);
  if (!$coisas_emprestar) {
    App::response(array("message", "algo errado ocorreu"));
  }
  App::response(array("message", "success"));
}

if ($actions  == 'logout') {
  $stop = 'here';
  session_destroy();
  header("Location:login.php");
  App::response(array("message", "success"));
}
