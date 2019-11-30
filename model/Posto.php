<?php

class Posto {
    
  // Variaveis do tipo privado
    private $id;
    private $nome;
    private $bandeira;
    private $endereco;
    private $horario_a;
    private $horario_f;
    private $latitude;
    private $longitude;
    


    
    // Construtor da classe
    public function __construct($id, $nome, $bandeira, $endereco,$horario_a,$horario_f,$latitude,$longitude) {
        $this->id = $id;
        $this->nome = $nome;
        $this->bandeira = $bandeira;
        $this->endereco = $endereco;
        $this->horario_a = $horario_a;
        $this->horario_f = $horario_f;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
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

   public function getBandeira(){
        return $this->bandeira;
   }

   public function setBandeira($bandeira){
        $this->bandeira = $bandeira;
   }

    public function getEndereco(){
        return $this->endereco;
   }

   public function setEndereco($endereco){
        $this->endereco = $endereco;
   }
    public function getHorario_a(){
        return $this->horario_a;
   }

   public function setHorario_a($horario_a){
        $this->horario_a = $horario_a;
   }
   public function getHorario_f(){
        return $this->horario_f;
   }

   public function setHorario_f($horario_f){
        $this->horario_f = $horario_f;
   }

    public function getLatitude(){
        return $this->latitude;
   }

   public function setLatitude($latitude){
        $this->latitude = $latitude;
   }
   public function getLongitude(){
        return $this->longitude;
   }

   public function setLongitude($longitude){
        $this->longitude = $longitude;
   }
}
?>