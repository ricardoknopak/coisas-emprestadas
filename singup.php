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
      <form action="signup.php" method="post">
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
            <button type="submit" id="send">Enviar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script>
    function signup() {
      let name = document.querySelector("#name").nodeValue
      let username = document.querySelector("#username").nodeValue
      let password = document.querySelector("#password").nodeValue
      let password_chk = document.querySelector("#password_chk").nodeValue
      let email = document.querySelector("#email").nodeValue
      let send = document.querySelector("#send")

      send.addEventListener('click', function(event) {
        event.preventDefault()
        if (password != password_chk) {
          alert("A confirmação da senha é diferente da senha digitada")
          return false
        }
        let data = new FormData()
        data.append('name', name)
        date.append('username', username)
        date.append('password', password)
        date.append('email', email)
        date.append('action', 'singup')
        fetch('./actions.php', {
            method: 'POST',
            body: data
          })
          .then(response => response.json())
          .then(res => {
            console.log(res.message);
            location.reload();
            return true
          })
      })
    }
  </script>