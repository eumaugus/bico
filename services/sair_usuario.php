<?php
SESSION_START();

unset($_SESSION["id"]);
unset($_SESSION["nome"]);
unset($_SESSION["email"]);
unset($_SESSION["cpf"]);
unset($_SESSION["senha"]);

header("Location: ../index.html");
?>
