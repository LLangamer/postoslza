<?php

require_once 'Sql.php';
include 'Usuario.php';

class UsuarioDAO {

    var $conn;

    function UsuarioDAO() {
        $database = new Sql();
        $this->conn = $database->openConnection();
    }

    public function Create($usuario) {


        $sql = "INSERT INTO usuario (nome, login, senha, email, permissao,fotoperfil)
                    VALUES ('" . $usuario->getNome() . "', '" . $usuario->getlogin() . "', '" . $usuario->getSenha() . "', '" . $usuario->getEmail() . "', '" . $usuario->getPermissao() . "','" . $usuario->getFotoperfil() . "')";

        $this->conn->exec($sql);
    }



    //=========== Pesquisa todos os Campos =============================
    public function Read() {

        $sql = "select * from usuario";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $usuario = array();
        foreach ($result as $row) {
            $u = new Usuario($row['id_usuario'], $row['nome'], $row['login'], $row['senha'], "", $row['tipo_permissao'],"");

            array_push($usuario, $u);
        }

        return $usuario;
    }

    //=========== Pesquisa Campos do Dono do Posto e Administrador =============================
    public function ReadProFeADM() {

        $sql = "SELECT * FROM usuario WHERE permissao != '2'";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $usuario = array();
        foreach ($result as $row) {
            $u = new Usuario($row['idusuario'], $row['nome'], $row['login'], $row['senha'], $row['email'], $row['permissao'], $row['foto']);

            array_push($usuario, $u);
        }

        return $usuario;
    }

    //=========== Pesquisa por ID =========================

    public function ReadByID($id) {

        $sql = "select * from usuario WHERE idusuario = $id ";
        try {
            $result = $this->conn->query($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $usuario = array();
        foreach ($result as $row) {
            $u = new Usuario($row['idusuario'], $row['nome'], $row['login'], $row['senha'], $row['email'], $row['permissao'], $row['foto']);
            array_push($usuario, $u);
        }
        return $usuario;
    }

    //================ UPDATE ===================

    public function Update($id, $nome, $login, $senha, $email, $permissao,$fotoperfil) {
        $stmt = $this->conn->prepare('UPDATE usuario SET nome = :nome, login = :login, senha = :senha, email = :email, permissao = :permissao, foto = :foto WHERE id_usuario = :id');
        $stmt->execute(array(":id" => $id, ":nome" => $nome, ":login" => $login, ":senha" => $senha, ":email" => $email, ":permissao" => $permissao, ":foto" => $fotoperfil));
    }
//================ UPDATE FOTO PERFIL ===================

    public function UpdateFoto($id,$fotoperfil) {
        $stmt = $this->conn->prepare('UPDATE usuario SET foto = :fotoperfil WHERE id_usuario = :id');
        $stmt->execute(array(":id_usuario" => $id,":foto" => $fotoperfil));
    }

    //=============== DELETE ===============

    public function Delete($id) {
        $this->conn->query("DELETE FROM usuario WHERE id_usuario = '$id'");
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