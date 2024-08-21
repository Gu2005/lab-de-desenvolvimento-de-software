<?php

require_once 'Usuario.php';

class Aluno extends Usuario {
    private $idAluno;
    private $matricula;

    public function __construct($idUsuario, $nome, $senha, $idAluno, $matricula) {
        parent::__construct($idUsuario, $nome, $senha);
        $this->idAluno = $idAluno;
        $this->matricula = $matricula;
    }

    public function matricularEmDisciplinas() {
        // será implementado lógica de matrícula em disciplinas
    }

    public function cancelarMatricula() {
        // será implemetado lógica de cancelamento de matrícula
    }

    public function verificarLimitesMatricula() {
        // será implemetado lógica de verificação de limites de matrícula
    }
}

?>