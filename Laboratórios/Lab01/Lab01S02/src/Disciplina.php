<?php

class Disciplina {
    private $idDisciplina;
    private $codigo;
    private $nome;
    private $vagasDisponiveis;
    private $alunos; // Array para armazenar a lista de alunos matriculados
    private $curso; // Referência à classe Curso

    public function __construct($idDisciplina, $codigo, $nome, $vagasDisponiveis, $curso) {
        $this->idDisciplina = $idDisciplina;
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->vagasDisponiveis = $vagasDisponiveis;
        $this->alunos = []; // Inicializa o array de alunos
        $this->curso = $curso; // Inicializa o curso
    }

    // Método para adicionar um aluno à lista de matriculados
    public function matricularAluno($aluno) {
        if ($this->vagasDisponiveis > 0) {
            $this->alunos[] = $aluno;
            $this->vagasDisponiveis--;
        } else {
            echo "Não há mais vagas disponíveis para esta disciplina.";
        }
    }

    // Método para remover um aluno da lista de matriculados
    public function cancelarMatricula($aluno) {
        $index = array_search($aluno, $this->alunos);
        if ($index !== false) {
            unset($this->alunos[$index]);
            $this->vagasDisponiveis++;
            $this->alunos = array_values($this->alunos); // Reindexa o array após remover o aluno
        } else {
            echo "Aluno não está matriculado nesta disciplina.";
        }
    }

    // Método para visualizar todos os alunos matriculados
    public function visualizarAlunosMatriculados() {
        return $this->alunos;
    }

    public function atualizarDisponibilidade() {
        // será implemetado lógica de atualização de disponibilidade de vagas
    }
}

?>