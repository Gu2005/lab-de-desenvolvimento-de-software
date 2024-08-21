<?php

require_once 'Usuario.php';

class Secretario extends Usuario {
    private $idSecretario;

    public function __construct($idUsuario, $nome, $senha, $idSecretario) {
        parent::__construct($idUsuario, $nome, $senha);
        $this->idSecretario = $idSecretario;
    }

    public function verificarDisciplinasAtivas() {
        // será implemetado lógica de verificação de disciplinas ativas
    }

    public function acessarListaAlunosMatriculados() {
        // será implemetado lógica para acessar a lista de alunos matriculados
    }

    public function visualizarDisciplinasCanceladas() {
        // será implemetado lógica para visualizar disciplinas canceladas
    }
}

?>