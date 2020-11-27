<?php
include 'Coisas.php';
include 'Usuarios.php';
include 'header.php';

$_SESSION['connected'] = true;
$_SESSION['usuario'] = $_GET['user'];

if (!isset($_SESSION['connected']) || !isset($_SESSION['usuario'])) {
  header("Location: ./login.php");
  die('redirecionando...');
}
$usuario_id = $_SESSION['usuario'];

$usuario = new Usuarios('coisas_emprestadas', 'localhost', 'root', '12mnmn 12');

$user = $usuario->getUsuario($usuario_id);

$coisas = new Coisas();

$userEmprestados = $coisas->coisasEmprestadasPeloUsuario($usuario_id);

$minhasCoisas = $coisas->coisasDoUsuario($usuario_id);

$todasCoisas = $coisas->buscarTodasCoisas();

$coisasDisponiveis = $coisas->coisasDisponiveis($usuario_id);

?>
<script src="js/script.js"></script>

<div class="container">
  <div class="panel">
    <div class="user_info">
      <!-- <span class="label">Informações do Usuário</span> -->
      <div class="info_avatar">
        <img src="<?= $user['avatar'] ?>" />
      </div>
      <div class="info-body">
        <p><?= $user['nome'] ?></p>
        <p><?= $user['descricao'] ?></p>
        <p>Usuário desde: <?= $user['data_registro'] ?></p>
      </div>
    </div>
    <div class="coisas_emprestadas">
      <span class="label">
        emprestadas <i class="fas fa-chevron-circle-down"></i>
      </span>
      <?php
      foreach ($userEmprestados as $row) {
        if ($row['id_coisa']) {
          echo "<div class='coisas-box'>";
          echo    "<span>" . $row['nome_coisa'] . " ( " .  $row['descricao_coisa'] . " )</span>";
          echo    "<span>Emprestimo: " .  $row['data_emprestimo'] . " - " . "Data Devolução: " . $row['data_devolucao'] . "</span>";
          echo    "<span>Dono: " . $row['proprietario'] . '</span>';
          echo    "<span><a href='' onclick='devolver(" . $usuario_id . "," . $row['id_coisa'] . ")'>Devolver</a></span>";
          echo "</div>";
        }
      } ?>
    </div>
    <div class="coisas_disponives">
      <span class="label">
        minha coisas <i class="fas fa-chevron-circle-up"></i>
      </span>

      <?php
      foreach ($minhasCoisas as $minhasCoisa) {
        if ($minhasCoisa['id_coisa']) {
          echo "<div class='coisas-box'>";
          echo $minhasCoisa['nome_coisa'] . '-' . $minhasCoisa['descricao_coisa'] . "<br/>";
          if ($minhasCoisa['status'] == 'locado') {
            echo "Emprestado para: " . $minhasCoisa['locatario'] . ". Devolução dia " . $minhasCoisa['data_devolucao'];
          } else {
            echo "Disponível";
          }
          echo "</div>";
        }
      } ?>

    </div>
  </div>
  <div class="shop">
    <?php foreach ($coisasDisponiveis as $coisaDisponivel) {
      echo "<div class='item'>";
      echo "<span class='icon blue'><i class='fas fa-bicycle'></i></span>";
      echo "<span class='shop-emprestar-text'>" . $coisaDisponivel['nome_proprietario'] . " tem uma " . $coisaDisponivel['nome_coisas'] . " para emprestar!</span>";
      echo "<button onclick='emprestar(" . $usuario_id . "," . $coisaDisponivel['id_coisa'] . ")'>Emprestar</button>";
      echo "</div>";
    } ?>
  </div>
</div>
</body>

</html>