<?php
class Database {
    private $host = "localhost";      // Host do MySQL
    private $db_name = "moeda_estudantil";  // Nome do banco de dados
    private $username = "root";       // Usuário do MySQL
    private $password = "";           // Senha do MySQL
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>