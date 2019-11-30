<?php

class Telefone {
    
  // Variaveis do tipo privado
    private $id;
    private $ddd;
    private $numero;
    private $id_posto;

    
    // Construtor da classe
    public function Telefone($id, $ddd,$numero, $id_posto) {
        $this->id = $id;
        $this->ddd = $ddd;
        $this->numero = $numero;
        $this->id_posto = $id_posto;
    }

    
    
//=============== Métodos Acessores GET & SET ===============     
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDdd() {
        return $this->ddd;
    }

    public function setDdd($ddd) {
        $this->preco = $ddd;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getId_posto() {
        return $this->id_posto;
    }

    public function setIdposto($id_posto) {
        $this->id_posto = $id_posto;
    }
}
?>