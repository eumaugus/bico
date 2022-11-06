<?php
include "./bd.php";
SESSION_START();

if(!isset($_SESSION['email']) || !isset($_SESSION['senha']))
{
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $cpf = $_POST['cpf'];
  $senha = $_POST['senha'];

  if($nome != "" && $email != "" && $cpf != "" && $senha != "")
  {
    mysqli_query($bd, "INSERT INTO usuarios (nome, email, cpf, senha) VALUES ('$nome', '$email', '$cpf', '$senha')");
    header('location: ../index.html');
  }
} else
  {
    // header('location: ../pag/registrar.html');
    echo "<script>
      window.alert('');
    </script>";

  }
?>
