<?php

class Disciplina {
    private $idDisciplina;
    private $codigo;
    private $nome;
    private $vagasDisponiveis;

    public function __construct($idDisciplina, $codigo, $nome, $vagasDisponiveis) {
        $this->idDisciplina = $idDisciplina;
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->vagasDisponiveis = $vagasDisponiveis;
    }

    public function atualizarDisponibilidade() {
        // será implemetado lógica de atualização de disponibilidade de vagas
    }
}

?>