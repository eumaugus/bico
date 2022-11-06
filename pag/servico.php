<?php
SESSION_START();
include "../services/bd.php";

// Oculta erros do PHP
error_reporting(0);
ini_set("display_errors", 1 );

// Dados de sessão
$usuario = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>BICO | Serviços</title>
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

    <main>
      <?php
      $servico = $_GET['servico'];
      $profissional = $_GET['usuario'];
      $consumidor = $_GET['consumidor'];

      $query = mysqli_query($bd,
      "SELECT usuarios.nome, usuarios.perfil, anuncios.id_anuncio
      FROM usuarios
      INNER JOIN anuncios
      ON usuarios.id = anuncios.id_usuario
      WHERE anuncios.id_anuncio = '$servico'");

      if(!mysqli_num_rows($query) > 0)
        echo "Nenhum resultado encontrado.";

      while($dados = mysqli_fetch_assoc($query))
      {
        $nome = $dados['nome'];
        $foto = $dados['perfil'];
      }
      ?>
      <div class='bico-container'>
        <!-- Perfil -->
        <div class='bico-perfil-container'>
          <img src='./perfis/<?php echo $foto;?>' alt='Foto de perfil de <?php echo $nome;?>'/>
        </div>
        <p class='bico-subtitulo nome'><?php echo $nome;?></p>

        <!-- Nota de serviço -->
        <?php
        $nota_media = mysqli_query($bd,
        "SELECT avg(nota) FROM comentarios
        WHERE servico = '$servico'");

        while($nota = mysqli_fetch_assoc($nota_media))
        {
          $nota_final = round($nota["avg(nota)"], 1);
        }

        ?>
        <p class='bico-subtitulo'>Nota de serviço:
          <?php
          // Usado para a mensagem caso o serviço ainda não possui avaliações
          // O valor é referente a query anterior
          $nota = mysqli_query($bd,
          "SELECT nota FROM comentarios
          WHERE servico = '$servico'");

          if(mysqli_num_rows($nota) < 1)
            echo "
            <span class='nota-mensagem'>Ainda não possui avaliação.</span>";
          else
            echo "<b class='bico-subtitulo nota'>$nota_final/5</b>";
          ?>
          <hr class="separador"/>

        <!-- Chat -->
        <p class='bico-subtitulo'>Chat</p>
        <div class='bico-chat-container'>
          <div id="chat" class='bico-chat-mensagem'>
            <?php
            if(isset($usuario))
            {
              include "../services/chat.php";
            }
            ?>
          </div>
        </div>

        <!-- Formulário -->
        <form class='bico-chat' action="../services/enviar_mensagem.php" method="post">
          <?php
          if(!isset($usuario))
          {
            echo "
            <input required type='text' disabled name='mensagem' placeholder='Digite aqui sua mensagem...' minlength='1' maxlength='199'/>";
          } else
            {
              echo "
              <input required type='text' name='mensagem' placeholder='Digite aqui sua mensagem...' minlength='1' maxlength='199'/>";
            }
          ?>

            <input required type="hidden" name='servico'
            value="<?php echo $_GET['servico'];?>">

            <input required type="hidden" name='profissional'
            value="<?php echo $_GET['profissional'];?>">

            <input type="hidden" name="consumidor"
            value="<?php echo $_SESSION['id'];?>">

            <input type="hidden" name="nome"
            value="<?php echo $_SESSION['nome'];?>">

            <button type="submit" name="button">
              <i class="material-icons" alt='Enviar'>send</i>
            </button>
          </form>

          <hr class="separador"/>
        <!-- Avaliação -->

        <p class="bico-subtitulo">Avaliação</p>
        <form class="comentar-container" action="../services/comentar.php" method="post">
          <div class="comentar-campos-container">

            <div class="comentar-nota-container">
              <label for="nota">Nota</label>
              <select required id="nota" name="nota">
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
              </select>
            </div>

            <div class="comentar-comentario-container">
              <label for="comentario">Comentário</label>
              <input required accept=""type="text" id="comentario" name="comentario" placeholder="Deixe um comentário">
            </div>

          </div>

          <?php
          $id = $_SESSION['id'];

          $comentarios_feitos = mysqli_query($bd,
          "SELECT * FROM comentarios
          WHERE id_usuario = '$id' AND servico = '$servico'");

          if(mysqli_num_rows($comentarios_feitos) == 0)
          {
            echo "
            <button class='comentar-botao' type='submit' name='button'>Enviar</button>";
          } else
            {
              echo "
              <button class='comentar-botao desativado' type='submit' name='button' disabled title='\n * Apenas um comentário por serviço.\n * Apenas usuários podem comentar.'>Enviar</button>";
            }
          ?>

          <input type="hidden" name="id_usuario"
          value="<?php echo $_SESSION['id'];?>">
          <input type="hidden" name="usuario"
          value="<?php echo $_SESSION['nome'];?>">
          <input type="hidden" name="servico"
          value="<?php echo $_GET['servico'];?>">
          <input type="hidden" name="profissional"
          value="<?php echo $_GET['profissional'];?>">
        </form>

        <hr class="separador"/>
        <!-- Avaliações -->
        <p class="bico-subtitulo">Comentários</p>
        <?php
        $comentarios = mysqli_query($bd,
        "SELECT * FROM comentarios
        WHERE servico = '$servico'");

        echo "
        <div class='avaliacoes-container'>";
          if(!mysqli_num_rows($comentarios) > 0)
          {
            echo "Não possui avaliações ainda.";
          }

          else
          {
            while($dados = mysqli_fetch_array($comentarios))
            {
                echo "
                <div class='avaliacoes-avaliacao-container'>

                  <div class='avaliacoes-usuario-container'>
                    <span class='avaliacoes-usuario'>";
                      echo $dados['usuario'];
                      echo "</span>

                    <pre class=''>";
                      echo ' avaliou com ';
                      echo "</pre>

                      <pre class='avaliacoes-usuario'>";
                        echo $dados['nota'];
                        echo "</pre>
                  </div>

                  <div class='avaliacoes-comentario-container'>
                    <p class='avaliacoes-comentario'>";
                    echo $dados['comentario'];
                    echo "</p>
                  </div>
                </div>";
              }

            }"
          }

        </div>"; // avaliacoes-container
        ?>
      </div>



    </main>

  </body>
  <script src="../js/chat.js"></script>
</html>
