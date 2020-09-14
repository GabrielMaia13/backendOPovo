<?php
include "../conn.php";
$ctg = $_GET['ctg'];
if($ctg==0){
	$query = "SELECT * from veiculo";
	$xd = "SELECT * from categoria";
}else{
	$query = "SELECT * from veiculo where categoria =".$ctg;
}
$r1 = mysqli_query($conn,$query);
$resposta ="";
if($r1 -> num_rows >=1 ){
while($r = $r1->fetch_assoc()){
	
	$q2 = "SELECT * FROM reserva where id_veiculo=".$r['id_veiculo']." AND devolvido = 0";
	$r2 = mysqli_query($conn,$q2);
	if($r2->num_rows==0){
	$xd = "SELECT * from categoria as cat where cat.id_categoria=".$r['categoria'];
	$nf = mysqli_query($conn,$xd) -> fetch_assoc();
	$dir = dir('imgVeiculo/'.$r['placa']);
	$cont = 0;
	while (false !== ($entry = $dir->read())) {
	if($cont>=2){
		$img =  '<img src="imgVeiculo/'.$r['placa'].'/'.$entry.'">';
 		break;
 	}
 	$cont++;
 	
}
	$resposta .= '<div class="veic" onclick="detalhes('.$r['id_veiculo'].')">'.$img.$r['modelo'].'<br>R$'.$nf['preco_base'].'</div>';
	//Colocar a imagem depois
}
}
}else{
	$resposta = "Nenhum carro desta categoria no estoque.";
}
echo $resposta;
?>