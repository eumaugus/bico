<?php
include "./bd.php";

$id = $_GET['id_anuncio'];
$anuncio = $_POST['anuncio'];
$descricao = $_POST['descricao'];
$uf = $_POST['uf'];
$categoria = $_POST['categoria'];
$data = date('Y/m/d');

// Ilustração
if(isset($_FILES['ilustracao']))
{
  $extensao = strtolower(substr($_FILES['ilustracao']['name'], -4));
  $ilustracao = md5(time()) . $extensao;

  $diretorio = "../pag/anuncios/";
  move_uploaded_file($_FILES['ilustracao']['tmp_name'], $diretorio.$ilustracao);
}

mysqli_query($bd, "UPDATE anuncios set anuncio = '$anuncio',
  ilustracao = '$ilustracao',
  descricao = '$descricao',
  estado = '$uf',
  data = '$data',
  categoria = '$categoria'
  WHERE id_anuncio = $id");
header("Location: ../pag/meus-anuncios.php");
?>
