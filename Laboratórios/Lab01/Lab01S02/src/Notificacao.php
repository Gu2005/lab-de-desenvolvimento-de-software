<?php

class Notificacao {
    private $mensagem;

    public function __construct($mensagem) {
        $this->mensagem = $mensagem;
    }

    public function notificarLimiteVagas() {
        // será implemetado lógica de notificação de limite de vagas
    }
}

?>