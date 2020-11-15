<?php

function getUser($id)
{
  include_once('./config/db.php');

  $stmt = $conn->prepare("SELECT id, nome, username, password, email, avatar, descricao, date_format(data_criacao, '%d/%m/%Y') as data_registro
              from usuarios where id = :id");
  $stmt->execute(array('id' => $id));

  $user = array();
  while ($row = $stmt->fetch()) {
    array_push($user, $row);
  }
  return $user;
}

function getUserEmprestimos($id)
{
  try {
    $conn = new PDO('mysql:host=localhost;dbname=coisas_emprestadas', 'root', '12mnmn 12');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
  $query = $conn->prepare("SELECT
                c.id as id_coisa, c.nome as nome_coisa, c.descricao as descricao_coisa,
                  date_format(e.data_emprestimo, '%d/%m/%Y') as data_emprestimo, 
                  date_format(e.data_prevista_devolucao, '%d/%m/%Y') as data_devolucao,
                  e.status as status, u.id as id_proprietario, u.nome as proprietario
              FROM emprestimos e
                inner join coisas c on c.id = e.id_coisa
                  inner join usuarios u on u.id = c.id_proprietario
              WHERE e.id_locatario = :id and status = 'E'");

  $query->execute(array('id' => $id));

  $userEmprestados = array();
  while ($row = $query->fetch()) {
    array_push($userEmprestados, $row);
  }
  return $userEmprestados;
}
