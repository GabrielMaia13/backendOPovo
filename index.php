<!DOCTYPE html>
<html>
<head>
	<title>Página inicial</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
<?php
session_start();
//puxa o arquivo de conexão geral com o banco de dados
require 'conn.php';
	//declara a zona de localização como sendo pra america no estado da bahia
	date_default_timezone_set('America/Bahia');
	//executa um if pra verificar se o usuario está logado, 
	//verifica se o email e a senha batem com o que esta no banco de dados
	//seta a variavel logado pra 'true' e traz o nome do mesmo
	if(isset($_POST['email'])){
		$email = $_POST['email'];
		$senha = $_POST['s1'];
		$q1 = "SELECT * FROM cliente where email='$email' AND senha='$senha'";
		$r1 = mysqli_query($conn,$q1);
		if($r1->num_rows > 0){
			$dados = $r1 ->fetch_assoc();
			$_SESSION['id'] = $dados['id_cliente'];
			$_SESSION['nome'] = $dados['nome'];
			$logado = true;

		}else{
			$logado = false;
			echo "<script>alert('Crendenciais inválidas!');";
			session_destroy();
			echo "document.location.href='login.php';</script>";
		}
	}else if(isset($_SESSION['id'])){
		$logado = true;
	}else{
		$logado = false;
		session_destroy();
	}
?>
<div class="parallax" id="p1">
	<span class="caption">
		<p>Bem-Vindo(a)<br> 
		<?php 
			//verifica se a variavel logado é igual a 'true' se sim vai acrescentar a o nome q foi extraido do banco de dados.
			echo ($logado ? explode(" ", $_SESSION['nome'])[0] : "")
		?>
		</p>
	</span>
</div>



<div class="meio" id="caixas">
	<?php 
	//verifica se logado é igual a 'true e faz uma query trazendo os dados do mesmo'
	if($logado){
		$query = "SELECT * from reserva where id_cliente = '".$_SESSION['id']."' AND devolvido = 0";
		$r = mysqli_query($conn,$query);
		//verifica de o atributo devolução é igual a 0 e se a data de devolução está acima da que foi cadastrada
		if($r->num_rows > 0){
			$dados = $r->fetch_assoc();
				$dtDevo = explode(" ", $dados['devolucao']);
				$dtDevo = explode("-",$dtDevo[0])[2]."/".explode("-",$dtDevo[0])[1]."/".explode("-",$dtDevo[0])[0]." as ".$dtDevo[1];
				$ts1 = strtotime($dados['devolucao']);
				$ts2 = time();
				$diff = (($ts2 - $ts1)/60)/60;
				//se ela estiver vai declarar na pagina e aplicar uma multa no valor a ser pago
			if($diff>=2){

				echo '<span class="box first devolv" onclick="" style="">Você está com um aluguel atrasado!<br>Data de devolucão: '.$dtDevo.'<br><a href="aluguel/devolver.php">Devolver</a></span>';
				if($dados['atraso'] == '0'){
					$att = "UPDATE reserva SET atraso = 1,preco_total = ".doubleval($dados['preco_total']+($dados['preco_total']*0.05))."  where id_reserva =".$dados['id_reserva'];
					$r2 = mysqli_query($conn,$att);
				}
				//se não estiver vai apenas mostrar que o usuario ja possui um aluguel pendente e pergunta se ele gostaria de devolver o carro
			}else{
				echo '<span class="box first devolv" onclick="" style="">Você está com um aluguel pendente.<br>Data de devolucão: '.$dtDevo.'<br><a href="aluguel/devolver.php">Devolver</a></span>';
			}
		 ?>
		 <!-- desloga o usuario -->
	<span class="box" onclick="location.href='cliente/sair.php'" style="cursor: pointer;">
		Sair
		<?php
	}else{
		?>
		<!-- re-direciano o usuario para a pagina de aluguel -->
		<span class="box first" onclick="location.href='aluguel/carros.php'" style="cursor: pointer;">
		Alugar carro
	</span>
	<span class="box" onclick="location.href='cliente/sair.php'" style="cursor: pointer;">
		Sair
	</span>		
		<?php 
	}
}else{
	?>
	<span class="box first" onclick="location.href='cliente/cadastroCliente.php'" style="cursor: pointer;">
		Cadastrar-se
	</span>
	<span class="box" onclick="location.href='login.php'" style="cursor: pointer;">
		Logar
	</span>

<?php } ?>
</div>
<div class="parallax" id="p2" ></div>

<div class="meio">
	<p align="center" style="font-size: 14px">
		<i>
		Não inventei nada de novo.Simplesmente juntei em um carro as descobertas de outros homens, séculos de trabalho depois.</i><br>
		Henry Ford(1863-1947)
	</p>
	Nossa empresa trabalha para fornecer veículos de alta qualidade, das mais diversas categorias para os mais diversos clientes.
	Escolha um veículo de nosso estoque, marque quando e onde quer pega-lo, quando e onde vai deixa-lo.
	Opite por comodidades extras, escolha um dos nossos planos de segurança, e <i>voilà</i> sua viagem está pronta.
</div>
</body>
</html>