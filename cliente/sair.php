<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
//basicamente inicia uma session(q é uma maneira de guardar valores sem o banco de dados) destroi a mesma e
//retorna para a pagina inicial
session_start();
session_destroy();
header("location:../index.php");
?>
</body>
</html>