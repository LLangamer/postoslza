<?php

require_once 'Sql.php';
include 'Comentario.php';

class ComentarioDAO {

    var $conn;

    function ComentarioDAO() {
        $database = new Sql();
        $this->conn = $database->openConnection();
    }

    public function Create($comentario) {


        $sql = "INSERT INTO comentarios (descricao,id_usuario,id_posto)
                    VALUES ('" . $comentario->getDescricao() . "', '" . $comentario->getIdusuario() . "', '" . $comentario->getId_posto() . "')";

        $this->conn->exec($sql);
    }



    //=========== Pesquisa todos os Campos =============================
    public function Read() {

        $sql = "select * from comentarios";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $comentario = array();
        foreach ($result as $row) {
            $u = new Combustivel($row['id_comentario'], $row['descricao'], $row['id_usuario'], $row['id_posto']);

            array_push($comentario, $u);
        }

        return $comentario;
    }

   

    //=========== Pesquisa por ID =========================

    public function ReadByID($id) {

        $sql = "select * from comentarios WHERE id_comentario = $id ";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $comentario = array();
        foreach ($result as $row) {
            $u = new Usuario($row['id_comentario'], $row['descricao'], $row['id_usuario'], $row['id_posto']);
            array_push($comentario, $u);
        }
        return $comentario;
    }

    //================ UPDATE ===================

    public function Update($id,$descricao,$id_usuario,$id_posto) {
        $stmt = $this->conn->prepare('UPDATE comentarios SET descricao = :descricao, id_usuario = :id_usuario, id_posto = :id_posto WHERE id_comentario = :id');
        $stmt->execute(array(":id_comentario" => $id, ":descricao" => $descricao, ":id_usuario" => $id_usuario, ":id_posto" => $id_posto));
    }

    //=============== DELETE ===============

    public function Delete($id) {
        $this->conn->query("DELETE FROM comentarios WHERE id_comentario = '$id'");
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