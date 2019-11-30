<?php

require_once 'Sql.php';
require_once 'Posto.php';

class PostoDAO {

    var $conn;

    function cursoDAO() {
        $database = new Sql();
        $this->conn = $database->openConnection();
    }

    public function Create($posto) {
        $sql = "INSERT INTO posto (bandeira, nome, endereco, horario_a,horario_f,latitude,longitude) VALUES ('" . $bandeira->getBandeira() . "', '" . $posto->getNome() . "', '" . $posto->getEndereco() . "' , '" . $posto->getHorario_a() . "' , '" . $posto->getHorario_f() . "' , '" . $posto->getLatitude() . "' , '" . $posto->getLongitude() ."')";

        $this->conn->exec($sql);
    }

    /*  public function Create($nomecurso, $descricao, $cargahoraria) {


      $sql = "INSERT INTO curso (nomecurso, descricao, cargahoraria)
      VALUES ('$nomecurso', '$descricao', '$cargahoraria')";

      $this->conn->exec($sql);
      } */

    //=========== Pesquisa todos os Campos =============================
    public function Read() {

        $sql = "select * from posto";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $postos = array();
        foreach ($result as $row) {
            $c = new Posto($row['id_posto'], $row['bandeira'], $row['nome'], $row['endereco'], $row['horario_a'],$row['horario_f'], $row['latitude'],$row['longitude']);
            array_push($postos, $c);
        }
        return $postos;
    }

    
    
        

    //=========== Pesquisa por ID =============================

    public function ReadByID($id) {

        $sql = "select * from posto WHERE id_posto = $id ";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $postos = array();
        foreach ($result as $row) {
            $c = new Posto($row['id_posto'], $row['bandeira'], $row['nome'], $row['endereco'], $row['horario_a'],$row['horario_f'], $row['latitude'],$row['longitude']);
            array_push($postos, $c);
        }
        return $postos;
    }

    //================ UPDATE ===================

    public function Update($id, $bandeira, $nome, $endereco, $horario_a,$horario_f, $latitude,$longitude) {
        $stmt = $this->conn->prepare('UPDATE posto SET bandeira = :bandeira,nome = :nome,endereco = :endereco, horario_a = 
        :horario_a, horario_f = :horario_f, latitude = :latitude, longitude = :longitude WHERE id_posto = :id');
        $stmt->execute(array(":id" => $id, ":bandeira" => $bandeira, ":nome" => $nome, ":endereco" => $endereco,":horario_a" => $horario_a, ":horario_f" => $horario_f, ":latitude" => $latitude, ":longitude" => $longitude));
    }

    //=============== DELETE ===============

    public function Delete($id) {
        $this->conn->query("DELETE FROM posto WHERE id_posto = '$id'");
    }

    
}

?>