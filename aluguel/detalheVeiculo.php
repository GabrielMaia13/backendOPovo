<?php
include '../conn.php';
$id = $_GET['id'];
$query = "SELECT * FROM veiculo where id_veiculo = $id";
$r1 = mysqli_query($conn,$query);
$r = $r1 ->fetch_assoc();
$query2 = "SELECT * from categoria where id_categoria = $id";
$o1 = mysqli_query($conn,$query2);
$o = $o1 -> fetch_assoc();
//Fazer o slide show de imgs
$dir = dir('imgVeiculo/'.$r['placa']);
$cont = 0;
$img ="";
while (false !== ($entry = $dir->read())) {
	if($cont>=2){
		$img .= '<img class ="mySlides" src="imgVeiculo/'.$r['placa'].'/'.$entry.'">';
 	}
 	$cont++;
 	
}
switch ($r['categoria']) {
	case '1':
		$ctg = "Simples";
		break;
	case '2':
		$ctg = "Intermediário";
		break;
	case '3' :
		$ctg ="Luxo";
		break;
	default:
		# code...
		break;
}
$resposta = "";

$resposta.='<div class="modal-header">'.$r['modelo'].'</div>'.
'<div class="modal-body">'.
$img.
'<table id="tabela">'.
'<thead><tr><th colspan="3">Detalhes do veículo	</th></tr></thead>'.
'<tr><th>Categoria</th>'.'<td>'.$ctg.' (Valor da categoria: R$'.$o['preco_base'].') </td></tr>'.
'<tr><th>Vagas</th>'.'<td>'.$r['qtd_ocupantes'].'</td></tr>'.
'<tr><th>Qtd. de bagagens</th>'.'<td>'.$r['qtd_bagagem'].'</td></tr>'.
'<tr><th>Portas</th>'.'<td>'.$r['qtd_porta'].'</td></tr>'.
'<tr><th>Motorização</th>'.'<td>'.$r['motorizacao'].'</td></tr>'.
'<tr><th>Ar-condicionado</th>'.'<td><img src="'.$r['ar_cond'].'.jpg" class="bool"></td></tr>'.
'<tr><th>USB</th>'.'<td><img src="'.$r['usb'].'.jpg" class="bool"></td></tr>'.
'<tr><th>Air bag</th>'.'<td><img src="'.$r['air_bag'].'.jpg" class="bool" ></td></tr>'.
'<tr><th>Freios ABS</th>'.'<td><img src="'.$r['abs'].'.jpg" class="bool"></td></tr></table>'.'</div>'.
'<div class="modal-footer">'.
'<form method="post" action="reservar.php"><input type="hidden" name ="veic" value="'.$r['id_veiculo'].'"> <input type="submit" value="Alugar" id="btn"></form></div>';
echo $resposta;







?>