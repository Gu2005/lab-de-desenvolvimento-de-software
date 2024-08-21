<?php

require_once 'Usuario.php';

class Professor extends Usuario {
    private $idProfessor;

    public function __construct($idUsuario, $nome, $senha, $idProfessor) {
        parent::__construct($idUsuario, $nome, $senha);
        $this->idProfessor = $idProfessor;
    }

    public function visualizarAlunosMatriculados() {
        // será implemetado lógica para visualizar alunos matriculados
    }

    public function acessarListaDeAlunosInscritos() {
        // será implemetado lógica para acessar a lista de alunos inscritos
    }
}

?>