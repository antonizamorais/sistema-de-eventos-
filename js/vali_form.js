function validar() {
	
	var nome = formUsuario.nome.value;
	var sexo = formUsuario.sexo.value;
	var datanasc = formUsuario.datanasc.value;
	var cpf = formUsuario.cpf.value;
	var endereco = formUsuario.endereco.value;
	var cidade = formUsuario.cidade.value;
	var estado = formUsuario.estado.value;
	var cep = formUsuario.cep.value;
	var email = formUsuario.email.value;
	var senha = formUsuario.senha.value;
	var conf_senha = formUsuario.conf_senha.value;

	if (nome.length < 10) {
		alert('Digite seu nome completo');
		formUsuario.nome.focus();
		return false;
	}

	if ((email.length != 0) && ((email.indexOf("@")<1)||(email.indexOf('.')<1)))  {
		alert("email inválido");
		formUsuario.email.value = "";
		formUsuario.email.focus();
		return false;
	}

	if (senha != rep_senha) {
		alert('Senhas diferentes');
		formUsuario.senha.focus();
		return false;
	}

	return true;
}

