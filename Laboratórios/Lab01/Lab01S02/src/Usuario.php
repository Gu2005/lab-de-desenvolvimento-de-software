<?php

class Usuario {
    protected $idUsuario;
    protected $nome;
    protected $senha;

    public function __construct($idUsuario, $nome, $senha) {
        $this->idUsuario = $idUsuario;
        $this->nome = $nome;
        $this->senha = $senha;
    }

    public function login() {
        // será implemetado lógica de login
    }

    public function recuperarSenha() {
        // será implemetado lógica de recuperação de senha
    }
}

?>