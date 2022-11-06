<?php
include "./bd.php";
SESSION_START();

$email = $_POST['email'];
$senha = $_POST['senha'];

if(!isset($_SESSION['email']) || !isset($_SESSION['senha']))
{
  $usuarios = mysqli_query($bd, "SELECT * FROM usuarios");
  while($usuario = mysqli_fetch_array($usuarios))
  {
    $temp_email = $usuario['email'];
    $temp_senha = $usuario['senha'];

    if($temp_email == $email && $temp_senha == $senha)
    {
      $usuario = mysqli_query($bd, "SELECT * FROM usuarios WHERE email = '$email'");
      while($info = mysqli_fetch_array($usuario))
      {
        $_SESSION['id'] = $info['id'];
        $_SESSION['nome'] = $info['nome'];
        $_SESSION['email'] = $info['email'];
        $_SESSION['cpf'] = $info['cpf'];
        $_SESSION['senha'] = $info['senha'];
      }

      header("location: ../pag/home.php");
    }
    else
      {
        // header("location: ../pag/entrar.html");
      }
  }
} else
  {
    unset($_SESSION['id']);
    unset($_SESSION['nome']);
    unset($_SESSION['email']);
    unset($_SESSION['cpf']);
    unset($_SESSION['senha']);
    header("location: ../pag/entrar.html");
  }
?>
