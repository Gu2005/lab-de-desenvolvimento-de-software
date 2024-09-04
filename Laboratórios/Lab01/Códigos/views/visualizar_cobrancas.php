<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../config/conexao.php';
session_start();

if ($_SESSION['tipo'] != 'aluno') {
    header("Location: ../views/login.php");
    exit();
}

// Obter o ID do aluno
$aluno_id = $_SESSION['id'];

// Listar disciplinas em que o aluno está matriculado
$sql_matriculas = "SELECT d.id, d.nome, d.tipo, d.valor
                   FROM disciplinas d
                   JOIN disciplinas_alunos da ON d.id = da.disciplina_id
                   WHERE da.aluno_id = ?";
$stmt_matriculas = $conn->prepare($sql_matriculas);
$stmt_matriculas->bind_param('i', $aluno_id);
$stmt_matriculas->execute();
$result_matriculas = $stmt_matriculas->get_result();

// Calcular o valor total das disciplinas matriculadas
$total_valor = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Cobranças</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1 {
            background-color: #007bff; /* Azul */
            color: white;
            padding: 10px;
            text-align: center;
            margin: 0;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff; /* Azul */
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #ddd;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        p {
            text-align: center;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #007bff; /* Azul */
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3; /* Azul escuro */
        }
    </style>
</head>
<body>
    <h1>Visualizar Cobranças</h1>

    <table>
        <thead>
            <tr>
                <th>Nome da Disciplina</th>
                <th>Tipo</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_matriculas->num_rows > 0) {
                while ($row = $result_matriculas->fetch_assoc()) {
                    $total_valor += $row['valor'];
                    echo "<tr>
                        <td>{$row['nome']}</td>
                        <td>{$row['tipo']}</td>
                        <td>R$ {$row['valor']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Você não está matriculado em nenhuma disciplina.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Valor Total: R$ <?php echo number_format($total_valor, 2, ',', '.'); ?></h2>

    <p><a href="painel_aluno.php">Voltar para o Painel do Aluno</a></p>
</body>
</html>