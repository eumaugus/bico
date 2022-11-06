<?php
SESSION_START();
include "../services/bd.php";
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>BICO | Perfil</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- ICONES -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- RESPONSIVIDADE -->
    <meta name="viewport" content="width=width-device, initial-scale=1.0">
    <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  </head>

  <body>
    <!-- HEADER/NAVEGACAO -->
    <?php include "./parte_header.php";?>

    <!-- PERFIL -->
    <?php
    $nome = $_SESSION['nome'];
    $email = $_SESSION['email'];

    $usuarios = mysqli_query($bd,
    "SELECT * FROM usuarios WHERE nome = '$nome' and email = '$email'");

    while($usuario = mysqli_fetch_array($usuarios))
    {
      $user_nome = $usuario['nome'];
      $user_perfil = $usuario['perfil'];
      $user_email = $usuario['email'];
      $user_senha = $usuario['senha'];
    }
    ?>

    <form class="perfil-form" action="../services/alterar_usuario.php" method="post" enctype="multipart/form-data">
      <div class="perfil-conteudo">
        <div class="perfil-foto-container">
          <img src="./perfis/<?php echo $user_perfil;?>"/>
          <input id="foto" class="perfil-botao-perfil" type="file" name="foto">
          <label for="foto">
            <i class="material-icons perfil-botao-icone">camera_alt</i>
          </label>
        </div>

        <div class="perfil-campos-container">
          <button class="perfil-editar" type="button" name="button">
            <i class="material-icons">edit</i>
          </button>

          <input class="perfil-campo" type="text" name="nome" value="<?php echo $user_nome;?>" minlength="3" maxlength="49" required disabled/>

          <input class="perfil-campo" type="email" name="email" value="<?php echo $user_email;?>" minlength="8" maxlength="199" required disabled/>

          <div class="perfil-campo-senha-container">
            <input id="senha-campo" class="perfil-campo" type="password" name="senha" value="<?php echo $user_senha;?>" minlength="8" maxlength="59" required disabled/>
            <i id="senha-visao" class="perfil-campo material-icons" disabled>
              visibility
            </i>
          </div>
        </div>

        <button class="perfil-campo perfil-enviar" type="submit" name="button" disabled>Enviar</button>
      </div>
    </form>

  </body>
  <script src="../js/perfil.js"></script>
</html>
