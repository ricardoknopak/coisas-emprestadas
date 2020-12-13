<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/c92ec6165d.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/signup.css">
  <link rel="stylesheet" href="../css/header.css">
  <title>Painel</title>
</head>

<body>
  <?php
  include 'header.php';
  ?>
  <div class="container">
    <div class="form-box">
      <form action="actions.php" method="post">
        <div class="formulario">
          <div class="form_line">
            <label for="nome">Nome:</label>
            <input type="text" name="name" id="nome" required />
          </div>
          <div class="form_line">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" maxlength="55" required />
          </div>
          <div class="form_line">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" maxlength="75" required />
          </div>
          <div class="form_line">
            <label for="username">Senha:</label>
            <input type="password" name="password" id="password" maxlength="25" required />
          </div>
          <div class="form_line">
            <label for="username">Repita a Senha:</label>
            <input type="password" name="password_chk" id="password_chk" maxlength="25" required />
          </div>
          <div class="last_line">
            <input type="hidden" name="actions" value="signup" />
            <button type="submit" id="send">Enviar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script>

  </script>