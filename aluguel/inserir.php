<?php
require '../conn.php';
$sql = $_POST['sql'];
$result = mysqli_query($conn,$sql);
if($result){
	?>
	<script type="text/javascript">
		alert("Reserva bem sucedida!");
		document.location.href = "../index.php";
	</script>
	<?php
}else{
	echo $conn->error;
}
?>