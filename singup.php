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
  <div class="container_">
    <div class="form-box">
      <form action="signup.php" method="post">
        <div class="formulario">
          <div class="form_line">
            <label for="nome">Nome:</label>
            <input type="text" name="name" id="nome" required />
          </div>
          <div class="form_line">
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" name="last_name" id="sobrenome" required />
          </div>
          <div class="form_line">
            <label for="endereco">Endereço:</label>
            <input type="text" name="address" id="endereco" required />
          </div>
          <div class="form_line">
            <label for="numero">Número:</label>
            <input type="text" name="number" id="numero" maxlength="6" pattern="[0-9]" required />
          </div>
          <div class="form_line">
            <label for="phone">Telefone:</label>
            <input type="text" name="phone" id="telefon" maxlength="11" pattern="[0-9]" required />
          </div>
          <div class="form_line">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required />
          </div>
          <div class="form_line">
            <label for="accept">Concorda com os<br />termos de uso do site? </label>
            <input type="checkbox" name="accept" id="aceitar">
          </div>
          <div class="last_line">
            <button type="submit">Enviar</button>
          </div>
        </div>
      </form>
    </div>
  </div>