<?php

include './config/db.php';

function getUser($id)
{
  try {
    $conn = new PDO('mysql:host=localhost;dbname=coisas_emprestadas', 'root', '12mnmn 12');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
  $stmt = $conn->prepare("SELECT id, nome, username, password, email, avatar, descricao, data_criacao
              from usuarios where id = :id");
  $stmt->execute(array('id' => $id));

  $user = array();
  while ($row = $stmt->fetch()) {
    array_push($user, $row);
  }
  return $user;
}
