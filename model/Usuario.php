<?php

class Usuario {
    
// Variaveis do Tipo Privado
    private $idusuario;
    private $nome;
    private $login;
    private $senha;
    private $email;
    private $permissao;
    private $fotoperfil;

    // Construtor da Classe
    public function Usuario($idusuario, $nome, $login, $senha, $email, $permissao,$fotoperfil) {
        $this->idusuario = $idusuario;
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = $senha;
        $this->email = $email;
        $this->permissao = $permissao;
        $this->fotoperfil = $fotoperfil;
    }

//=============== Métodos Acessores GET & SET ===============      
    function getIdusuario() {
        return $this->idusuario;
    }

    function getNome() {
        return $this->nome;
    }
    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getEmail() {
        return $this->email;
    }
    function getPermissao() {
        return $this->permissao;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPermissao($permissao) {
        $this->permissao = $permissao;
    }

    function getFotoperfil() {
        return $this->fotoperfil;
    }

    function setFotoperfil($fotoperfil) {
        $this->fotoperfil = $fotoperfil;
    }



}