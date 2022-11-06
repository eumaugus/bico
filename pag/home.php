<?php
SESSION_START();
include "../services/bd.php";

// Oculta erros do PHP
error_reporting(0);
ini_set("display_errors", 1 );
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>BICO | Home</title>
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

    <!-- CRIAR -->
    <div class="criar-anuncio-container">
      <a href="./anunciar.php">Criar um anúncio</a>
    </div>

    <!-- BUSCA -->
    <div class="busca-container">
      <form action="home.php" method="post">

        <div class="busca-container-input">
          <label for="busca">
            <i class="material-icons">search</i>
          </label>
          <input type="text" name="busca" id="busca" placeholder="Pesquise serviços por aqui">
        </div>

        <div class="filtro">
          <label for="uf">
            <i class="material-icons" alt="Estados">location_on</i>
          </label>

          <select id="uf" class="uf" name="uf">
            <option value="">TUDO</option>
            <option value="AC">AC</option>
            <option value="AL">AL</option>
            <option value="AP">AP</option>
            <option value="AM">AM</option>
            <option value="BA">BA</option>
            <option value="CE">CE</option>
            <option value="DF">DF</option>
            <option value="ES">ES</option>
            <option value="GO">GO</option>
            <option value="MA">MA</option>
            <option value="MT">MT</option>
            <option value="MS">MS</option>
            <option value="MG">MG</option>
            <option value="PA">PA</option>
            <option value="PB">PB</option>
            <option value="PR">PR</option>
            <option value="PE">PE</option>
            <option value="PI">PI</option>
            <option value="RJ">RJ</option>
            <option value="RN">RN</option>
            <option value="RS">RS</option>
            <option value="RO">RO</option>
            <option value="RR">RR</option>
            <option value="SC">SC</option>
            <option value="SP">SP</option>
            <option value="SE">SE</option>
            <option value="TO">TO</option>
          </select>

          <label for="categoria">
            <i class="material-icons" alt="Categorias">list</i>
          </label>
          <select id="categoria" class="uf" name="categoria">
            <option value="">TUDO</option>
            <option value="Assistência Técnica">Assistência Técnica</option>
            <option value="Aulas">Aulas</option>
            <option value="Autos">Autos</option>
            <option value="Consultoria">Consultoria</option>
            <option value="Design e Tecnologia">Design e Tecnologia</option>
            <option value="Eventos">Eventos</option>
            <option value="Moda e beleza">Moda e beleza</option>
            <option value="Reformas e reparo">Reformas e reparo</option>
            <option value="Saúde">Saúde</option>
            <option value="Serviços Domésticos">Serviços Domésticos</option>
          </select>

        <button type="submit" name="button">Buscar</button>

      </form>
    </div>

    <!-- SERVICOS -->
    <main class="servicos-container">

      <?php
      $busca = $_POST['busca'];
      $estado = $_POST['uf'];
      $categoria = $_POST['categoria'];

      $anuncios = mysqli_query($bd,
      "SELECT * FROM anuncios
      WHERE anuncio LIKE '%$busca%' AND
      categoria LIKE '%$categoria%'");
// and estado LIKE '%$busca%' categoria LIKE '%$busca%'
      while($anuncio = mysqli_fetch_array($anuncios))
      {
        if(mysqli_num_rows($anuncios) > 0)
        {
          $ilustracao = "./anuncios/{$anuncio['ilustracao']}";
          echo "
          <div class='servico'>

            <div class='servico-frente'>
              <img src='";
              echo $ilustracao;
              echo "'>

              <p class='servico-titulo'>";
                echo $anuncio['anuncio'];
              echo "
              </p>
            </div>";

          echo "
            <div class='servico-tras'>
              <div class='servico-info'>
                <i class='material-icons'>event_note</i>";
                echo "Publicado por: {$anuncio['id_usuario']} em {$anuncio['data']}";
                echo
              "</div>";

            echo "
              <div class='servico-info'>
                <i class='material-icons'>location_on</i>";
                echo "{$anuncio['estado']}";
                echo
              "</div>";

              echo "
              <div class='servico-info'>";
                echo $anuncio['descricao'];
                echo
              "</div>";

              echo "
              <div class='servico-url-container'>
                <a class='servico-url' href='./servico.php?servico={$anuncio['id_anuncio']}&profissional={$anuncio['id_usuario']}'>Solicitar</a>
              </div>";

              echo "
            </div>
          </div>";

        } else
          {
            echo "<p>Não tem anuncio</p>";
          }
      }
      ?>

      <p class="servicos-aviso"></p>
    </main>

  </body>
  <script src="../js/home.js"></script>
</html>
