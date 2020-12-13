<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/c92ec6165d.js" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/<?= basename($_SERVER['PHP_SELF'], ".php") ?>.css">
  <title>Painel</title>
</head>

<body>
  <nav>
    <span class="logo navbar">Painel das Coisas Emprestadas</span>
    <div class="links">
      <button onclick="logout()" class="navbar"><i class="fas fa-door-open"></i></button>
    </div>
  </nav>