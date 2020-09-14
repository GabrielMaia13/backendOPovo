<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" type="text/css" href="estiloform.css">
<body>
	<div class="form" id="formdiv" name="formdiv">

	<h1 id="h1">LOGIN</h1>
<form method="post" action="file://C:/xampp/htdocs/autoLuguel/index.php">
	<?php print_r($_SERVER); ?>
	<input type="email" name="email" required placeholder="Email: exemplo@email.com"><br>
	<input type="password" name="s1" required placeholder="Senha:"><br>
	<input type="submit" value="Entrar">
</div>

</form>
<?php
	//verifica se o campo de email estava vazio
	if(isset($_POST['email'])){
		require '../conn.php';
		$email = $_POST['email'];
		$senha = $_POST['s1'];
		$q1 = "SELECT * FROM cliente where email='$email' AND senha='$senha'";
		//executa uma querry para puxar as informações da coluna 'cliente'
		$r1 = mysqli_query($conn,$q1);
		// verifica se as informações batem com o que esta cadastrado no banco de dados
		if($r1->num_rows > 0){
			$dados = $r1 ->fetch_assoc();
			session_start();
			$_SESSION['id'] = $dados['id_cliente'];
			$_SESSION['nome'] = $dados['nome'];
			header('location:../index.php');
		}else{
			echo 'Credenciais incorretas!';
		}
	}
?>
</body>
</html>