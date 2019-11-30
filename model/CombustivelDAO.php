<?php

require_once 'Sql.php';
include 'Combustivel.php';

class CombustivelDAO {

    var $conn;

    function CombustivelDAO() {
        $database = new Sql();
        $this->conn = $database->openConnection();
    }

    public function Create($combustivel) {


        $sql = "INSERT INTO combustivel (descricao,preco,id_posto)
                    VALUES ('" . $combustivel->getDescricao() . "', '" . $combustivel->getPreco() . "', '" . $combustivel->getId_posto() . "')";

        $this->conn->exec($sql);
    }



    //=========== Pesquisa todos os Campos =============================
    public function Read() {

        $sql = "select * from combustivel";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $combustivel = array();
        foreach ($result as $row) {
            $u = new Combustivel($row['id_combustivel'], $row['descricao'], $row['preco'], $row['id_posto']);

            array_push($combustivel, $u);
        }

        return $combustivel;
    }

   

    //=========== Pesquisa por ID =========================

    public function ReadByID($id) {

        $sql = "select * from combustivel WHERE id_combustivel = $id ";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $combustivel = array();
        foreach ($result as $row) {
            $u = new Usuario($row['id_combustivel'], $row['descricao'], $row['preco'], $row['id_posto']);
            array_push($combustivel, $u);
        }
        return $combustivel;
    }

    //================ UPDATE ===================

    public function Update($id,$descricao,$preco,$id_posto) {
        $stmt = $this->conn->prepare('UPDATE combustivel SET descricao = :descricao, preco = :preco, id_posto = :id_posto WHERE id_combustivel = :id');
        $stmt->execute(array(":id_combustivel" => $id, ":descricao" => $descricao, ":preco" => $preco, ":id_posto" => $id_posto));
    }

    //=============== DELETE ===============

    public function Delete($id) {
        $this->conn->query("DELETE FROM combustivel WHERE id_combustivel = '$id'");
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