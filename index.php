<?php

include 'header.php';
include 'functions.php';
$_SESSION['connected'] = true;
$_SESSION['usuario'] = 4;
if (!isset($_SESSION['connected']) || !isset($_SESSION['usuario'])) {
  header("Location: ./login.php");
  die('redirecionando...');
}

$usuario_id = $_SESSION['usuario'];

$user = getUser($usuario_id);
$userEmprestados = getUserEmprestimos($usuario_id);
$minhasCoisas = getMinhasCoisas($usuario_id);

?>

<div class="container">
  <div class="panel">
    <div class="user_info">
      <!-- <span class="label">Informações do Usuário</span> -->
      <div class="info_avatar">
        <img src="<?= $user[0]['avatar'] ?>" />
      </div>
      <div class="info-body">
        <p><?= $user[0]['nome'] ?></p>
        <p><?= $user[0]['descricao'] ?></p>
        <p>Usuário desde: <?= $user[0]['data_registro'] ?></p>
      </div>
    </div>
    <div class="coisas_emprestadas">
      <span class="label">
        emprestadas <i class="fas fa-chevron-circle-down"></i>
      </span>
      <ul>
        <?php
        for ($i = 0; $i < count($userEmprestados); $i++) {
          if ($userEmprestados[$i]['id_coisa']) {
            echo "<li>";
            echo $userEmprestados[$i]['nome_coisa'] . " ( " .  $userEmprestados[$i]['descricao_coisa'] . " ) <br/>";
            echo "Emprestimo: " .  $userEmprestados[$i]['data_emprestimo'] . " - " . "Data Devolução: " . $userEmprestados[$i]['data_devolucao'] . "<br/>";
            echo "Dono: " . $userEmprestados[$i]['proprietario'];
            echo "</li>";
          }
        } ?>
        </li>
      </ul>
    </div>
    <div class="coisas_disponives">
      <span class="label">
        minha coisas <i class="fas fa-chevron-circle-up"></i>
      </span>
      <ul>
        <?php
        for ($i = 0; $i < count($minhasCoisas); $i++) {
          if ($minhasCoisas[$i]['id_coisa']) {
            echo "<li>";
            echo $minhasCoisas[$i]['nome_coisa'] . '-' . $minhasCoisas[$i]['descricao_coisa'] . "<br/>";
            if ($minhasCoisas[$i]['status'] == 'E') {
              echo "Emprestado para: " . $minhasCoisas[$i]['nome_locatario'] . ", dia " . $minhasCoisas[$id]['data_emprestimo'] . " (Data Devolução) " . $minhasCoisas[$i]['data_previsao_devolucao'];
            } else {
              echo "Disponível";
            }
          }
        } ?>
      </ul>
    </div>
  </div>
  <div class="shop">
    <div class="item">
      <span class="icon blue"><i class="fas fa-bicycle"></i></span>
      <span class="shop-emprestar-text"><?= $coisasDisponiveis[$i]['nome_proprietario'] ?> tem uma <?= $coisasDisponiveis[$i]['nome_proprietario'] ?> para emprestar!</span>
      <button onclick="emprestar(<?= $usuario_id ?>, <?= $coisa_id ?>)">Emprestar</button>
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
      <span class="shop-emprestar-text">D. Foster Wallace tem uma camiseta para emprestar</span>
      <button>Emprestar</button>
    </div>
  </div>
</div>
</body>

</html>