<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8 bin">
	<link rel="stylesheet" type="text/css" href="estiloreservar.css">
	<title>Alugar</title>
</head>
<body>

	<?php
	session_start();
	if(isset($_SESSION['id'])){
	require '../conn.php';
	$id_veic = $_POST['veic'];
	date_default_timezone_set('America/Bahia');
	$dados_veic  = mysqli_query($conn,"SELECT * from veiculo where id_veiculo = $id_veic") ->fetch_assoc();
	$hoje = date('-m-d');

	?>
	<div class="form">
<form method="post" action="reservar.php">
	<H1>Reserva</H1>Veículo<br> 
	<input type="text" name="veic2"value="<?php echo $dados_veic['modelo'];?>" readonly=""><input type="hidden" name="veic" value="<?php echo $id_veic;?>"><br>
	Local de retirada
	<select name="local_ret" required="">
		<option value="">Local de retirada</option>
		<?php
		$locais = mysqli_query($conn,"SELECT * from local");
		while($l = $locais -> fetch_assoc()){
			echo '<option value="'.$l['id_local'].'">'.$l['local'].'</option>';
		}
		?>
	</select><br>
	Local de devolução
	<select name="local_dev" required="">
		<option value="">Local de devolução</option>
		<?php
		$locais = mysqli_query($conn,"SELECT * from local");
		while($l = $locais -> fetch_assoc()){
			echo '<option value="'.$l['id_local'].'">'.$l['local'].'</option>';
		}
		?>
	</select><br>

	<div class="meio"><label for="ret">Retirada</label>
	<input type="datetime-local" id="ret" name="ret"  value="<?php echo date('Y-m-d').'T'.date('H:i',strtotime('+1 hour',strtotime(date('H:i'))));?>" min="<?php echo date('Y-m-d').'T'.date('H:i',strtotime('+1 hour',strtotime(date('H:i'))));?>" onchange="atualizarData(1)"></div>
	<div class="meio"><label for="dias">Dias</label>
	<input type="number" name="dias" id="dias" min="1" value="1" onchange="atualizarData(3)"></div>
	<div class="meio"><label for="">Horas extras</label>
	<input type="number" name="horas" id="horas" readonly="readonly"></div>	
	<div class="meio"><label for="dev">Devolução</label><input type="datetime-local" id="dev" name="dev"  value="" onchange="atualizarData(2)"></div>
	<Br>
	


	Comodidades:<br>
	<div class="parent2"><label class="container" >Cadeira infantil<input type="checkbox" name="comod1" value="1" onclick="caixa(this)"><span class="checkmark"></span></label></div>
	<div class="parent2"><label class="container">GPS<input type="checkbox" name="comod2" value="1" onclick="caixa(this)"><span class="checkmark"></span></label></div>
	<div class="parent2"><label class="container">Kit conectividade<input type="checkbox" name="comod3" value="1" onclick="caixa(this)"><span class="checkmark"></span></label><br></div><Br>

	Kit proteção:<br>
	<div class="parent2"><label class="container" >Básico<input type="radio" name="prot" value="1" checked="checked" onload="this.parentElement.parentElement.style.backgroundColor = 'lightgreen'" onclick="radio(this)" class="rad" id="primeiro"></label></div>
	<div class="parent2"><label class="container" >Completo<input type="radio" name="prot" value="2" onclick="radio(this)" class="rad" ></label></div>
	<div class="parent2"><label class="container" >Super<input type="radio" name="prot" value="3" onclick="radio(this)" class="rad"></label></div>

	<input type="submit" name="part1" value="Reservar">
</form>
</div>
<script type="text/javascript" src="moment.js"></script>
<script type="text/javascript">
	document.getElementById("primeiro").parentElement.parentElement.style.backgroundColor = "lightgreen";
function caixa(element) {
	if(element.checked){
	element.parentElement.parentElement.style.backgroundColor = "lightgreen";
	}else{
	element.parentElement.parentElement.style.backgroundColor = "rgb(255, 102, 102)";
	}
}
function radio(element) {
	element.parentElement.parentElement.style.backgroundColor = "lightgreen";
	var radios = document.getElementsByClassName("rad");
	for(var i = 0;i<=2;i++){
		if(radios[i] != element){
		radios[i].parentElement.parentElement.style.backgroundColor = "rgb(255, 102, 102)";
		}
	}
}

var dev = document.getElementById('dev');
var ret = document.getElementById('ret');
var dias = document.getElementById('dias');

var devv = dev.value;
var retv = ret.value;
var dia = 1;
var d1  = moment(devv,"YYYY-MM-DDThh:mm");
var d2 = moment(retv,"YYYY-MM-DDThh:mm");
dev.value = d2.add(1,'day').format().substring(0, d2.clone().add(1,'day').format().length-9);
	function atualizarData(i) {
	 devv = dev.value;
	 retv = ret.value;
	 d1  = moment(devv,"YYYY-MM-DDThh:mm");
	 d2 = moment(retv,"YYYY-MM-DDThh:mm");
switch(i){
	case 1: //retirada
		dev.min = d2.clone().add(1,'days').format().substring(0, d2.clone().add(1,'days').format().length-9);
		dias.value = d1.diff(d2,'days');
		dia = dias.value;
		break;
	case 2:
		dev.min = d2.clone().add(1,'days').format().substring(0, d2.clone().add(1,'days').format().length-9);
		dias.value = d1.diff(d2,'days');
		dia = dias.value;
		break;
	case 3:
		var dif = dias.value - dia;
		dev.value = d1.clone().add(dif,'days').format().substring(0, d1.clone().add(dif,'days').format().length-9);
		dev.min = d1.clone().add(dif,'days').format().substring(0, d1.clone().add(dif,'days').format().length-9);
		dia = dias.value;
		break;
 }
 		//Calculo de hora;
 		var hra_extra = d1.diff(d2,'hours');
 		document.getElementById("horas").value = d1.diff(d2,'hours')%24; 		
	}
</script>
<?php
//Parte 2 !!
if(isset($_POST['part1'])){
	?>

<div id="myModal" class="modal">
	<div class="modal-content">
  <div class="modal-header">
    <span class="close">&times;</span>
    <h4>Ultimos passos</h4>
  	</div>
  <div class="modal-body">
  	<table id="tabela">
		<thead><tr><th>Item</th><th>Preço</th></tr></thead>
<?php
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
echo '<tr><th>Preço da categoria do veículo('.$categoria['categoria'].')</th><td>R$'.$categoria['preco_base'].'</td></tr>';
if(isset($_POST['comod1'])){
	$diaria+=28;
	echo '<tr><th>Cadeira infantil</th><td>R$28.00</td></tr>';
}
if(isset($_POST['comod2'])){
	$diaria+=15;
	echo '<tr><th>GPS</th><td>R$15.00</td></tr>';
}
if(isset($_POST['comod1'])){
	$diaria+=18;
	echo '<tr><th>Kit conectividade</th><td>R$18.00</td></tr>';
}
echo '<tr><th>Kit antifurto/roubo(';
switch ($prot) {
	case 1:
		$diaria+=28;
		echo 'básico)</th><td>R$28,00</td></tr>';
		break;
	case 2:
		$diaria+=43;
		echo 'completo)</th><td>R$43,00</td></tr>';
		break;
	case 3:
		echo 'super)</th><td>R$63,00</td></tr>';
		$diaria+=63;
		break;
}
echo '<tr><th>Valor  da diária</th><td>R$'.$diaria.'</td></tr>';
echo '<tr><th>Qtd. de dias:</th><td>'.$dias.'</td></tr>';
$total = $diaria * $dias;

$arRet = explode('T',$ret);
$dtaRet = explode('-',$arRet[0]);
$arDev = explode('T',$dev);
$dtaDev = explode('-',$arDev[0]);
$quer = "SELECT * from distancia where (local1= $local_ret and local2 = $local_dev) or (local1 = $local_dev and local2 = $local_ret)";
$w1 = mysqli_query($conn,$quer);
$w = $w1 ->fetch_assoc();
if($local_ret != $local_dev){
	$distan = $w['distancia'];
	$tfc = $distan * 1.20;
	$vtotal = ($tfc + $total);
	echo '<tr><th>Taxa Por Km rodado :</th><td>R$'.$tfc.'</td></tr>';
	echo '<tr><th>Valor total: </th><td>R$'.$vtotal.'</td></tr>';
	$sql = "INSERT INTO reserva VALUES(0,'".$_SESSION['id']."','$veic','".str_replace("T", " ", $ret)."','".str_replace("T", " ", $dev)."','$diaria','$vtotal',0,'$local_ret','$local_dev','".(isset($_POST['comod1']) ? '1':'0')."','".(isset($_POST['comod2']) ? '1':'0')."','".(isset($_POST['comod3']) ? '1':'0')."','$prot',0)";
}else{
	echo '<tr><th>Valor total: </th><td>R$'.$total.'</td></tr>';
	$sql = "INSERT INTO reserva VALUES(0,'".$_SESSION['id']."','$veic','".str_replace("T", " ", $ret)."','".str_replace("T", " ", $dev)."','$diaria','$total',0,'$local_ret','$local_dev','".(isset($_POST['comod1']) ? '1':'0')."','".(isset($_POST['comod2']) ? '1':'0')."','".(isset($_POST['comod3']) ? '1':'0')."','$prot',0)";
}


?>
</table>
Retirada do veículo marcada para o dia <?php echo $dtaRet[2].'/'.$dtaRet[1].'/'.$dtaRet[0]?> ás <?php echo $arRet[1];?>.<br>
Devolução do veículo marcada para o dia <?php echo $dtaDev[2].'/'.$dtaDev[1].'/'.$dtaDev[0]?> ás <?php echo $arDev[1];?>.<br>
<br>

    <form method="post" action="inserir.php"><br>
Li e concordo com os termos acima<input type="checkbox" name="a" required="">
  </div>
  <div class="modal-footer">
<input type="hidden" name="sql" value="<?php echo $sql; ?>">
<input type="submit" value="Confirmar" id="btn">
  </div>
</div>
  </div>
</div>
	
	<script type="text/javascript">
 var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
                modal.style.display = "block";

</script>

	<?php
}
}else{
	header("location:../login.php");
}
?>
</body>
</html>