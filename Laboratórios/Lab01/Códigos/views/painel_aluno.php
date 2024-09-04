<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../config/conexao.php';
session_start();

if ($_SESSION['tipo'] != 'aluno') {
    header("Location: ../views/login.php");
    exit();
}

// Exibir mensagens de sucesso ou erro
if (isset($_GET['msg'])) {
    echo "<p class='message'>" . $_GET['msg'] . "</p>";
}

// Exibir nome do aluno logado
$nome_aluno = $_SESSION['nome'];
echo "<h1><strong>Bem-vindo(a), $nome_aluno!</strong></h1>";

// Obter o ID do curso do aluno
$aluno_id = $_SESSION['id'];
$sql_curso = "SELECT curso_id FROM usuarios WHERE id = ?";
$stmt_curso = $conn->prepare($sql_curso);
$stmt_curso->bind_param('i', $aluno_id);
$stmt_curso->execute();
$result_curso = $stmt_curso->get_result();

if ($result_curso->num_rows > 0) {
    $curso = $result_curso->fetch_assoc();
    $curso_id = $curso['curso_id'];

    // Definir a tabela de disciplinas com base no curso
    $disciplinas_table = $curso_id == 1 ? 'disciplinas_es' : 'disciplinas_cc';

    // Listar disciplinas em que o aluno está matriculado
    $sql_matriculas = "SELECT d.id, d.nome, d.tipo, d.valor, c.nome AS curso, u.nome AS professor
                       FROM disciplinas d
                       JOIN cursos c ON d.curso_id = c.id
                       LEFT JOIN usuarios u ON d.professor_id = u.id
                       JOIN disciplinas_alunos da ON d.id = da.disciplina_id
                       WHERE da.aluno_id = ?";
    $stmt_matriculas = $conn->prepare($sql_matriculas);
    $stmt_matriculas->bind_param('i', $aluno_id);
    $stmt_matriculas->execute();
    $result_matriculas = $stmt_matriculas->get_result();

    // Listar períodos disponíveis para seleção
    $periodos = range(1, 3); // Supondo que existem 3 períodos

    // Listar disciplinas disponíveis para matrícula do curso do aluno com base no período selecionado
    if (isset($_POST['periodo'])) {
        $periodo = $_POST['periodo'];
    } else {
        $periodo = 1; // Definir um período padrão (por exemplo, o 1º período)
    }

    $sql_disciplinas = "SELECT d.id, d.nome, d.tipo, d.valor
                        FROM disciplinas d
                        WHERE d.curso_id = ? AND d.periodo = ? AND d.id NOT IN (SELECT da.disciplina_id FROM disciplinas_alunos da WHERE da.aluno_id = ?)";
    $stmt_disciplinas = $conn->prepare($sql_disciplinas);
    $stmt_disciplinas->bind_param('iii', $curso_id, $periodo, $aluno_id);
    $stmt_disciplinas->execute();
    $result_disciplinas = $stmt_disciplinas->get_result();
} else {
    echo "Erro ao obter o curso do aluno.";
}

