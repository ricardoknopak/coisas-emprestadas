<?php
$stop = 'here';
$username = $_POST['username'];
$password = $_POST['password'];
try {
  $conn = new PDO('mysql:host=localhost;dbname=coisas_emprestadas', 'root', '12mnmn 12');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
}
$query = $conn->query("SELECT id FROM usuarios WHERE username = '$username' AND password = MD5('$password')");
$result = $query->fetch(PDO::FETCH_ASSOC);
if (empty($result['id'])) {
  echo "<script>location.href = './login.php?error=1'</script>";
}
$_SESSION['connected'] = true;
$_SESSION['usuario'] = $result['id'];
echo "<script>location.href = './index.php'</script>";
