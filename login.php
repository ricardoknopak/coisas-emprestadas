<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/c92ec6165d.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="../css/header.css">
  <title>Painel</title>
</head>

<body>
  <?php
  include 'header.php';
  ?>
  <div class="container">
    <div class="login">
      <form id='signin_form' method="POST" action="actions.php">
        <input type="text" id="username" name="username" placeholder="Username" /><br />
        <input type="password" id="senha" name="senha" placeholder="Senha" /><br />
        <input type="hidden" name="actions" value="login" />
        <input type="submit" id="submit" value="Entrar" />
      </form>
    </div>
    <a href="singup.php">Não é participante? Cadastre-se</a>
  </div>