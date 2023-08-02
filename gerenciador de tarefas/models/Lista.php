<?php 

class Lista{
    private $titulo;
    private $itens;
	private $ID;
	private static $contadorIds = 0;

    public function __construct($titulo){
		self::$contadorIds++;
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
	
	public function setItens($itens): self {
		$this->itens = $itens;
		return $this;
	}

    public function adicionarItem($item){
		$this->itens[] = $item;
    }
    
    public function excluirItem(){

    }

	public function getID() {
		return $this->ID;
	}
	
	public function setID($ID): self {
		$this->ID = $ID;
		return $this;
	}
}
?>