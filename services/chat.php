<?php
include "../services/bd.php";

$servico = $_GET['servico'];
$profissional = $_GET['profissional'];
$consumidor = $_SESSION['id']; // Usuário logado

$query = mysqli_query($bd,
"SELECT * FROM chat
WHERE servico = '$servico'");

while($chat = mysqli_fetch_array($query))
{
  $hora = $chat['hora'];
  $hora = substr_replace($hora, 5, 4, 5);
  echo "
  <div class='mensagem-container'>
    <p class='mensagem-nome'>";
    echo "{$chat['nome']}";
    echo "
    </p>

    <div class='mensagem-hora-container'>
      <p class='mensagem'>";
      echo "{$chat['mensagem']}";
      echo "
      </p>
      <p class='mensagem-hora'>";
      echo $hora;
      echo "
      </p>
    </div>
  </div>
  ";
}
?>
