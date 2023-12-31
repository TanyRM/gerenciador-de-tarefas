<?php 
class Usuario {
    private $nome;
    private $email;
    private $senha;
    private $listas;

    public function __construct($email, $nome, $senha){
        $this->email = $email;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->listas = array();
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getListas() {
        return $this->listas;
    }

    public function adicionarLista($lista) {
        $this->listas[] = $lista;
    }

    private function getIndiceLista($titulo) {
        foreach ($this->listas as $indice => $lista) {
            if ($lista->getTitulo() === $titulo) {
                return $indice;
            }
        }
        return false; // retorna false se a lista não for encontrada
    }

    public function excluirLista($lista) {
        $indice = $this->getIndiceLista($lista->getTitulo()); // encontra o índice da lista no array de listas do usuário
        if ($indice !== false) {
            array_splice($this->listas, $indice, 1); // se o índice for encontrado, remove apenas a lista do indice
        }
    }
}
?>