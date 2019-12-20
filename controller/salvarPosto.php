

        <?php
        include_once '../model/PostoDAO.php'; // inclue a pagina UsuarioDAO
       
// ======== O POST Pega as variaveis da outra pagina,ou seja pega do cadastroUsuarioF ========
        
        $nome = $_POST['nome'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $endereco = $_POST['endereco'];
        $bandeira = $_POST['bandeira'];
        $ha = $_POST['ha'];
        $hf = $_POST['hf'];
    
//================ Cadastro de Usuario ================


        try {
            $DAO = new PostoDAO();  // instanciando um novo objeto do tipo UsuarioDAO
            $posto = new Posto("",$nome, $bandeira, $endereco, $ha, $hf, $lat, $lng);
            $DAO->Create($posto); // Operação de Create no banco de dados

            

            header('location:../index.php');   // Redireciona a Página
       } catch (Exception $e) {
           echo ' <script>alert("se lascamo");</script>';
            
       }
        ?>

    php 