// Verificar se a matrícula foi solicitada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'matricular') {
        $disciplina_id = $_POST['disciplina_id'] ?? 0;

        if ($disciplina_id > 0) {
            // Verifica o tipo da disciplina
            $sql_tipo = "SELECT tipo FROM disciplinas WHERE id = ?";
            $stmt_tipo = $conn->prepare($sql_tipo);
            $stmt_tipo->bind_param('i', $disciplina_id);
            $stmt_tipo->execute();
            $result_tipo = $stmt_tipo->get_result();
            $row_tipo = $result_tipo->fetch_assoc();
            $tipo_disciplina = $row_tipo['tipo'];

            // Verifica o número de matrículas do aluno para cada tipo de disciplina
            $sql_count_obrigatorias = "SELECT COUNT(*) AS count FROM disciplinas_alunos da
                                       JOIN disciplinas d ON da.disciplina_id = d.id
                                       WHERE da.aluno_id = ? AND d.tipo = 'obrigatória'";
            $stmt_count_obrigatorias = $conn->prepare($sql_count_obrigatorias);
            $stmt_count_obrigatorias->bind_param('i', $aluno_id);
            $stmt_count_obrigatorias->execute();
            $result_count_obrigatorias = $stmt_count_obrigatorias->get_result();
            $row_count_obrigatorias = $result_count_obrigatorias->fetch_assoc();
            $matriculas_obrigatorias_count = $row_count_obrigatorias['count'];

            $sql_count_optativas = "SELECT COUNT(*) AS count FROM disciplinas_alunos da
                                    JOIN disciplinas d ON da.disciplina_id = d.id
                                    WHERE da.aluno_id = ? AND d.tipo = 'optativa'";
            $stmt_count_optativas = $conn->prepare($sql_count_optativas);
            $stmt_count_optativas->bind_param('i', $aluno_id);
            $stmt_count_optativas->execute();
            $result_count_optativas = $stmt_count_optativas->get_result();
            $row_count_optativas = $result_count_optativas->fetch_assoc();
            $matriculas_optativas_count = $row_count_optativas['count'];

            // Define os limites de matrículas
            $limite_obrigatorias = 4;
            $limite_optativas = 2;

            // Verifica se o aluno atingiu o limite de matrículas para o tipo de disciplina
            if (($tipo_disciplina == 'obrigatória' && $matriculas_obrigatorias_count >= $limite_obrigatorias) ||
                ($tipo_disciplina == 'optativa' && $matriculas_optativas_count >= $limite_optativas)) {
                echo "Você já atingiu o limite de matrículas para disciplinas $tipo_disciplina.";
                exit();
            }

            // Adicionar matrícula
            $sql_matricula = "INSERT INTO disciplinas_alunos (aluno_id, disciplina_id) VALUES (?, ?)";
            $stmt_matricula = $conn->prepare($sql_matricula);
            $stmt_matricula->bind_param('ii', $aluno_id, $disciplina_id);
            if ($stmt_matricula->execute()) {
                // Adicionar notificação
                $sql_notificacao = "INSERT INTO notificacoes (aluno_id, disciplina_id, periodo) VALUES (?, ?, ?)";
                $stmt_notificacao = $conn->prepare($sql_notificacao);
                $stmt_notificacao->bind_param('iii', $aluno_id, $disciplina_id, $periodo);
                if ($stmt_notificacao->execute()) {
                    header("Location: ../views/painel_aluno.php?msg=Matricula realizada com sucesso!");
                    exit();
                } else {
                    echo "Erro ao adicionar a notificação: " . $stmt_notificacao->error;
                }
            } else {
                echo "Erro ao matricular na disciplina: " . $stmt_matricula->error;
            }
        } else {
            echo "Disciplina inválida.";
        }
    } elseif ($_POST['action'] === 'cancelar') {
        $disciplina_id = $_POST['disciplina_id'] ?? 0;

        if ($disciplina_id > 0) {
            // Remover matrícula
            $sql_cancelar = "DELETE FROM disciplinas_alunos WHERE aluno_id = ? AND disciplina_id = ?";
            $stmt_cancelar = $conn->prepare($sql_cancelar);
            $stmt_cancelar->bind_param('ii', $aluno_id, $disciplina_id);
            if ($stmt_cancelar->execute()) {
                header("Location: ../views/painel_aluno.php?msg=Matrícula cancelada com sucesso!");
                exit();
            } else {
                echo "Erro ao cancelar a matrícula: " . $stmt_cancelar->error;
            }
        } else {
            echo "Disciplina inválida.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Aluno</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        h2 {
            color: #555;
            border-bottom: 2px solid #eee;
            padding-bottom: 5px;
        }

        p.message {
            color: green;
            font-weight: bold;
            border: 1px solid #d4edda;
            background-color: #d4edda;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form select, form button {
            padding: 8px;
            margin-right: 10px;
        }

        form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>Painel do Aluno</h1>

<h2>Disciplinas em que você está matriculado:</h2>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Curso</th>
            <th>Professor</th>
            <th>Cancelar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result_matriculas->num_rows > 0) {
            while ($row = $result_matriculas->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['nome']}</td>
                    <td>{$row['tipo']}</td>
                    <td>R$ " . number_format($row['valor'], 2, ',', '.') . "</td>
                    <td>{$row['curso']}</td>
                    <td>{$row['professor']}</td>
                    <td>
                        <form method='POST' action=''>
                            <input type='hidden' name='action' value='cancelar'>
                            <input type='hidden' name='disciplina_id' value='{$row['id']}'>
                            <button type='submit'>Cancelar</button>
                        </form>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Você não está matriculado em nenhuma disciplina.</td></tr>";
        }
        ?>
    </tbody>
</table>

<h2>Matricule-se em novas disciplinas:</h2>

<form method="POST" action="">
    <label for="periodo">Selecione o período:</label>
    <select id="periodo" name="periodo">
        <?php foreach ($periodos as $p): ?>
            <option value="<?= $p ?>" <?= $p == $periodo ? 'selected' : '' ?>>Período <?= $p ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Filtrar Disciplinas</button>
</form>

<form method="POST" action="">
    <input type="hidden" name="action" value="matricular">
    <label for="disciplina">Selecione a disciplina:</label>
    <select id="disciplina" name="disciplina_id">
        <?php
        if ($result_disciplinas->num_rows > 0) {
            while ($row = $result_disciplinas->fetch_assoc()) {
                $tipo_disciplina = $row['tipo'] == 'obrigatória' ? 'Obrigatória' : 'Optativa';
                echo "<option value='{$row['id']}'>{$row['nome']} (R$ " . number_format($row['valor'], 2, ',', '.') . ") - $tipo_disciplina</option>";
            }
        } else {
            echo "<option value=''>Nenhuma disciplina disponível.</option>";
        }
        ?>
    </select>
    <button type="submit">Matricular</button>
</form>

<h2>Visualizar Cobranças:</h2>
<a href="../views/visualizar_cobrancas.php">Clique aqui para visualizar suas cobranças</a>

<a href="../views/login.php">Sair</a>

</body>
</html>