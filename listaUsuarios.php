<?php
  session_start();
  include_once("conexao.php");
  include_once 'seguranca.php';
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
    //BUSCAR TODOS OS USUÁRIOS CADASTRADOS
      $buscar_usuarios = "SELECT * FROM usuarios";
      $resultado = mysqli_query($conexao, $buscar_usuarios);
    ?>
    <h1 style="text-align: center;">Lista de Usuários</h1>
    <br>
    <table class="table table-hover" style="text-align: center;">
      <thead class="thead-dark">
        <th scope="col">Nome</th>
        <th scope="col">Data de Nascimento</th>
        <th scope="col">Email</th>
        <th scope="col">Tipo de Usuário</th>
        <th scope="col"></th>
      </thead>
      <tbody>
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
            echo "<td>".$nomeUsuario."</td>";
            echo "<td>".date('d/m/Y', strtotime($dataNascimento))."</td>";
            echo "<td>".$email."</td>";
            echo "<td>".$tipoUsuario."</td>";
            echo "<td><a href='editarUsuario.php?id=$idUsuario'><i class='fas fa-edit'></i></a> <a href='detalhesUsuarios.php?id=$idUsuario'><i class='fas fa-eye'></i></a> <a href=''><i class='fas fa-trash-alt'></i></a></td>";
            echo "</tr>";
          }
        ?>
      </tbody>
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