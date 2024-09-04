<?php
include_once '../config/conexao.php';
session_start();

// Verifica se o usuário é um aluno
if ($_SESSION['tipo'] != 'aluno') {
    header("Location: login.php");
    exit();
}

// Obtém as disciplinas disponíveis
$sql = "SELECT * FROM disciplinas WHERE curso_id = ? AND (SELECT COUNT(*) FROM matriculas WHERE disciplina_id = disciplinas.id) < 60";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_SESSION['curso_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Matrícula</title>
</head>
<body>
    <h1>Escolha suas disciplinas</h1>
    <form action="../controllers/matricula_controller.php" method="POST">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div>
                <input type="checkbox" id="disciplina_<?= $row['id'] ?>" name="disciplinas[]" value="<?= $row['id'] ?>">
                <label for="disciplina_<?= $row['id'] ?>"><?= $row['nome'] ?> (<?= $row['creditos'] ?> créditos)</label>
            </div>
        <?php endwhile; ?>
        <button type="submit">Matricular-se</button>
    </form>
</body>
</html>