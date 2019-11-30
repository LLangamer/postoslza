<?php

class Comentario {
    
  // Variaveis do tipo privado
    private $id;
    private $descricao;
    private $id_posto;
    private $id_usuario;

    
    // Construtor da classe
    public function Combustivel($id, $descricao,$id_posto,$id_usuario) {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->id_posto = $id_posto;
        $this->id_usuario = $id_usuario;
    }

    
    
//=============== Métodos Acessores GET & SET ===============     
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
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