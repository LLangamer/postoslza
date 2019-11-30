<?php

require_once 'Sql.php';
include 'Telefone.php';

class TelefoneDAO {

    var $conn;

    function TelefoneDAO() {
        $database = new Sql();
        $this->conn = $database->openConnection();
    }

    public function Create($telefone) {


        $sql = "INSERT INTO telefones (ddd,numero,id_posto)
                    VALUES ('" . $produto->getDdd() . "', '" . $produto->getNumero() . "', '" . $produto->getId_posto() . "')";

        $this->conn->exec($sql);
    }



    //=========== Pesquisa todos os Campos =============================
    public function Read() {

        $sql = "select * from telefones";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $telefones = array();
        foreach ($result as $row) {
            $u = new Combustivel($row['id_telefone'], $row['ddd'], $row['numero'], $row['id_posto']);

            array_push($telefones, $u);
        }

        return $telefones;
    }

   

    //=========== Pesquisa por ID =========================

    public function ReadByID($id) {

        $sql = "select * from telefones WHERE id_telefone = $id ";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $telefones = array();
        foreach ($result as $row) {
            $u = new Usuario($row['id_telefone'], $row['ddd'], $row['numero'], $row['id_posto']);
            array_push($telefones, $u);
        }
        return $telefones;
    }

    //================ UPDATE ===================

    public function Update($id,$ddd,$numero,$id_posto) {
        $stmt = $this->conn->prepare('UPDATE telefones SET ddd = :ddd, numero = :numero, id_posto = :id_posto WHERE id_telefone = :id');
        $stmt->execute(array(":id_telefone" => $id, ":ddd" => $ddd, ":numero" => $numero, ":id_posto" => $id_posto));
    }

    //=============== DELETE ===============

    public function Delete($id) {
        $this->conn->query("DELETE FROM telefones WHERE id_telefone = '$id'");
    }

    //======================= Paginação ===========================
    public function itemPorPagina($pagina1, $qItens) {
        $pagina = intval($pagina1);
        $itens_por_pagina = $qItens;

        return $pagina;
    }

    public function numTotal($itens_por_pagina) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario");
        $stmt->execute();

        $numTotal = $stmt->rowCount();
        $numPagina = ceil($numTotal / $itens_por_pagina);
        return $numPagina;
    }

    public function paginacao($pagina, $numPagina, $itens_por_pagina) {

        if ($pagina >= $numPagina) {
            $pagina = 0;
        } else if ($pagina < 0) {
            $pagina = 0;
        }
        $paginaOffset = $pagina * $itens_por_pagina;

        $result = $this->conn->query("SELECT * FROM usuario  OFFSET $paginaOffset  LIMIT $itens_por_pagina");
        try {
            //$result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $usuario = array();
        foreach ($result as $row) {
            $u = new Usuario($row['idusuario'], $row['nome'], $row['cpf'], $row['rg'], $row['login'], $row['senha'], $row['email'], $row['telefone'], $row['cidade'], $row['estado'], $row['permissao'], $row['fotoperfil']);
            array_push($usuario, $u);
        }
        return $usuario;
    }

}

?>