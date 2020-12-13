<?php
session_start();
// use App\Usuarios\Usuarios;
// use App\Coisas\Coisas;

include_once './Usuarios.php';
include_once './Coisas.php';

include 'header.php';

if (!isset($_SESSION['connected']) && !isset($_SESSION['usuario'])) {
  header("Location: ./login.php");
  die('redirecionando...');
}
$usuario_id = $_SESSION['usuario'];

$usuario = new Usuarios();

$user = $usuario->getUsuario($usuario_id);

$coisas = new Coisas();

$userEmprestados = $coisas->coisasEmprestadasPeloUsuario($usuario_id);

$minhasCoisas = $coisas->coisasDoUsuario($usuario_id);

$todasCoisas = $coisas->buscarTodasCoisas();

$coisasDisponiveis = $coisas->coisasDisponiveis($usuario_id);

$avatarColor = Usuarios::avatarColor();

?>
<script src="js/script.js"></script>

<div class="container">
  <div class="panel">
    <div class="user_info">
      <div class="info_avatar">
        <i class="fas fa-user-astronaut user <?= $avatarColor ?>"></i>
      </div>
      <div class="info-body">
        <p>Nome: <?= $user['nome'] ?></p>
        <p>Username: <?= $user['username'] ?></p>
        <p>Email: <?= $user['email'] ?></p>
      </div>
      <div>
        <button class="abreModal" type="submit" onclick="modal(true)">Adicionar Alguma Coisa</button>
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

<div id="addCoisas" class="modal">
  <div class="addCoisas-conteudo">
    <span class="close" onclick="modal(false)">&times;</span>
    <input type="text" id="novo_nome" name="novo_nome" maxlength="25" placeholder="Digite o nome do produto" required />
    <input type="text" id="nova_descricao" name="nova_descricao" maxlength="75" placeholder="Digite a descrição do produto" required />
    <input type="hidden" id="novo_proprietario" name="novo_proprietario" value="<?= $usuario_id ?>" />
    <button type="submit" id="novo_enviar" onclick="adicionar()">Criar Alguma Coisa</button>
  </div>
</div>
</body>

</html>