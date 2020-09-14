<!DOCTYPE html>
<html>
<head>
	<title>Devolução</title>
</head>
<body bgcolor="black">
<?php
require '../conn.php';
session_start();
$sql = "UPDATE reserva SET devolvido = 1 WHERE id_cliente = ".$_SESSION['id']." AND devolvido = 0";
$result = mysqli_query($conn,$sql);
if($result){
	?>
	<script>
		alert('Devolução bem sucedida');
		document.location.href = "../index.php";
	</script>
	<?php
}else{
	echo $conn->error;
}
?>
</body>
</html>