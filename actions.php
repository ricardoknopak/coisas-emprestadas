<?php

use App\App;

include "./Coisas.php";
$actions = $_POST['actions'];
$id_coisa = $_POST['id_coisa'];
$usuario_id = $_POST['usuario_id'];

if ($actions == 'DEVOLVER') {
  $coisas_devolucao = new Coisas('coisas_emprestadas', 'localhost', 'root', '12mnmn 12');
  $coisas_devolucao->devolverCoisa($id_coisa, $usuario_id);
  return true;
}

if ($actions == 'EMPRESTAR') {
  $coisas_emprestar = new Coisas('coisas_emprestadas', 'localhost', 'root', '12mnmn 12');
  $coisas_emprestar->emprestarCoisas($id_coisa, $usuario_id);
  if ($coisas_emprestar) {
    App::response(array("message", "success"));
  }
  return true;
}
if ($action == 'singup') {
}
