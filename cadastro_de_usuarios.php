<?php 
include_once 'cadastrar_usuario.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEDGE</title>
    <link rel="stylesheet" type="text/css" href="css/cadastro.css">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
<div class="wrapper" style="background-color: ">
    <!-- Page Content  -->
    <div id="content">
      <h1 style="text-align: center;">CADASTRO</h1>
      <br>
      <br>
      <p class="text-center text-danger">
        <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?>
      </p>   
      <form class="form" action="" method="POST">
        <div class="row">
            <div class="col-lg-10">
                <label>Nome</label>
                <div class="form-group">
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="nome completo" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <label>Sexo</label>
                <div class="form-group">
                    <select name="sexo" size="1" class="form-control" id="sexo" required>
                        <option>feminino</option>
                        <option>masculino</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <label>Data de Nascimento</label>
                <div class="form-group">
                    <input type="date" name="datanasc" id="datanasc" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <label>CPF</label>
                <div class="form-group">
                    <input type="number" name="cpf" id="cpf" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">   
            <div class="col-lg-6">
                <label>Endereço</label>
                <div class="form-group">
                    <input type="text" name="endereco" id="endereco" class="form-control" placeholder="rua, numero, bairro" required>
                </div>
            </div>
            <div class="col-lg-4">
                <label>Cidade</label>
                <div class="form-group">
                    <input type="text" name="cidade" id="cidade" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-lg-6">
                <label>CEP</label>
                <div class="form-group">
                    <input type="number" name="cep" id="cep" class="form-control" required>
                </div>
            </div>
            <div class="col-lg-4">
                <label>Estado</label>
                <div class="form-group">
                    <select name="estado" class="form-control" required>
                        <option value="AC">Acre</option> 
                        <option value="AL">Alagoas</option> 
                        <option value="AM">Amazonas</option> 
                        <option value="AP">Amapá</option> 
                        <option value="BA">Bahia</option> 
                        <option value="CE">Ceará</option> 
                        <option value="DF">Distrito Federal</option> 
                        <option value="ES">Espírito Santo</option> 
                        <option value="GO">Goiás</option> 
                        <option value="MA">Maranhão</option> 
                        <option value="MT">Mato Grosso</option> 
                        <option value="MS">Mato Grosso do Sul</option> 
                        <option value="MG">Minas Gerais</option> 
                        <option value="PA">Pará</option> 
                        <option value="PB">Paraíba</option> 
                        <option value="PR">Paraná</option> 
                        <option value="PE">Pernambuco</option> 
                        <option value="PI">Piauí</option> 
                        <option value="RJ">Rio de Janeiro</option> 
                        <option value="RN">Rio Grande do Norte</option> 
                        <option value="RO">Rondônia</option> 
                        <option value="RS">Rio Grande do Sul</option> 
                        <option value="RR">Roraima</option> 
                        <option value="SC">Santa Catarina</option> 
                        <option value="SE">Sergipe</option> 
                        <option value="SP">São Paulo</option> 
                        <option value="TO">Tocantins</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <label>Email</label>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <label>Senha</label>
                <div class="form-group">
                    <input type="password" name="senha" id="inputPassword" class="form-control" required  minlength ="6">
                    <span class="help-block">Mínimo de seis (6) digitos</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <label>Confirmar Senha</label>
                <div class="form-group">
                    <input type="password" name="conf_senha" id="conf_senha" class="form-control" required>
                </div>
            </div>
        </div>
        <br>   
        <div class="row">
            <div class="col-lg-10">
                <input type="submit" name="btnCadUsuario" value="CADASTRAR"
                class="btn btn-lg btn-block" style="color: #FFFFFF;"><br><br>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-5">
                <a href="login.php"> Já tenho Cadastro</a>
            </div>
        </div>
        </form>
        <?php 
            include_once 'includes/footer.php';
        ?> 
    </div>  
  </div>
</body>
</html>