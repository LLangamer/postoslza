<?php
include'../UsuarioDAO.php';
session_start();

$login = $_POST['login'];
$senha = $_POST['senha'];


    

   
   $daousuario= new UsuarioDAO();
	
	$UsuarioDAO = $daousuario->Read();

	foreach ($UsuarioDAO as  $row) {
		$loginu = $row->getLogin();
		$senhau = $row->getSenha();
		$nome = $row->getNome();
		
		if( $login == $loginu && $senha == $senhau){

			$_SESSION['nome'] = $nome ;
			echo '<script>alert("Conectado!");</script>';
			header("location: ../../Mapas.php");

		}
	}
   
		if(!isset($_SESSION['nome'])){
			echo '<script>alert("Errro na senha ou login, Tente Novamente!");</script>';
			header("location: login.php");
		}
	
    


?>