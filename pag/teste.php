<?php
include "../services/bd.php";

$query = mysqli_query($bd,
"SELECT usuarios.id, anuncios.id_anuncio
FROM usuarios
right JOIN anuncios
ON usuarios.id = anuncios.id_anuncio");

if(!mysqli_num_rows($query) > 0)
  echo "erro";

while($dados = mysqli_fetch_assoc($query))
{
  echo $dados["id"]."<br>";
  echo $dados["id_usuario"]."<br>";
}
