<?php

class Servico {
    
  // Variaveis do tipo privado
    private $id;
    private $nome;
    private $id_posto;

    
    // Construtor da classe
    public function Servico($id, $nome, $id_posto) {
        $this->id = $id;
        $this->nome = $nome;
        $this->id_posto = $id_posto;
    }

    
    
//=============== Métodos Acessores GET & SET ===============     
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getId_posto() {
        return $this->id_posto;
    }

    public function setIdposto($id_posto) {
        $this->id_posto = $id_posto;
    }
}
?>