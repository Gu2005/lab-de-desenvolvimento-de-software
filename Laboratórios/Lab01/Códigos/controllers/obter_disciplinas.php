<?php
include_once '../config/conexao.php';

$curso_id = intval($_GET['curso_id']);

if ($curso_id == 1) {
    $sql = "SELECT * FROM disciplinas_es";
} elseif ($curso_id == 2) {
    $sql = "SELECT * FROM disciplinas_cc";
} else {
    echo json_encode([]);
    exit();
}

$result = $conn->query($sql);
$disciplinas = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $disciplinas[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($disciplinas);
?>