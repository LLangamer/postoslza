<?php

require_once 'Sql.php';
require_once 'Posto.php';

class PostoDAO {

    var $conn;

    function PostoDAO() {
        $database = new Sql();
        $this->conn = $database->openConnection();
    }

    public function Create($posto) {
        $sql = "INSERT INTO posto (bandeira, nome, endereco, horario_a,horario_f,latitude,longitude) VALUES ('" . $posto->getBandeira() . "', '" . $posto->getNome() . "', '" . $posto->getEndereco() . "' , '" . $posto->getHorario_a() . "' , '" . $posto->getHorario_f() . "' , '" . $posto->getLongitude() . "' , '" . $posto->getLatitude() ."')";

        $this->conn->exec($sql);
    }

    /*  public function Create($nomecurso, $descricao, $cargahoraria) {


      $sql = "INSERT INTO curso (nomecurso, descricao, cargahoraria)
      VALUES ('$nomecurso', '$descricao', '$cargahoraria')";

      $this->conn->exec($sql);
      } */

    //=========== Pesquisa todos os Campos =============================
    public function Read() {

       // $sql = "select * from posto";
        try {
        $result = $this->conn->query("SELECT * FROM posto");
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $postos = array();
        foreach ($result as $row) {
            $c = new Posto($row['id_posto'], $row['nome'], $row['bandeira'], $row['endereco'], $row['horario_a'],$row['horario_f'], $row['latitude'],$row['longitude']);
            $c1 = array(
                'id_posto'=>$row['id_posto'],
                'bandeira'=>$row['bandeira'],
                'nome'=>$row['nome'],
                'endereco'=>$row['endereco'],
                'horario_a'=>$row['horario_a'],
                'horario_f'=>$row['horario_f'],
                'latitude'=>$row['latitude'],
                'longitude'=>$row['longitude']
            );
            array_push($postos, $c);
        }
        return $postos;
    }


    public function numeroDeLinhasDaTabela(){
         try {
        $result = $this->conn->query("SELECT * FROM posto");
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        
       
        return $result->rowCount();

    }

     public function ids(){
         try {
        $result = $this->conn->query("SELECT id_posto FROM posto");
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        
        $ids = array();

        foreach ($result as  $row) {
            $i = array(
                'id_posto'=>$row['id_posto']
                
            );
            array_push($ids, $i);
        }
        return $ids;

    }

    public function informarJSID(){
        $info = $this->ids();
        $a = "";
        for ($i=0; $i < $this->numeroDeLinhasDaTabela() ; $i++) { 
            
            $a .= implode(",", $info[$i]) . ",";
        }
       

        return $a;
    }
    
    public function informarJS(){
        $info = $this->Read();
        $a = "";
        for ($i=0; $i < $this->numeroDeLinhasDaTabela() ; $i++) { 
            
            $a .= implode("|", $info[$i]) . "|";
        }
       

        return $a;
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