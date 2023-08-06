<?php

class Item {
    private $nome;
    private $concluido;
	private $prioridade;

    public function __construct($nome) { 
        $this->nome = $nome;
        $this->concluido = false;
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
}

?>