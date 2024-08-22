<?php

class Curso {
    private $IDCurso;
    private $nome;
    private $disciplinas; // Array para armazenar as disciplinas que fazem parte do curso

    public function __construct($IDCurso, $nome) {
        $this->IDCurso = $IDCurso;
        $this->nome = $nome;
        $this->disciplinas = []; // Inicializa o array de disciplinas
    }

    // Método para adicionar uma disciplina ao curso
    public function adicionarDisciplina($disciplina) {
        $this->disciplinas[] = $disciplina;
    }

    // Método para remover uma disciplina do curso
    public function removerDisciplina($disciplina) {
        $index = array_search($disciplina, $this->disciplinas);
        if ($index !== false) {
            unset($this->disciplinas[$index]);
            $this->disciplinas = array_values($this->disciplinas); // Reindexa o array após remover a disciplina
        } else {
            echo "Disciplina não encontrada no curso.";
        }
    }

    // Método para visualizar todas as disciplinas do curso (opcional)
    public function visualizarDisciplinas() {
        return $this->disciplinas;
    }

    // Método para retornar o nome do curso (opcional)
    public function getNome() {
        return $this->nome;
    }

    // Método para retornar o ID do curso (opcional)
    public function getIDCurso() {
        return $this->IDCurso;
    }
}

?>