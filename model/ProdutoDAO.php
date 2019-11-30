<?php

require_once 'Sql.php';
include 'Produto.php';

class ProdutoDAO {

    var $conn;

    function ProdutoDAO() {
        $database = new Sql();
        $this->conn = $database->openConnection();
    }

    public function Create($produto) {


        $sql = "INSERT INTO produtos (descricao,preco,id_posto)
                    VALUES ('" . $produto->getDescricao() . "', '" . $produto->getPreco() . "', '" . $produto->getId_posto() . "')";

        $this->conn->exec($sql);
    }



    //=========== Pesquisa todos os Campos =============================
    public function Read() {

        $sql = "select * from produtos";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $produtos = array();
        foreach ($result as $row) {
            $u = new Combustivel($row['id_produto'], $row['descricao'], $row['preco'], $row['id_posto']);

            array_push($produtos, $u);
        }

        return $produtos;
    }

   

    //=========== Pesquisa por ID =========================

    public function ReadByID($id) {

        $sql = "select * from produtos WHERE id_produto = $id ";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $produtos = array();
        foreach ($result as $row) {
            $u = new Usuario($row['id_produto'], $row['descricao'], $row['preco'], $row['id_posto']);
            array_push($produtos, $u);
        }
        return $produtos;
    }

    //================ UPDATE ===================

    public function Update($id,$descricao,$preco,$id_posto) {
        $stmt = $this->conn->prepare('UPDATE produtos SET descricao = :descricao, preco = :preco, id_posto = :id_posto WHERE id_combustivel = :id');
        $stmt->execute(array(":id_produto" => $id, ":descricao" => $descricao, ":preco" => $preco, ":id_posto" => $id_posto));
    }

    //=============== DELETE ===============

    public function Delete($id) {
        $this->conn->query("DELETE FROM produtos WHERE id_produto = '$id'");
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