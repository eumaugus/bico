<?php
include "./bd.php";

$id_usuario = $_POST['id_usuario'];
$usuario = $_POST['usuario'];
$comentario = $_POST['comentario'];
$nota = $_POST['nota'];
$servico = $_POST['servico'];
$profissional = $_POST['profissional'];

$query = mysqli_query($bd,
"INSERT INTO comentarios
(id_usuario, usuario, comentario, servico, nota)
VALUES ('$id_usuario', '$usuario', '$comentario', '$servico', '$nota')");

if($query){
  echo 'sucesso';
}

header("Location: ../pag/servico.php?servico={$servico}&profissional={$profissional}");
?>
