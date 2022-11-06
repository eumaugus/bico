<?php
include "./bd.php";
SESSION_START();

$anuncio = $_POST['anuncio'];
$ilustracao = $_FILES['ilustracao']['name'];
$ilustracao_temp = $_FILES['ilustracao']['type'];
$descricao = $_POST['descricao'];
$categoria = $_POST['categoria'];
$uf = $_POST['uf'];
$data = date('Y/m/d');

// Ilustração
if(isset($_FILES['ilustracao']))
{
  $extensao = strtolower(substr($_FILES['ilustracao']['name'], -4));
  $ilustracao = md5(time()) . $extensao;

  $diretorio = "../pag/anuncios/";
  move_uploaded_file($_FILES['ilustracao']['tmp_name'], $diretorio.$ilustracao);
}

$email = $_SESSION['email'];
$id = mysqli_query($bd, "SELECT id FROM usuarios WHERE email = '$email'");
while($dado = mysqli_fetch_array($id))
{
  $id_usuario = $dado['id'];
}

$query = mysqli_query($bd, "INSERT INTO anuncios (anuncio, ilustracao, descricao, estado, data, id_usuario, categoria) values ('$anuncio', '$ilustracao', '$descricao', '$uf', '$data', '$id_usuario', '$categoria')");

// Verifica se o insert deu erro.
if(!$query){echo 'Erro no INSERT';}

if($anuncio != "" && $ilustracao != "" && $descricao != "" && $uf != "")
{
  header("Location: ../pag/meus-anuncios.php");
} else
  {
    echo "Preecha todos os campos.";
  }
