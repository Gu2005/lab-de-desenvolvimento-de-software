<?php
include_once '../config/conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica o login do usuário
    $sql = "SELECT id, nome, senha, tipo, curso_id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();
        
        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['tipo'] = $usuario['tipo'];
            $_SESSION['curso_id'] = $usuario['curso_id'];

            // Redireciona com base no tipo de usuário
            if ($usuario['tipo'] == 'aluno') {
                header("Location: ../views/painel_aluno.php");
            } elseif ($usuario['tipo'] == 'professor') {
                header("Location: ../views/painel_professor.php");
            } elseif ($usuario['tipo'] == 'secretario') {
                header("Location: ../views/painel_secretario.php");
            }
            exit();
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>