<?php
SESSION_START();
include "../services/bd.php";

$profissional = $_POST['profissional'];
$consumidor = $_POST['consumidor'];
$nome = $_POST['nome'];
$mensagem = $_POST['mensagem'];
$servico = $_POST['servico'];


date_default_timezone_set('America/Sao_Paulo');
$hora = date('H:i');

$query = mysqli_query($bd,
"INSERT INTO chat (profissional, consumidor, nome, mensagem, hora, servico)
VALUES ('$profissional', '$consumidor', '$nome', '$mensagem', '$hora', '$servico')");

if ($query)
  echo 'sucesso';
header("location: ../pag/servico.php?servico={$servico}&profissional={$profissional}");
?>
