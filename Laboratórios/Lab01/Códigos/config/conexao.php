<?php
// Configurações de conexão ao banco de dados
$servername = "localhost"; // Nome do servidor (geralmente é 'localhost')
$username = "root"; // Nome de usuário do MySQL (geralmente 'root' em ambientes locais)
$password = ""; // Senha do MySQL (deixe vazio se não houver senha)
$dbname = "sistema_universidade"; // Nome do banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Definindo o charset como utf8 para suportar caracteres especiais
$conn->set_charset("utf8");
?>