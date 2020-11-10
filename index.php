<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/c92ec6165d.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/index.css">
  <title>Painel</title>
</head>

<body>
  <?php
  include 'header.php';
  ?>
  <div class="container">
    <div class="panel">
      <div class="user_info">
        <!-- <span class="label">Informações do Usuário</span> -->
        <div class="info_avatar">
          <img src="http://placekitten.com/g/80/80" />
        </div>
        <div class="info-body">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
            ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
            in voluptate velit esse cillum dolore eu</p>
        </div>
      </div>
      <div class="coisas_emprestadas">
        <span class="label">
          emprestadas <i class="fas fa-chevron-circle-down"></i>
        </span>
        <ul>
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</li>
          <li>eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
          <li>d minim veniam, quis nostrud exercitation ullamco laboris nisi ut</li>
        </ul>
      </div>
      <div class="coisas_disponives">
        <span class="label">
          para emprestar <i class="fas fa-chevron-circle-up"></i>
        </span>
        <ul>
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</li>
          <li>eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
          <li>d minim veniam, quis nostrud exercitation ullamco laboris nisi ut</li>
        </ul>
      </div>
      <div class="notifications">
        <span class="label">
          notificações <i class="fas fa-info-circle"></i>
        </span>
        <ul>
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</li>
          <li>eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
          <li>d minim veniam, quis nostrud exercitation ullamco laboris nisi ut</li>
        </ul>
      </div>
    </div>
    <div class="shop">
      <div class="item">
        <span class="icon blue"><i class="fas fa-bicycle"></i></span>
        <span class="shop-emprestar-text">Garcia Márques tem uma biclicleta para emprestar!</span>
        <button>Emprestar</button>
      </div>
      <div class="item">
        <span class="icon orange"><i class="fas fa-football-ball"></i></span>
        <span class="shop-emprestar-text">Elena Ferrante tem uma bola de futebol americano para emprestar</span>
        <button>Emprestar</button>
      </div>
      <div class="item">
        <span class="icon red"><i class="fas fa-bed"></i></span>
        <span class="shop-emprestar-text">Karl Ove tem uma cama para emprestar</span>
        <button>Emprestar</button>
      </div>
      <div class="item">
        <span class="icon green"><i class="fas fa-tshirt"></i></span>
        <span class="shop-emprestar-text">D. Foster Wsllace tem uma camiseta para emprestar</span>
        <button>Emprestar</button>
      </div>
    </div>
  </div>
</body>

</html>