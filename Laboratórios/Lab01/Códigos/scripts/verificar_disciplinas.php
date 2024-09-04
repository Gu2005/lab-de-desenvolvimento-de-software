<?php
include_once '../config/conexao.php';

// Verifica se ao menos 3 alunos estão matriculados em cada disciplina
$sql = "SELECT disciplina_id, COUNT(*) AS total_alunos FROM disciplinas_alunos GROUP BY disciplina_id";
$result = $conn->query($sql);

$disciplinas_para_cancelar = [];

while ($row = $result->fetch_assoc()) {
    if ($row['total_alunos'] < 3) {
        $disciplinas_para_cancelar[] = $row['disciplina_id'];
    }
}

// Atualiza o status das disciplinas
if (!empty($disciplinas_para_cancelar)) {
    $ids = implode(',', $disciplinas_para_cancelar);
    $sql_update = "UPDATE disciplinas SET ativa = 0 WHERE id IN ($ids)";
    if ($conn->query($sql_update)) {
        echo "Disciplinas canceladas com sucesso!";
    } else {
        echo "Erro ao cancelar disciplinas: " . $conn->error;
    }
} else {
    echo "Todas as disciplinas estão ativas.";
}
?>