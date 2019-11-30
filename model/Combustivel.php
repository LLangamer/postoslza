<?php

class Combustivel {
    
  // Variaveis do tipo privado
    private $id;
    private $descricao;
    private $preco;
    private $id_posto;

    
    // Construtor da classe
    public function Combustivel($id, $descricao,$preco, $id_posto) {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->id_posto = $id_posto;
    }

    
    
//=============== Métodos Acessores GET & SET ===============     
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getId_posto() {
        return $this->id_posto;
    }

    public function setIdposto($id_posto) {
        $this->id_posto = $id_posto;
    }
}
?>