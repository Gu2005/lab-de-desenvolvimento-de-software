<?php
include_once '../config/conexao.php';
session_start();

// Verifica se o usuário é um aluno
if ($_SESSION['tipo'] != 'aluno') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $disciplinas = $_POST['disciplinas'];

    // Verifica se o aluno escolheu até 6 disciplinas (4 obrigatórias + 2 optativas)
    if (count($disciplinas) > 6) {
        echo "Você pode escolher no máximo 6 disciplinas.";
        exit();
    }

    // Insere as matrículas
    foreach ($disciplinas as $disciplina_id) {
        // Insere na tabela de matrículas
        $sql_matricula = "INSERT INTO matriculas (aluno_id, disciplina_id, data_matricula) VALUES (?, ?, NOW())";
        $stmt_matricula = $conn->prepare($sql_matricula);
        $stmt_matricula->bind_param('ii', $_SESSION['id'], $disciplina_id);

        if (!$stmt_matricula->execute()) {
            echo "Erro ao matricular-se na disciplina: " . $stmt_matricula->error;
            exit();
        }

        // Insere na tabela de notificações
        $sql_notificacao = "INSERT INTO notificacoes (aluno_id, disciplina_id, periodo) VALUES (?, ?, (SELECT periodo FROM disciplinas WHERE id = ?))";
        $stmt_notificacao = $conn->prepare($sql_notificacao);
        $stmt_notificacao->bind_param('iii', $_SESSION['id'], $disciplina_id, $disciplina_id);

        if (!$stmt_notificacao->execute()) {
            echo "Erro ao adicionar a notificação: " . $stmt_notificacao->error;
            exit();
        }
    }

    header("Location: ../views/painel_aluno.php"); // Redireciona para o painel do aluno após a matrícula
    exit();
}
?>