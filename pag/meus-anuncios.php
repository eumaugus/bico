<?php
SESSION_START();
include "../services/bd.php";

// if(isset($_SESSION['nome']))
//   echo $_SESSION['email'];

if(!isset($_SESSION['nome']))
{
  header("Location: ./home.php");
  // Criar mensagem de aviso dizendo que é necessário possuir uma conta para mostrar seus anúncios.
}

// Oculta erros do PHP
error_reporting(0);
ini_set("display_errors", 1 );
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>BICO | Meus anúncios</title>
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

    <!-- BUSCA -->
    <div class="busca-container">
      <form action="./meus-anuncios.php" method="post">

        <div class="busca-container-input">
          <label for="busca">
            <i class="material-icons">search</i>
          </label>
          <input required id="busca" type="text" name="busca" placeholder="Busque por nome ou descrição.">
        </div>

        <button id="busca-container-buscar" type="submit" name="button">Buscar</button>

      </form>
    </div>

    <!-- SERVICOS -->
    <main class="servicos-container-eu">
      <!-- SIMULAÇÃO DE SERVIÇOS FEITOS -->

      <?php
      if(isset($_SESSION['email']))
      {
        $email = $_SESSION['email'];
        $id = mysqli_query($bd, "SELECT id FROM usuarios WHERE email = '$email'");
        while($dado = mysqli_fetch_array($id))
        {
          $id_usuario = $dado['id'];
        }

        $busca = $_POST['busca'];
        $meus_anuncios = mysqli_query($bd, "SELECT * FROM anuncios WHERE id_usuario = '$id_usuario' AND anuncio LIKE '%$busca%' OR descricao LIKE '%$busca%'");
        while($meu_anuncio = mysqli_fetch_array($meus_anuncios))
        {
          $ilustracao = "./anuncios/{$meu_anuncio['ilustracao']}";
          echo "
          <div class='servico-eu'>
            <div class='servico-imagem-container'>
              <img src='";
              echo $ilustracao;
              echo "'>
            </div>

            <div class='servico-detalhes-eu'>
              <p>Título: ";
              echo $meu_anuncio['anuncio'];
              echo "
              </p>
              <p>Descrição: ";
              echo $meu_anuncio['descricao'];
              echo "
              </p>
              <p>UF: ";
              echo $meu_anuncio['estado'];
              echo "
              </p>
              <p>Categoria: ";
              echo $meu_anuncio['categoria'];
              echo "
              </p>
              <p>Data de publicação: ";
              echo $meu_anuncio['data'];
              echo "
              </p>

              <div class='servico-configuracoes'>
                <button class='servico-editar' type='button' name='button'>
                <a href='./editar_anuncio.php?id_anuncio={$meu_anuncio['id_anuncio']}'>
                  <i class='material-icons'>edit</i>
                  Editar
                </a>
                </button>

                <button class='servico-excluir' type='button' name='button'>
                  <a href='../services/deletar_anuncio.php?id_anuncio={$meu_anuncio['id_anuncio']}'>
                    <i class='material-icons'>delete</i>
                    Excluir
                  </a>
                </button>
              </div>
            </div>

          </div>";
        }
      }
      ?>

      <p class="servico-aviso ocultado">Nenhum serviço encontrado.</p>
    </main>

  </body>
  <script>
  </script>
</html>
