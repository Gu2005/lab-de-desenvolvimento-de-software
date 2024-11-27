<?php
class AlunoDAO {
    private $conn;
    private $table_name = "aluno";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Criar um novo aluno
    public function create($nome, $email, $cpf, $rg, $endereco, $instituicao_id, $curso, $senha) {
        $query = "INSERT INTO " . $this->table_name . " (nome, email, cpf, rg, endereco, instituicao_id, curso, senha)
                  VALUES (:nome, :email, :cpf, :rg, :endereco, :instituicao_id, :curso, :senha)";
        $stmt = $this->conn->prepare($query);

        // Segurança: hash da senha
        $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

        // Binding
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":rg", $rg);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":instituicao_id", $instituicao_id);
        $stmt->bindParam(":curso", $curso);
        $stmt->bindParam(":senha", $senha_hash);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Ler todos os alunos
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Atualizar dados de um aluno
    public function update($id, $nome, $email, $cpf, $rg, $endereco, $instituicao_id, $curso) {
        $query = "UPDATE " . $this->table_name . " SET
                  nome = :nome, email = :email, cpf = :cpf, rg = :rg, endereco = :endereco, instituicao_id = :instituicao_id, curso = :curso
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Binding
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":rg", $rg);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":instituicao_id", $instituicao_id);
        $stmt->bindParam(":curso", $curso);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Excluir um aluno
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Binding
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>