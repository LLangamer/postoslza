<?php include'../PostoDAO.php'; ?>


<head>

<title>InstitutoOASIS</title>

<!-- <link rel="stylesheet" href="<?php// echo BASEURL; ?>css/bootstrap.min.css"> -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../../css/bootstrap.min.css">

</head>


<div style="margin-top:5%;"><center><figure><img src="../../images/Postoslza.png" width="150" title="InstitutoOASIS"/></figure></center></div>
</br>
</br>
<center>
<form class="col-md-3" method="post" action="verificalogin.php">
  <div class="form-group" style="text-align:left;">
    <label for="emaillogin"><b>Login</b></label>
    <input type="text" class="form-control" name="login" style="align:center;" placeholder="Informe seu login" required >
    
  </div>
  <div class="form-group"  style="text-align:left;" >
	
    <label for="senhalogin" ><b>Senha</b></label>
    <center> <div class="form-row">
	<input type="password" class="form-control" name="senha" style="align:center" placeholder="Informe sua senha" required></center>
  
  </div>
  <div style="align:center;">
		<p>Esqueceu sua senha? <a href="inc/esquecisenha.php">clique aqui</a></p>
		<p>Novo usuário? <a href="inc/cadastrar.php">criar nova conta</a></p>
  </div>
  <button type="submit" class="btn btn-danger">Entrar</button>
</form>

</center>



