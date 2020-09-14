<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<title>Carros</title>
</head>
<link rel="stylesheet" type="text/css" href="estiloCarro.css">
<body onload="carregar(0);">
	<div id="container">
		<!-- Trigger/Open The Modal -->

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <!-- Modal content -->
<div class="modal-content">
  <div class="modal-header">
    <span class="close">&times;</span>
    <h2>Modal Header</h2>
  	
  <div class="modal-body">
    <p>Some text in the Modal Body</p>
    <p>Some other text...</p>
  </div>
  <div class="modal-footer">
    <h3>Modal Footer</h3>
  </div>
</div>
  </div>
</div>
	<div id="categoria">
		<button onclick="carregar(0)" id="0" class="botoes">Todos</button>
		<button onclick="carregar(1)" id="1" class="botoes">Simples</button>
		<button onclick="carregar(2)" id="2" class="botoes">Intermediário</button>
		<button onclick="carregar(3)" id="3" class="botoes">Luxo</button>
		</div>

	<div id="veiculos">
		
<?php
session_start();
include '../conn.php';
// verifica se o usuario está logado
  if(isset($_SESSION['id'])){

$sql1 = "SELECT * from reserva as r where id_cliente = '".$_SESSION['id']."' AND devolvido = 0";
$result = mysqli_query($conn,$sql1);
//verifica se existe algum carro alugado por esse cliente
if($result -> num_rows>0){
	die('Você já está com um aluguel pendente.');
}
?>
</div>
	<div id="detalhes"></div>
</div>
<script type="text/javascript">
//basicamente um script para fazer a janela modal(janela flutante) que aparece na tela
  var modal = document.getElementById('myModal');

var btn = document.getElementById("myBtn");

var span = document.getElementsByClassName("close")[0];

span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
	function carregar(tipo) {
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("veiculos").innerHTML = this.responseText;
                var botoes = document.getElementsByClassName("botoes");
                for(var i = 0;i<=3;i++){
                botoes[i].style.backgroundColor = "black";
                botoes[i].style.color = "white";
                }
                document.getElementById(tipo).style.backgroundColor = "white";
                document.getElementById(tipo).style.color = "black";
                
            }
        };
        xmlhttp.open("GET", "selectCarros.php?ctg=" + tipo, true);
        xmlhttp.send();
	}

		function detalhes(id) {
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementsByClassName("modal-content")[0].innerHTML = this.responseText;
                var slideIndex = 0;
                modal.style.display = "block";
				        carousel();
			}

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  slideIndex++;
  if (slideIndex > x.length) {slideIndex = 1} 
  x[slideIndex-1].style.display="";

  setTimeout(carousel, 3500);
}
            
        };
        //puxa os detalhes do veiculo
        xmlhttp.open("GET", "detalheVeiculo.php?id=" + id, true);
        xmlhttp.send();
	}
</script>
<?php }else{
  header("location:../index.php");
} ?>
</body>
</html>