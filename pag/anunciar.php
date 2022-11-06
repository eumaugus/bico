<?php
SESSION_START();

if(!isset($_SESSION['email']))
{
  header("Location: ./home.php");
  // Criar mensagem de aviso dizendo que é necessário possuir uma conta para anunciar.
}
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>BICO | Anunciar</title>
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

    <div>
      <form class="anunciar-form" action="../services/anunciar.php" method="post" enctype="multipart/form-data">
        <label class="anunciar-form-titulo" for="titulo">Título</label>
        <input required type="text" name="anuncio">

        <label class="anunciar-form-titulo" for="ilustracao">Ilustração</label>
        <div class="ilustracao-botao">
          <i class="material-icons">file_upload</i>
          Selecionar arquivo
          <input id="ilustracao" type="file" name="ilustracao">
        </div>
        <span class="arquivo-selecionado"></span>

        <label class="anunciar-form-titulo" for="descricao">Descrição</label>
        <textarea required id="descricao" name="descricao" maxlength="199" placeholder="Infome o máximo de informações."></textarea>

        <label class="anunciar-form-titulo" for="uf">UF</label>
        <select id="uf" class="anunciar-form-uf" name="uf">
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

        <div class="meu-endereco-container">
          <input id="meu-endereco" type="checkbox" name="meu-endereco" value="meu-endereco">
          <label for="meu-endereco">Usar meu endereço</label>
        </div>

        <label class="anunciar-form-titulo" for="categoria">Categoria</label>

        <div class="categorias-container">
          <div>
            <input id="ass-tecnica" type="radio" name="categoria" value="Assistência Técnica">
            <label for="ass-tecnica">Assistência Técnica</label>
          </div>

          <div>
            <input id="aulas" type="radio" name="categoria" value="Aulas">
            <label for="aulas">Aulas</label>
          </div>

          <div>
            <input id="autos" type="radio" name="categoria" value="Autos">
            <label for="autos">Autos</label>
          </div>

          <div>
            <input id="consultoria" type="radio" name="categoria" value="Consultoria">
            <label for="consultoria">Consultoria</label>
          </div>

          <div>
            <input id="design-e-tecnologia" type="radio" name="categoria" value="Design e Tecnologia">
            <label for="design-e-tecnologia">Design e Tecnologia</label>
          </div>

          <div>
            <input id="eventos" type="radio" name="categoria" value="Eventos">
            <label for="eventos">Eventos</label>
          </div>

          <div>
            <input id="moda-e-beleza" type="radio" name="categoria" value="Moda e beleza">
            <label for="moda-e-beleza">Moda e beleza</label>
          </div>

          <div>
            <input id="reformas-e-reparos" type="radio" name="categoria" value="Reformas e reparo">
            <label for="reformas-e-reparos">Reformas e reparo</label>
          </div>

          <div>
            <input id="saude" type="radio" name="categoria" value="Saúde">
            <label for="saude">Saúde</label>
          </div>

          <div>
            <input id="servicos-domesticos" type="radio" name="categoria" value="Serviços Domésticos">
            <label for="servicos-domesticos">Serviços Domésticos</label>
          </div>
        </div>


        <button type="submit" name="button">Anunciar</button>
      </form>
    </div>

  </body>
  <script src="../js/home.js"></script>
</html>
