<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../config/conexao.php'; // Inclui a conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha
    $tipo = $_POST['tipo'];

    // Verifica se o campo curso_id foi enviado corretamente
    $curso_id = isset($_POST['curso_id']) ? intval($_POST['curso_id']) : null;

    // Verifica se o e-mail já existe
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Este e-mail já está cadastrado.";
    } else {
        // Insere o novo usuário no banco de dados
        if ($tipo == 'aluno') {
            $sql = "INSERT INTO usuarios (nome, email, senha, tipo, curso_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Erro na preparação da consulta: " . $conn->error);
            }
            $stmt->bind_param('ssssi', $nome, $email, $senha, $tipo, $curso_id);
        } else {
            // Para professores e secretários, curso_id não é necessário
            $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Erro na preparação da consulta: " . $conn->error);
            }
            $stmt->bind_param('ssss', $nome, $email, $senha, $tipo);
        }

        if ($stmt->execute()) {
            header("Location: ../views/login.php"); // Redireciona para a página de login após o cadastro
            exit();
        } else {
            echo "Erro ao cadastrar o usuário: " . $stmt->error;
        }
    }
}
?>