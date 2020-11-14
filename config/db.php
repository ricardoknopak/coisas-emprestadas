<?php
try {
  $conn = new PDO('mysql:host=localhost;dbname=coisas_emprestadas', 'root', '12mnmn 12');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
}
