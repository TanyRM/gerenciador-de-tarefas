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

    public function setNome($nome): self {
        $this->nome = $nome;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email): self {
        $this->email = $email;
        return $this;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha): self {
        $this->senha = $senha;
        return $this;
    }

    public function getListas() {
        return $this->listas;
    }

    public function setListas($listas): self {
        $this->listas = $listas;
        return $this;
    }

    public function adicionarLista($lista) {
        $this->listas[] = $lista;
    }

    private function getIndiceListaPorTitulo($titulo) {
        foreach ($this->listas as $indice => $lista) {
            if ($lista->getTitulo() === $titulo) {
                return $indice;
            }
        }
        return false; // Retorna false se a lista não for encontrada
    }

    public function excluirLista($lista) {
        // Encontra o índice da lista no array de listas do usuário
        $indice = $this->getIndiceListaPorTitulo($lista->getTitulo());

        // Se o índice for encontrado, remove a lista
        if ($indice !== false) {
            array_splice($this->listas, $indice, 1);
        }
    }
}
?>