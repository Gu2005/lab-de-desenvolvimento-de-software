<?php
include_once '../config/conexao.php';
session_start();

// Verifica se o usuário é um professor
if ($_SESSION['tipo'] != 'professor') {
    header("Location: login.php");
    exit();
}

// Obtém as disciplinas que o professor leciona
$sql_disciplinas = "SELECT * FROM disciplinas WHERE professor_id = ?";
$stmt_disciplinas = $conn->prepare($sql_disciplinas);
$stmt_disciplinas->bind_param('i', $_SESSION['id']);
$stmt_disciplinas->execute();
$disciplinas = $stmt_disciplinas->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Professor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #2c3e50;
        }
        h2 {
            color: #34495e;
        }
        h3 {
            color: #3498db; /* Azul */
        }
        h4 {
            color: #3498db; /* Azul */
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #f9f9f9;
            margin: 5px 0;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .message {
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <?php
    // Exibir mensagens de sucesso ou erro
    if (isset($_GET['msg'])) {
        echo "<p class='message'>" . htmlspecialchars($_GET['msg']) . "</p>";
    }

    // Exibir nome do professor logado
    $nome_professor = htmlspecialchars($_SESSION['nome']);
    echo "<h1><strong>Bem-vindo(a), $nome_professor!</strong></h1>";
    ?>
    
    <h2>Disciplinas que você leciona</h2>
    <?php if ($disciplinas->num_rows > 0): ?>
        <?php while ($disciplina = $disciplinas->fetch_assoc()) : ?>
            <h3><?= htmlspecialchars($disciplina['nome']) ?> (<?= htmlspecialchars($disciplina['creditos']) ?> créditos)</h3>
            <h4>Alunos Matriculados:</h4>
            <?php
            // Obter alunos matriculados na disciplina da tabela disciplinas_alunos
            $sql_alunos = "SELECT u.nome 
                           FROM usuarios u 
                           JOIN disciplinas_alunos da ON u.id = da.aluno_id 
                           WHERE da.disciplina_id = ?";
            $stmt_alunos = $conn->prepare($sql_alunos);
            if ($stmt_alunos === false) {
                echo "<p class='message'>Erro na preparação da consulta SQL: " . htmlspecialchars($conn->error) . "</p>";
            } else {
                $stmt_alunos->bind_param('i', $disciplina['id']);
                $stmt_alunos->execute();
                $alunos = $stmt_alunos->get_result();
            }
            ?>
            <ul>
                <?php if ($alunos->num_rows > 0): ?>
                    <?php while ($aluno = $alunos->fetch_assoc()) : ?>
                        <li><?= htmlspecialchars($aluno['nome']) ?></li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>Nenhum aluno matriculado.</li>
                <?php endif; ?>
            </ul>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nenhuma disciplina atribuída.</p>
    <?php endif; ?>
</body>
</html>