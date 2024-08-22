<?php

require_once 'Usuario.php';
require_once 'Disciplina.php'; // Incluindo a classe Disciplina

class Professor extends Usuario {
    private $idProfessor;

    public function __construct($idUsuario, $nome, $senha, $idProfessor) {
        parent::__construct($idUsuario, $nome, $senha);
        $this->idProfessor = $idProfessor;
    }

    public function visualizarDisciplinas($curso) {
        // Obter todas as disciplinas do curso
        $disciplinas = $curso->visualizarDisciplinas();
        // Lógica para visualizar as disciplinas
    }

    public function acessarListaDeAlunosInscritos($disciplina) {
        return $disciplina->visualizarAlunosMatriculados();
    }
}

?>