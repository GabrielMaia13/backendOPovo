<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<thead><tr><th>Item</th><th>Preço</th></tr></thead>
<?php
session_start();
require '../conn.php';
$diaria = 0.0;
$total = 0.0;
$veic = $_POST['veic'];
$veic2 = $_POST['veic2'];
$local_ret = $_POST['local_ret'];
$local_dev = $_POST['local_dev'];
$ret = $_POST['ret'];
$dev = $_POST['dev'];
$dias = $_POST['dias'];
//comod1,comod2,comod3
$prot = $_POST['prot'];
$categoria = mysqli_query($conn,"SELECT * from categoria where id_categoria = '$veic'")->fetch_assoc();
$diaria+= $categoria['preco_base'];
echo '<tr><td>Preço da categoria do veículo('.$categoria['categoria'].')</td><td>R$'.$categoria['preco_base'].'</td></tr>';
if(isset($_POST['comod1'])){
	$diaria+=28;
	echo '<tr><td>Cadeira infantil</td><td>R$28.00</td></tr>';
}
if(isset($_POST['comod2'])){
	$diaria+=15;
	echo '<tr><td>GPS</td><td>R$15.00</td></tr>';
}
if(isset($_POST['comod1'])){
	$diaria+=18;
	echo '<tr><td>Kit conectividade</td><td>R$18.00</td></tr>';
}
echo '<tr><td>Kit antifurto/roubo(';
switch ($prot) {
	case 1:
		$diaria+=28;
		echo 'básico)</td><td>R$28,00</td></tr>';
		break;
	case 2:
		$diaria+=43;
		echo 'completo)</td><td>R$43,00</td></tr>';
		break;
	case 3:
		echo 'super)</td><td>R$63,00</td></tr>';
		$diaria+=63;
		break;
}
echo '<tr><td>Valor  da diária</td><td>R$'.$diaria.'</td></tr>';
echo '<tr><td>Qtd. de dias:</td><td>'.$dias.'</td></tr>';
$total = $diaria * $dias;
echo '<tr><td>Valor total: </td><td>R$'.$total.'</td></tr>';
$arRet = explode('T',$ret);
$dtaRet = explode('-',$arRet[0]);
$arDev = explode('T',$dev);
$dtaDev = explode('-',$arDev[0]);
$sql = "INSERT INTO reserva VALUES(0,'".$_SESSION['id']."','$veic','".str_replace("T", " ", $ret)."','".str_replace("T", " ", $dev)."','$diaria','$total',0,'$local_ret','$local_dev','".(isset($_POST['comod1']) ? '1':'0')."','".(isset($_POST['comod2']) ? '1':'0')."','".(isset($_POST['comod3']) ? '1':'0')."','$prot',0)";
?>
</table>
Retirada do veículo marcada para o dia <?php echo $dtaRet[2].'/'.$dtaRet[1].'/'.$dtaRet[0]?> ás <?php echo $arRet[1];?>.<br>
Devolução do veículo marcada para o dia <?php echo $dtaDev[2].'/'.$dtaDev[1].'/'.$dtaDev[0]?> ás <?php echo $arDev[1];?>.<br>
Atraso de 2 horas ou mais para devolução resultará em multa de 5% do valor total, em caso de devolução antecipada, será cobrado o valor referente á todas as diárias marcadas inicialmente.
<br>
<form method="post" action="inserir.php">
Li e concordo com os termos acima<input type="checkbox" name="a" required="">
<input type="hidden" name="sql" value="<?php echo $sql; ?>">
<input type="submit" value="Confirmar"><a href="carros.php">
</form>
</body>
</html>