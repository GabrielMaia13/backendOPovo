<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" type="text/css" href="estiloform.css">
<body>
	<div class="form" id="formdiv" name="formdiv">

	<h1 id="h1">LOGIN</h1>
<form method="post" action="">
	<input type="email" name="email" required placeholder="Email: exemplo@email.com"><br>
	<input type="password" name="s1" required placeholder="Senha:"><br>
	<input type="submit" value="Entrar">
</div>

</form>
<?php
	if(isset($_POST['email'])){
		require '../conn.php';
		$email = $_POST['email'];
		$senha = $_POST['s1'];
		$q1 = "SELECT * FROM cliente where email='$email' AND senha='$senha'";
		$r1 = mysqli_query($conn,$q1);
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