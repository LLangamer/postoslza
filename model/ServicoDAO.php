<?php

require_once 'Sql.php';
include 'Servico.php';

class ServicoDAO {

    var $conn;

    function ServicoDAO() {
        $database = new Sql();
        $this->conn = $database->openConnection();
    }

    public function Create($servico) {


        $sql = "INSERT INTO servicos (nome,id_posto)
                    VALUES ('" . $combustivel->getNome() . "',  '" . $combustivel->getId_posto() . "')";

        $this->conn->exec($sql);
    }



    //=========== Pesquisa todos os Campos =============================
    public function Read() {

        $sql = "select * from servicos";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $servicos = array();
        foreach ($result as $row) {
            $u = new Combustivel($row['id_servicos'], $row['nome'], $row['id_posto']);

            array_push($servicos, $u);
        }

        return $servicos;
    }

   

    //=========== Pesquisa por ID =========================

    public function ReadByID($id) {

        $sql = "select * from servicos WHERE id_servicos = $id ";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $servicos = array();
        foreach ($result as $row) {
            $u = new Usuario($row['id_servicos'], $row['nome'], $row['id_posto']);
            array_push($servicos, $u);
        }
        return $servicos;
    }

    //================ UPDATE ===================

    public function Update($id,$nome,$id_posto) {
        $stmt = $this->conn->prepare('UPDATE servicos SET nome = :nome, id_posto = :id_posto WHERE id_servicos = :id');
        $stmt->execute(array(":id_servicos" => $id, ":nome" => $nome, ":id_posto" => $id_posto));
    }

    //=============== DELETE ===============

    public function Delete($id) {
        $this->conn->query("DELETE FROM servicos WHERE id_servicos = '$id'");
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