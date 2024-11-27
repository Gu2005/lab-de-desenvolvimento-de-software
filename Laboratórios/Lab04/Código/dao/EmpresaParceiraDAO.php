<?php
class EmpresaParceiraDAO {
    private $conn;
    private $table_name = "empresa_parceira";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Criar nova empresa parceira
    public function create($nome, $email, $cnpj, $endereco, $descricao, $senha) {
        $query = "INSERT INTO " . $this->table_name . " (nome, email, cnpj, endereco, descricao, senha)
                  VALUES (:nome, :email, :cnpj, :endereco, :descricao, :senha)";
        $stmt = $this->conn->prepare($query);

        // Segurança: hash da senha
        $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

        // Binding
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":cnpj", $cnpj);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":senha", $senha_hash);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Ler todas as empresas parceiras
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Atualizar dados de uma empresa parceira
    public function update($id, $nome, $email, $cnpj, $endereco, $descricao) {
        $query = "UPDATE " . $this->table_name . " SET
                  nome = :nome, email = :email, cnpj = :cnpj, endereco = :endereco, descricao = :descricao
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Binding
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":cnpj", $cnpj);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Excluir uma empresa parceira
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $->conn->prepare($query);

        // Binding
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>