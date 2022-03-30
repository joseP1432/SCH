<?php
include("config.php");
$msg = 0;
if(isset($_POST['email'])) {
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$consulta1 = $MySQLi->query("SELECT * FROM TB_MEDICOS where MED_EMAIL = '$email' and MED_SENHA = '$senha' AND MED_CODIGO != '1'");
	$consulta2 = $MySQLi->query("SELECT * FROM TB_COORDENADORES WHERE COORD_EMAIL = '$email' and COORD_SENHA = '$senha'");
	$consulta3 = $MySQLi->query("SELECT * FROM TB_MEDICOS join TB_PLANTOES on PLANT_MED_CODIGO = MED_CODIGO where MED_EMAIL = '$email' and MED_SENHA = '$senha' AND PLANT_CODIGO != '1'");
	if($resultado1 = $consulta1->fetch_assoc()){
		$_SESSION['codigo'] = $resultado1['MED_CODIGO'];
		$_SESSION['nome'] = $resultado1['MED_NOME'];
		$_SESSION['med'] = $resultado1['MED_CODIGO'];
		header("Location: medico.php");		
		if($resultado3 = $consulta3->fetch_assoc()){
			$_SESSION['plantao'] = $resultado3['PLANT_CODIGO'];
		}
	}elseif($resultado2 = $consulta2->fetch_assoc()){
		$_SESSION['codigo'] = $resultado2['COORD_CODIGO'];
		$_SESSION['nome'] = $resultado2['COORD_NOME'];
		$_SESSION['coord'] = $resultado2['COORD_CODIGO'];
		header("Location: coordenador.php");
	}
	$msg = 1;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>LOGIN | Sistema de Controle Hospitalar</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100 bg-light-gradient">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						<div class="card">
							<div class="card-header mt-5 bg-light">
								<div class="text-center">
									<h2 class="text-info"> LOGIN </h2>
								</div>
							</div>
							<div class="card-body"  align="center">
								<div class="m-sm-4">
									<?php if($msg==1) echo "<span style='text-align: center; color:red'>Usuário ou senha inválida!</span>"; ?>
									<form action="?" method="POST">
										<div class="col-10" data-validate="Valid email is: a@b.c mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Digite seu email..." />
										</div>
										<div class="mb-3 mt-3 col-10">
											<label class="form-label">Senha</label>
											<input class="form-control form-control-lg" type="password" name="senha" placeholder="Digite sua senha..." />
										</div>
										<br>
										<br>
										<div class="text-center mt-3 mb-5">
											<button type="submit" class="btn btn-lg btn-info">Login</button>
											<a href="index.php" class="btn btn-lg btn-info">Voltar</a>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>