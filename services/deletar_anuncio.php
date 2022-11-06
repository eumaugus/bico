<?php
include "./bd.php";

$id = $_GET['id_anuncio'];
mysqli_query($bd, "DELETE FROM anuncios WHERE id_anuncio = $id");
header("Location: ../pag/meus-anuncios.php");
?>
