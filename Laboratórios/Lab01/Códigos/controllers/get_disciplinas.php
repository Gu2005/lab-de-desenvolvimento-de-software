<?php
include_once '../config/conexao.php';

$curso_id = isset($_GET['curso_id']) ? intval($_GET['curso_id']) : 0;
$periodo = isset($_GET['periodo']) ? intval($_GET['periodo']) : 0;

if ($curso_id && $periodo) {
    $sql = "SELECT id, nome FROM disciplinas WHERE curso_id = ? AND periodo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $curso_id, $periodo);
    $stmt->execute();
    $result = $stmt->get_result();

    $disciplinas = array();
    while ($row = $result->fetch_assoc()) {
        $disciplinas[] = $row;
    }

    echo json_encode($disciplinas);
} else {
    echo json_encode(array('error' => 'Parâmetros inválidos.'));
}
?>