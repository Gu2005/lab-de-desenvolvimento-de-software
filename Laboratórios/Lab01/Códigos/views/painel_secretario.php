<?php
include_once '../config/conexao.php';
session_start();

if ($_SESSION['tipo'] != 'secretario') {
    header("Location: login.php");
    exit();
}

// Exibir mensagens de sucesso ou erro
if (isset($_GET['msg'])) {
    echo "<p>" . $_GET['msg'] . "</p>";
}

// Exibir nome do secretário logado
$nome_secretario = $_SESSION['nome'];
echo "<h1><strong>Bem-vindo(a), $nome_secretario!</strong></h1>";

// Listar disciplinas existentes
$sql = "SELECT d.id, d.nome, d.creditos, d.curso_id, d.professor_id, d.tipo, d.periodo,
               c.nome AS curso, u.nome AS professor 
        FROM disciplinas d 
        JOIN cursos c ON d.curso_id = c.id 
        LEFT JOIN usuarios u ON d.professor_id = u.id";
$result = $conn->query($sql);

// Verificar se é um pedido de edição
$editar_id = isset($_GET['edit_id']) ? intval($_GET['edit_id']) : 0;
$editar_dados = null;
if ($editar_id > 0) {
    $sql_edit = "SELECT * FROM disciplinas WHERE id = ?";
    $stmt_edit = $conn->prepare($sql_edit);
    $stmt_edit->bind_param('i', $editar_id);
    $stmt_edit->execute();
    $editar_dados = $stmt_edit->get_result()->fetch_assoc();
}

// Consultar alunos e disciplinas disponíveis para a matrícula
$sql_alunos = "SELECT id, nome FROM usuarios WHERE tipo = 'aluno'";
$result_alunos = $conn->query($sql_alunos);

$sql_disciplinas = "SELECT id, nome FROM disciplinas";
$result_disciplinas = $conn->query($sql_disciplinas);

// Adicionar matrícula
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adicionar_matricula'])) {
    $aluno_id = $_POST['aluno_id'];
    $disciplina_id = $_POST['disciplina_id'];

    // Preparar a consulta de inserção
    $sql_matricula = "INSERT INTO matriculas (aluno_id, disciplina_id) VALUES (?, ?)";
    $stmt_matricula = $conn->prepare($sql_matricula);

    if ($stmt_matricula) {
        $stmt_matricula->bind_param('ii', $aluno_id, $disciplina_id);
        if ($stmt_matricula->execute()) {
            echo "<p>Matrícula adicionada com sucesso!</p>";
        } else {
            echo "<p>Erro ao adicionar matrícula: " . $stmt_matricula->error . "</p>";
        }
    } else {
        echo "<p>Erro na preparação da query: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Secretário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1, h2 {
            color: #333;
        }
        p {
            color: #666;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
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
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .actions form {
            display: inline;
        }
        .actions button {
            background-color: #dc3545;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }
        .actions button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1><strong>Bem-vindo(a), <?php echo $nome_secretario; ?>!</strong></h1>

    <h2>Editar Disciplinas</h2>
    <form action="../controllers/disciplinas_controller.php" method="post">
        <input type="hidden" name="action" value="<?php echo $editar_id > 0 ? 'editar' : 'adicionar'; ?>">
        <input type="hidden" name="id" value="<?php echo $editar_dados['id'] ?? ''; ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $editar_dados['nome'] ?? ''; ?>" required>

        <label for="curso_id">Curso:</label>
        <select id="curso_id" name="curso_id" required>
            <option value="1" <?php echo (isset($editar_dados['curso_id']) && $editar_dados['curso_id'] == 1) ? 'selected' : ''; ?>>Engenharia de Software</option>
            <option value="2" <?php echo (isset($editar_dados['curso_id']) && $editar_dados['curso_id'] == 2) ? 'selected' : ''; ?>>Ciência da Computação</option>
        </select>

        <label for="creditos">Créditos:</label>
        <input type="number" id="creditos" name="creditos" value="<?php echo $editar_dados['creditos'] ?? ''; ?>" required>

        <label for="professor_id">Professor:</label>
        <select id="professor_id" name="professor_id">
            <?php
            $result_professores = $conn->query("SELECT id, nome FROM usuarios WHERE tipo = 'professor'");
            while ($professor = $result_professores->fetch_assoc()) {
                echo "<option value='{$professor['id']}' " . (isset($editar_dados['professor_id']) && $editar_dados['professor_id'] == $professor['id'] ? 'selected' : '') . ">{$professor['nome']}</option>";
            }
            ?>
        </select>

        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo">
            <option value="obrigatória" <?php echo (isset($editar_dados['tipo']) && $editar_dados['tipo'] == 'obrigatória') ? 'selected' : ''; ?>>Obrigatória</option>
            <option value="optativa" <?php echo (isset($editar_dados['tipo']) && $editar_dados['tipo'] == 'optativa') ? 'selected' : ''; ?>>Optativa</option>
        </select>

        <label for="periodo">Período:</label>
        <input type="number" id="periodo" name="periodo" value="<?php echo $editar_dados['periodo'] ?? ''; ?>" required>

        <button type="submit">Salvar</button>
    </form>



    <h2>Disciplinas Existentes</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Créditos</th>
                <th>Curso</th>
                <th>Professor</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nome']}</td>
                        <td>{$row['creditos']}</td>
                        <td>{$row['curso']}</td>
                        <td>{$row['professor']}</td>
                        <td>{$row['tipo']}</td>
                        <td class='actions'>
                            <a href='?edit_id={$row['id']}'>Editar</a>
                            <form action='../controllers/disciplinas_controller.php' method='POST'>
                                <input type='hidden' name='action' value='excluir'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit'>Excluir</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhuma disciplina cadastrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Gerar Currículo</h2>
    <form action="../controllers/disciplinas_controller.php" method="POST">
        <input type="hidden" name="action" value="gerar_curriculo">
        <select name="curso_id" required>
            <option value="">Selecione o Curso</option>
            <option value="1">Engenharia de Software</option>
            <option value="2">Ciência da Computação</option>
        </select>
        <button type="submit" name="gerar_curriculo">Gerar Currículo</button>
    </form>

    <h2>Relatórios</h2>
    <p><a href="relatorio.php">Ver Relatórios</a></p>
</div>

</body>
</html>