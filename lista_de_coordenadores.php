<?php
  session_start();
  include_once("conexao.php");
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
      $result_coordenadores = "SELECT * FROM usuarios_cadastrados WHERE tipo_usuarios='coordenador'";
      $resultado_coor = mysqli_query($conexao, $result_coordenadores);
    ?>
    <h1 style="text-align: center;">Criar novo evento</h1>
    <p>Passo 1: Denifir Coordenador do Evento</p>
    <br>
    <table class="table table-bordered">
      <thead class="thead-dark">
        <th><em class="fa fa-cog"></em></th>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Data de nascimento</th>
        <th scope="col">Endereço</th>
        <th scope="col">Cidade</th>
        <th scope="col">email</th>
      </thead>
      <tbody>
        <?php 
          while($rows_coor = mysqli_fetch_array($resultado_coor)){
            $id_c = $rows_coor['id'];
            $nome_c = $rows_coor['nome'];
            $_SESSION['nom'] = $nome_c;
            $sexo_c = $rows_coor['sexo'];
            $data_c = $rows_coor['datanasc'];
            $cpf_c= $rows_coor['cpf'];
            $end_c = $rows_coor['endereco'];
            $cid_c = $rows_coor['cidade'];
            $cep_c = $rows_coor['cep'];
            $uf_c = $rows_coor['estado'];
            $email_c = $rows_coor['email'];
            $tip_c = $rows_coor['tipo_usuarios'];
            echo "<tr>";
            echo"<td><a class='btn' href ='criar_evento.php?id=$id_c'>SELECIONAR</a></td>";
            echo "<td>".$id_c."</td>";
            echo "<td>".$nome_c."</td>";
            echo "<td>".$cpf_c."</td>";
            echo "<td>".$data_c."</td>";
            echo "<td>".$end_c."</td>";
            echo "<td>".$cid_c."</td>";
            echo "<td>".$email_c."</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table> 
    <a href="#">deseja cadastrar um novo coordenador?</a>
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