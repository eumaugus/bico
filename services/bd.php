<?php
$bd = mysqli_connect("localhost", "root", "", "bico");

if (mysqli_connect_error()) {
  echo "Falha na conexão".mysqli_connect_error();
}
?>
