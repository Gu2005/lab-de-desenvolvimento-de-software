<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../config/conexao.php';
session_start();

// Verifica se o usuário é um secretário
if ($_SESSION['tipo'] != 'secretario') {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';

    // Adicionar disciplina
    if ($action === 'adicionar') {
        $nome = $_POST['nome'] ?? '';
        $curso_id = $_POST['curso_id'] ?? 0;
        $creditos = $_POST['creditos'] ?? 0;
        $professor_id = $_POST['professor_id'] ?? 0;
        $tipo = $_POST['tipo'] ?? 'obrigatória';
        $periodo = $_POST['periodo'] ?? 1; // Defina um valor padrão se necessário

        $sql = "INSERT INTO disciplinas (nome, curso_id, creditos, professor_id, tipo, periodo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('siiisi', $nome, $curso_id, $creditos, $professor_id, $tipo, $periodo);
            if ($stmt->execute()) {
                header("Location: ../views/painel_secretario.php?msg=Disciplina adicionada com sucesso!");
                exit();
            } else {
                die("Erro ao adicionar a disciplina: " . $stmt->error);
            }
        } else {
            die("Erro na preparação da query: " . $conn->error);
        }
    }

    // Editar disciplina
    elseif ($action === 'editar') {
        $id = $_POST['id'] ?? 0;
        $nome = $_POST['nome'] ?? '';
        $curso_id = $_POST['curso_id'] ?? 0;
        $creditos = $_POST['creditos'] ?? 0;
        $professor_id = $_POST['professor_id'] ?? 0;
        $tipo = $_POST['tipo'] ?? 'obrigatória';
        $periodo = $_POST['periodo'] ?? 1; // Defina um valor padrão se necessário

        $sql = "UPDATE disciplinas SET nome = ?, curso_id = ?, creditos = ?, professor_id = ?, tipo = ?, periodo = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('siiisii', $nome, $curso_id, $creditos, $professor_id, $tipo, $periodo, $id);
            if ($stmt->execute()) {
                header("Location: ../views/painel_secretario.php?msg=Disciplina editada com sucesso!");
                exit();
            } else {
                die("Erro ao editar a disciplina: " . $stmt->error);
            }
        } else {
            die("Erro na preparação da query: " . $conn->error);
        }
    }

    // Excluir disciplina
    elseif ($action === 'excluir') {
        $id = $_POST['id'] ?? 0;

        $sql = "DELETE FROM disciplinas WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                header("Location: ../views/painel_secretario.php?msg=Disciplina excluída com sucesso!");
                exit();
            } else {
                die("Erro ao excluir a disciplina: " . $stmt->error);
            }
        } else {
            die("Erro na preparação da query: " . $conn->error);
        }
    }

    // Gerar currículo
    elseif ($action === 'gerar_curriculo') {
        $curso_id = $_POST['curso_id'] ?? 0;
        $sql_curriculo = "SELECT nome, creditos, tipo, periodo FROM disciplinas WHERE curso_id = ?";
        $stmt_curriculo = $conn->prepare($sql_curriculo);

        if ($stmt_curriculo) {
            $stmt_curriculo->bind_param('i', $curso_id);
            $stmt_curriculo->execute();
            $result = $stmt_curriculo->get_result();

            if ($result->num_rows > 0) {
                $curriculo = [];
                while ($row = $result->fetch_assoc()) {
                    $curriculo[] = $row;
                }

                $_SESSION['curriculo'] = $curriculo;
                header("Location: ../views/exibir_curriculo.php");
                exit();
            } else {
                die("Nenhuma disciplina encontrada para o curso selecionado.");
            }
        } else {
            die("Erro na preparação da query: " . $conn->error);
        }
    }

    // Ação não reconhecida
    else {
        die("Ação não reconhecida.");
    }
} else {
    die("Nenhum dado foi enviado via POST.");
}
?>