<?php
include_once '../config/conexao.php';
session_start();

if ($_SESSION['tipo'] != 'secretario') {
    header("Location: login.php");
    exit();
}

// Contagem de alunos por curso
$sql_alunos_por_curso = "
    SELECT c.nome AS curso, COUNT(u.id) AS numero_alunos
    FROM cursos c
    LEFT JOIN usuarios u ON c.id = u.curso_id AND u.tipo = 'aluno'
    GROUP BY c.id, c.nome
";
$result_alunos_por_curso = $conn->query($sql_alunos_por_curso);

// Verifique se houve erro na execução da consulta
if ($conn->error) {
    die("Erro na consulta de alunos por curso: " . $conn->error);
}

// Contagem de alunos por disciplina com informações de curso e período
$sql_disciplinas_com_alunos = "
    SELECT c.nome AS curso, d.periodo, d.nome AS disciplina, COUNT(m.aluno_id) AS numero_alunos
    FROM disciplinas d
    LEFT JOIN cursos c ON d.curso_id = c.id
    LEFT JOIN matriculas m ON d.id = m.disciplina_id
    GROUP BY c.nome, d.periodo, d.nome
    ORDER BY c.nome, d.periodo, d.nome
";
$result_disciplinas_com_alunos = $conn->query($sql_disciplinas_com_alunos);

// Verifique se houve erro na execução da consulta
if ($conn->error) {
    die("Erro na consulta de disciplinas com número de alunos: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h2, h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .container h2 {
            margin-top: 0;
        }
        .container h3 {
            margin-bottom: 10px;
        }
        p {
            color: #666;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Relatórios</h2>

    <h3>Número de Alunos por Curso</h3>
    <table>
        <thead>
            <tr>
                <th>Curso</th>
                <th>Número de Alunos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_alunos_por_curso->num_rows > 0) {
                while ($row = $result_alunos_por_curso->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['curso']}</td>
                        <td>{$row['numero_alunos']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Nenhum dado encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h3>Número de Alunos por Disciplina Organizado</h3>
    <table>
        <thead>
            <tr>
                <th>Curso</th>
                <th>Período</th>
                <th>Disciplina</th>
                <th>Número de Alunos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_disciplinas_com_alunos->num_rows > 0) {
                while ($row = $result_disciplinas_com_alunos->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['curso']}</td>
                        <td>{$row['periodo']}</td>
                        <td>{$row['disciplina']}</td>
                        <td>{$row['numero_alunos']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum dado encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>