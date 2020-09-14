<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
	<link rel="stylesheet" type="text/css" href="estiloform.css">
</head>
<body>
		<div class="form" id="formdiv" name="formdiv">
			<h1 id="h1">CADASTRO</h1>
<form method="post" action="cadastroCliente.php">
	<input type="text" name="nome" required="" placeholder="Nome"><br>
	<input type="email" name="email" required placeholder="email@email.com"><br>
	<input type="password" name="s1" required id="s1" placeholder="Senha"><br>
	<input type="password" name="s2" required id="s2" placeholder="Confirme sua senha"><br>
	<input type="submit" name="">
</form>
</div>
<?php
if (isset($_POST['nome'])) {
	require '../conn.php';
	$nome = $_POST['nome'];
	$email =$_POST['email'];
	$s1 = $_POST['s1'];
	$query1 = "INSERT INTO cliente(nome,email,senha) VALUES('$nome','$email','$s1')";
	$r1 = mysqli_query($conn,$query1);
	if($r1){
		header("location:login.php");
	}
}

?>
<script type="text/javascript">
		var password = document.getElementById("s1")
  , confirm_password = document.getElementById("s2");
  var form = document.getElementById('formdiv');
  //valida a senha do usuario pra verificar se são iguais
function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("As senhas são diferentes!");
  } else {
    confirm_password.setCustomValidity('');
  }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
	</script>
</body>
</html>