<?php
SESSION_START();
include "./bd.php";

$id = $_SESSION['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$foto = $_FILES['foto']['name'];

// Perfil
$extensao = strtolower(substr($foto, -4));
$foto = md5(time()) . $extensao;

$diretorio = "../pag/perfis/";
move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$foto);

$query = mysqli_query($bd, "UPDATE usuarios
  set nome = '$nome', email = '$email', senha = '$senha', perfil = '$foto' WHERE id = '$id'");

// unset($_SESSION["id"]);
// unset($_SESSION["nome"]);
// unset($_SESSION["email"]);
// unset($_SESSION["cpf"]);
// unset($_SESSION["senha"]);

// header("Location: ../index.html");
?>
