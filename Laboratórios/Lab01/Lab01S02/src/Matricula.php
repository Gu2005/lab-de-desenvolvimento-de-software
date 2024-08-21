<?php

class Matricula {
    private $idMatricula;
    private $data;
    private $status;

    public function __construct($idMatricula, $data, $status) {
        $this->idMatricula = $idMatricula;
        $this->data = $data;
        $this->status = $status;
    }

    public function verificarLimites() {
        // será implemetado lógica de verificação de limites de matrícula
    }

    public function atualizarDisponibilidade() {
        // será implemetado lógica de atualização de disponibilidade após matrícula
    }
}

?>