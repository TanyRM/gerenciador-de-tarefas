<?php 

class Lista{
    private $titulo;
    private $itens;

    public function __construct($titulo){
        $this->titulo = $titulo;
        $this->itens = array();
    }

	public function getTitulo() {
		return $this->titulo;
	}
	
	public function setTitulo($titulo): self {
		$this->titulo = $titulo;
		return $this;
	}

	public function getItens() {
		return $this->itens;
	}
	
    public function adicionarItem($item){
		$this->itens[] = $item;
    }
    
    public function excluirItem($indice){
        if (isset($this->itens[$indice])) {
            unset($this->itens[$indice]);
            $this->itens = array_values($this->itens);
        }
    }
}
?>