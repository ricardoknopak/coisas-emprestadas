<?php

include 'App.php';
class Coisas extends \App\App
{
  public function __construct()
  {
    parent::__construct();
  }

  public function adicionar($nome, $descricao, $proprietario)
  {
    $cmd = $this->db->prepare("INSERT INTO coisas (nome, descricao, id_proprietario) values (:nonme, :descricao, :proprietario)");
    $cmd->bindValue(":n", $nome);
    $cmd->bindValue(":n", $descricao);
    $cmd->bindValue(":n", $proprietario);
    if (!$cmd->execute()) {
      return false;
    }
    return true;
  }

  public function adicionaCoisa($id_usuario, $nome, $descricao)
  {
    $cmd = $this->db->prepare("INSERT INTO coisas (null, '$nome', '$descricao', $id_usuario, 'L')");
    $cmd->bindValue("CONTINUA AQUI !!!!!!!!!", 0);






    $here = 12;
  }

  public function buscarTodasCoisas()
  {
    $cmd = $this->db->prepare("SELECT nome, descricao, id_proprietario FROM coisas ORDER BY nome asc");
    $cmd->execute();
    $coisas = $cmd->fetch(PDO::FETCH_ASSOC);
    return $coisas;
  }

  public function apagarCoisa($id)
  {
    $cmd = $this->db->prepare("DELETE FROM coisas WHERE id = :id");
    $cmd->bindValue(":id", $id);
    if (!$cmd->execute()) {
      return false;
    }
    return true;
  }

  public function coisasDoUsuario($id_usuario)
  {
    $cmd = $this->db->prepare("SELECT 
	            csa.id as id_coisa, csa.nome as nome_coisa, csa.descricao as descricao_coisa,
	            (SELECT u.nome from emprestimos e inner join usuarios u on u.id = e.id_locatario where e.id_coisa = csa.id
                  order by e.data_emprestimo desc limit 1) as locatario,
              (SELECT e.data_prevista_devolucao from emprestimos e inner join usuarios u on u.id = e.id_locatario where e.id_coisa = csa.id
                  order by e.data_emprestimo desc limit 1) as data_devolucao,
              if((SELECT e.status from emprestimos e inner join usuarios u on u.id = e.id_locatario where e.id_coisa = csa.id
                  order by e.data_emprestimo desc limit 1) = 'L', 'livre', 'locado') as status
              FROM coisas csa
			            INNER JOIN usuarios usu ON usu.id = csa.id_proprietario
				              WHERE usu.id = :id");

    $cmd->bindValue(":id", $id_usuario);
    $cmd->execute();
    $coisasDoUsuario = array();
    while ($row = $cmd->fetch(PDO::FETCH_ASSOC)) {
      array_push($coisasDoUsuario, $row);
    }
    return $coisasDoUsuario;
  }

  public function coisasEmprestadasPeloUsuario($id)
  {
    $cmd = $this->db->prepare("SELECT 
	    csa.id as id_coisa, csa.nome as nome_coisa, csa.descricao as descricao_coisa, usu.id as id_usuario, usu.nome as nome_usuario,
      (select date_format(e.data_emprestimo, '%d/%m/%Y') from emprestimos e where e.id_coisa = csa.id order by e.id desc limit 1) as data_emprestimo,
	    (select date_format(e.data_prevista_devolucao, '%d/%m/%Y') from emprestimos e where e.id_coisa = csa.id order by e.id desc limit 1) as data_devolucao,
	    pro.nome as proprietario,
      (select status from emprestimos e where e.id_coisa = csa.id order by e.id desc limit 1) as status
        FROM coisas csa
	        INNER JOIN emprestimos emp ON csa.id = emp.id_coisa
        		INNER JOIN usuarios usu ON usu.id = emp.id_locatario
			        INNER JOIN usuarios pro ON pro.id = csa.id_proprietario
				        WHERE usu.id = :id AND emp.status = 'E'");
    $cmd->bindValue(":id", $id);
    $cmd->execute();
    $coisasEmprestadasPeloUser = array();
    while ($row = $cmd->fetch(PDO::FETCH_ASSOC)) {
      array_push($coisasEmprestadasPeloUser, $row);
    }
    return $coisasEmprestadasPeloUser;
  }

  public function coisasDisponiveis($id_usuario)
  {
    $cmd = $this->db->prepare("SELECT csa.id as id_coisa,csa.nome as nome_coisas, csa.descricao as descricao_coisas, usu.nome as nome_proprietario
            FROM coisas csa INNER JOIN usuarios usu ON usu.id = csa.id_proprietario
              WHERE status = 'L' and csa.id_proprietario <> :id_usuario");
    $cmd->bindValue(":id_usuario", $id_usuario);
    $cmd->execute();
    $coisasDisponiveis = array();
    while ($row = $cmd->fetch(PDO::FETCH_ASSOC)) {
      array_push($coisasDisponiveis, $row);
    }
    return $coisasDisponiveis;
  }

  public function emprestarCoisas($id_coisa, $id_usuario)
  {
    $cmd_ = $this->db->prepare("UPDATE coisas SET status = 'E' WHERE id = :id");
    $cmd_->bindValue(":id", $id_coisa);
    if (!$cmd_->execute()) {
      return false;
    }
    $cmd = $this->db->prepare("INSERT INTO emprestimos (id_coisa, id_locatario, data_emprestimo, data_prevista_devolucao, status)
	          VALUES (:id_coisa, :id_usuario, curdate(), curdate() + INTERVAL 7 DAY, 'E')");
    $cmd->bindValue(":id_coisa", $id_coisa);
    $cmd->bindValue("id_usuario", $id_usuario);
    if (!$cmd->execute()) {
      return false;
    }
  }

  public function devolverCoisa($id_coisa, $usuario_id)
  {
    $cmd = $this->db->prepare("UPDATE coisas SET status = 'L' WHERE id = :id");
    $cmd->bindValue(":id", $id_coisa);
    if (!$cmd->execute()) {
      return false;
    }
    $stmt = $this->db->prepare("UPDATE emprestimos SET status = 'L', data_devolucao = NOW() WHERE id_coisa = :id_coisa and id_locatario = :usuario_id and status = 'E'");
    $stmt->bindValue(":id_coisa", $id_coisa);
    $stmt->bindValue(":usuario_id", $usuario_id);
    if (!$stmt->execute()) {
      return false;
    }
    return true;
  }
}
