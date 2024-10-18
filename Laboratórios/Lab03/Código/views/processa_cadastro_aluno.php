<?php
include_once 'Database.php';
include_once 'AlunoDAO.php';

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Capturar os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $endereco = $_POST['endereco'];
    $instituicao_id = $_POST['instituicao_id'];
    $curso = $_POST['curso'];
    $senha = $_POST['senha'];
    
    // Conectar ao banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Instanciar o AlunoDAO
    $alunoDAO = new AlunoDAO($db);

    // Criar o aluno no banco de dados
    if ($alunoDAO->create($nome, $email, $cpf, $rg, $endereco, $instituicao_id, $curso, $senha)) {
        echo "Aluno cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar aluno.";
    }
}
?>