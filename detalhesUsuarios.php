<?php
  session_start();
  include_once("conexao.php");
  include_once 'seguranca.php';
  $cod_usuario = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEDGE</title>
    <link rel="stylesheet" type="text/css" href="css/cria_eventos.css">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>
</head>
<body>
<div class="wrapper">
  <?php
    include_once("includes/sidebar.php");
  ?>
  <!-- Page Content  -->
  <div id="content">
    <?php
      include_once("includes/navbar.php");
    ?>
    <?php
    //DATA ATUAL
     $dataAtual = date('Y-m-d'); 
    //BUSCAR O USUÁRIO ESCOLHIDO
      $buscar_usuario = "SELECT * FROM usuarios WHERE id_usuario = $cod_usuario";
      $resultado = mysqli_query($conexao, $buscar_usuario);
    ?>
    <h1 style="text-align: center;">Detalhes do Usuário</h1>
    <br>
    <table class="table" style="text-align: left;">
    <?php 
      while($rows = mysqli_fetch_array($resultado)){
        $idUsuario = $rows['id_usuario'];
        $nomeUsuario = $rows['nome_usuario'];
        $dataNascimento = $rows['data_nascimento_usuario'];
        $sexo = $rows['sexo_usuario'];
        $cpf = $rows['cpf_usuario'];
        $endereco = $rows['endereco_usuario'];
        $cidade = $rows['cidade_usuario'];
        $cep = $rows['cep_usuario'];
        $estado = $rows['estado_usuario'];
        $email = $rows['email_usuario'];
        $tipoUsuario = $rows['tipo_usuario'];
      echo "<tr>";
        echo "<th scope='col' class='table-dark'>ID</th>";
        echo "<td>".$idUsuario."</td>";
      echo "</tr>";

      echo "<tr>";
        echo "<th scope='col' class='table-dark'>Nome</th>";
        echo "<td>".$nomeUsuario."</td>";
      echo "</tr>";

      echo "<tr>";
        echo "<th scope='col' class='table-dark'>Data de Nascimento</th>";
        echo "<td>".date('d/m/Y', strtotime($dataNascimento))."</td>";
      echo "</tr>";

      echo "<tr>";
        echo "<th scope='col' class='table-dark'>Sexo</th>";
        echo "<td>".$sexo."</td>";
      echo "</tr>";

      echo "<tr>";
        echo "<th scope='col' class='table-dark'>CPF</th>";
        echo "<td>".$cpf."</td>";
      echo "</tr>";

      echo "<tr>";
        echo "<th scope='col' class='table-dark'>Endereço</th>";
        echo "<td>".$endereco."</td>";
      echo "<tr>";

      echo "<tr>";
        echo "<th scope='col' class='table-dark'>Cidade</th>";
        echo "<td>".$cidade."</td>";
      echo "</tr>";

      echo "<tr>";
        echo "<th scope='col' class='table-dark'>CEP</th>";
        echo "<td>".$cep."</td>";
      echo "</tr>";

      echo "<tr>";
        echo "<th scope='col' class='table-dark'>Estado</th>";
        echo "<td>".$estado."</td>";
      echo "</tr>";

      echo "<tr>";
        echo "<th scope='col' class='table-dark'>Email</th>";
        echo "<td>".$email."</td>";
      echo "</tr>";

      echo "<tr>";
        echo "<th scope='col' class='table-dark'>Tipo de Usuário</th>";   
        echo "<td>".$tipoUsuario."</td>"; 
      echo "</tr>";    
      }
    ?>
    </table> 
    <?php 
      include_once 'includes/footer.php';
    ?> 
  </div>
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
    });
  });
</script>
</body>
</html>