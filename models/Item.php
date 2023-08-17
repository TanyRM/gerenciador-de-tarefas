<?php

class Item {
    private $nome;
    private $concluido;
    private $prioridade;

    public function __construct($nome) { 
        $this->nome = $nome;
        $this->concluido = false;
	    $this->prioridade = 0;
    }
    
    public function getNome() {
	    return $this->nome;
    }
	
    public function setNome($nome): self {
	    $this->nome = $nome;
	    return $this;
    }
	
    public function getConcluido() {
	    return $this->concluido;
    }
	
    public function setConcluido($concluido): self {
	    $this->concluido = $concluido;
	    return $this;
    }
	
    public function getPrioridade() {
        return $this->prioridade;
    }

    public function setPrioridade($prioridade) {
        $this->prioridade = $prioridade;
    }
}

?>
