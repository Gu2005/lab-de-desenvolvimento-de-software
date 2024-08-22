<?php

require_once 'Usuario.php';
require_once 'Curso.php'; // Incluindo a classe Curso

class Aluno extends Usuario {
    private $idAluno;
    private $matricula;
    private $curso; // Referência à classe Curso

    public function __construct($idUsuario, $nome, $senha, $idAluno, $matricula, $curso) {
        parent::__construct($idUsuario, $nome, $senha);
        $this->idAluno = $idAluno;
        $this->matricula = $matricula;
        $this->curso = $curso; // Inicializa o curso
    }

    public function matricularEmDisciplinas() {
        // será implemetado lógica de matrícula em disciplinas
    }

    public function cancelarMatricula() {
        // será implemetado lógica de cancelamento de matrícula
    }

    public function verificarLimitesMatricula() {
        // será implemetado lógica de verificação de limites de matrícula
    }
}

?>