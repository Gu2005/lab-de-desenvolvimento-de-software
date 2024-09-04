<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../config/conexao.php';
session_start();

// Verifica se o usuário é um aluno
if ($_SESSION['tipo'] != 'aluno') {
    header("Location: ../views/login.php");
    exit();
}

$aluno_id = $_SESSION['id']; // Assume que o ID do aluno está na sessão

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $disciplina_id = $_POST['disciplina_id'];
    $action = $_POST['action'];

    // Verifica se a disciplina existe na tabela 'disciplinas'
    $sql_check_disciplina = "SELECT COUNT(*) AS count, tipo FROM disciplinas WHERE id = ?";
    $stmt_check_disciplina = $conn->prepare($sql_check_disciplina);
    $stmt_check_disciplina->bind_param('i', $disciplina_id);
    $stmt_check_disciplina->execute();
    $result_check_disciplina = $stmt_check_disciplina->get_result();
    $row_check_disciplina = $result_check_disciplina->fetch_assoc();

    if ($row_check_disciplina['count'] == 0) {
        echo "Disciplina não encontrada.";
        exit();
    }

    $tipo_disciplina = $row_check_disciplina['tipo'];

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

    if ($action === 'matricular') {
        // Verifica se o aluno já está matriculado na disciplina
        $sql_check = "SELECT COUNT(*) AS count FROM disciplinas_alunos WHERE aluno_id = ? AND disciplina_id = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param('ii', $aluno_id, $disciplina_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();

        if ($row_check['count'] > 0) {
            echo "Você já está matriculado nesta disciplina.";
            exit();
        }

        // Verifica se o aluno atingiu o limite de matrículas para o tipo de disciplina
        if ($tipo_disciplina == 'obrigatória') {
            if ($matriculas_obrigatorias_count >= $limite_obrigatorias) {
                echo "Você já atingiu o limite de matrículas para disciplinas obrigatórias.";
                exit();
            }
        } elseif ($tipo_disciplina == 'optativa') {
            if ($matriculas_optativas_count >= $limite_optativas) {
                echo "Você já atingiu o limite de matrículas para disciplinas optativas.";
                exit();
            }
        }

        // Verifica o número de alunos matriculados na disciplina
        $sql_contagem = "SELECT COUNT(*) AS inscritos FROM disciplinas_alunos WHERE disciplina_id = ?";
        $stmt_contagem = $conn->prepare($sql_contagem);
        $stmt_contagem->bind_param('i', $disciplina_id);
        $stmt_contagem->execute();
        $result_contagem = $stmt_contagem->get_result();
        $row_contagem = $result_contagem->fetch_assoc();
        $inscritos = $row_contagem['inscritos'];

        $max_alunos = 60;

        if ($inscritos >= $max_alunos) {
            echo "O limite de alunos para esta disciplina foi atingido.";
            exit();
        }

        // Insere a nova matrícula
        $sql_insert = "INSERT INTO disciplinas_alunos (aluno_id, disciplina_id) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param('ii', $aluno_id, $disciplina_id);

        if ($stmt_insert->execute()) {
            // Notifica o sistema de cobranças
            $sql_notificar = "INSERT INTO notificacoes (aluno_id, disciplina_id, periodo) VALUES (?, ?, ?)";
            $periodo = 1; // Ou outro valor adequado
            $stmt_notificar = $conn->prepare($sql_notificar);
            $stmt_notificar->bind_param('iis', $aluno_id, $disciplina_id, $periodo);
            $stmt_notificar->execute();

            header("Location: ../views/painel_aluno.php?msg=Matricula realizada com sucesso!");
            exit();
        } else {
            echo "Erro ao realizar matrícula: " . $stmt_insert->error;
        }
    } elseif ($action === 'cancelar') {
        // Remove a matrícula
        $sql_delete = "DELETE FROM disciplinas_alunos WHERE aluno_id = ? AND disciplina_id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param('ii', $aluno_id, $disciplina_id);
        
        if ($stmt_delete->execute()) {
            // Notifica o sistema de cobranças sobre o cancelamento
            $sql_notificar = "INSERT INTO notificacoes (aluno_id, disciplina_id, periodo) VALUES (?, ?, ?)";
            $periodo = 1; // Ou outro valor adequado
            $stmt_notificar = $conn->prepare($sql_notificar);
            $stmt_notificar->bind_param('iis', $aluno_id, $disciplina_id, $periodo);
            $stmt_notificar->execute();

            header("Location: ../views/painel_aluno.php?msg=Matricula cancelada com sucesso!");
            exit();
        } else {
            echo "Erro ao cancelar matrícula: " . $stmt_delete->error;
        }
    }
} else {
    echo "Nenhum dado foi enviado via POST.";
}
?>