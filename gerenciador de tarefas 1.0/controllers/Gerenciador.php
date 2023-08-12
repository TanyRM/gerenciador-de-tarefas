<?php

class Gerenciador {
    private $usuarios;

    public function __construct(){
        $this->usuarios = array();
    }

    public function validarDados($nome, $senha) {
        foreach ($this->usuarios as $usuario) {
            if ($nome === $usuario->getNome() && $senha === $usuario->getSenha()) {
                return true;
            }
        }
        return false;
    }

    public function adicionarUsuario($usuario){
        $this->usuarios[] = $usuario;
    }

    public function getUsuario($nomeUsuario) {
        foreach ($this->usuarios as $usuario) {
            if ($usuario->getNome() === $nomeUsuario) {
                return $usuario;
            }
        }
        return null;
    }
}


?>