<?php
session_start();

if (!isset($_SESSION['curriculo'])) {
    die("Nenhum currículo gerado.");
}

$curriculo = $_SESSION['curriculo'];

// Agrupar disciplinas por período
$disciplinas_por_periodo = [];
foreach ($curriculo as $disciplina) {
    $periodo = $disciplina['periodo'];
    if (!isset($disciplinas_por_periodo[$periodo])) {
        $disciplinas_por_periodo[$periodo] = [];
    }
    $disciplinas_por_periodo[$periodo][] = $disciplina;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }
        h2 {
            color: #333;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Currículo do Curso</h1>
    <?php 
    // Ordenar os períodos para garantir a ordem correta
    ksort($disciplinas_por_periodo);
    foreach ($disciplinas_por_periodo as $periodo => $disciplinas): ?>
        <h2>Período <?php echo htmlspecialchars($periodo); ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Créditos</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($disciplinas as $disciplina): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($disciplina['nome']); ?></td>
                        <td><?php echo htmlspecialchars($disciplina['creditos']); ?></td>
                        <td><?php echo htmlspecialchars($disciplina['tipo']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</body>
</html>