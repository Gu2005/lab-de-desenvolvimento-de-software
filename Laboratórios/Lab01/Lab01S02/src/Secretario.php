<?php

require_once 'Usuario.php';
require_once 'Curso.php'; // Incluindo a classe Curso

class Secretario extends Usuario {
    private $idSecretario;

    public function __construct($idUsuario, $nome, $senha, $idSecretario) {
        parent::__construct($idUsuario, $nome, $senha);
        $this->idSecretario = $idSecretario;
    }

    public function verificarDisciplinasAtivas($curso) {
        // Obter todas as disciplinas do curso
        $disciplinas = $curso->visualizarDisciplinas();
        // Lógica para verificar quais disciplinas estão ativas
    }

    public function acessarListaAlunosMatriculados($disciplina) {
        return $disciplina->visualizarAlunosMatriculados();
    }

    public function visualizarDisciplinasCanceladas($curso) {
        // Lógica para visualizar disciplinas canceladas no curso
        $disciplinas = $curso->visualizarDisciplinas();
        // Filtrar e visualizar disciplinas canceladas
    }
}

?>