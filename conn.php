<?php
// faz a conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$bd = "autoluguel";

// Cria a conexão
$conn = new mysqli($servername, $username, $password,$bd);

// Verifica a conexão
if ($conn->connect_error) {
die("Conexão Falhou " . $conn->connect_error);
} 
?>
	