<?php
include("config.php");
include("verificar.php");

$consulta1 = $MySQLi -> query("SELECT * FROM TB_HOSPITAIS");
if (isset($_SESSION['coord'])) {
	if (strcmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)) === 0) {
		header("location: coordenador.php");
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Médico | Sistema de Controle Hospitalar</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<span class="align-middle sidebar-brand">SCH</span>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Páginas:
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="index.php"><i class="align-middle" data-feather="home"></i><span class="align-middle">Início</span></a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="sair.php"><i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Sair</span></a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex"> <i class="hamburger align-self-center"></i> </a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<?php echo $_SESSION['nome']; ?>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block">
							<h3><strong>Seu plantão:</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex order-3">
								<div class="card flex-fill w-100">
									<div class="card-body table-border-style">
										<p align="center"> Aguarde o coordenador anexar seu plantão. </p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</main>

				<footer class="footer">
					<div class="container-fluid">
						<div class="row text-muted">
							<div class="col-6 text-start">
								<p class="mb-0">
									<strong>SCH</strong> &copy;
								</p>
							</div>
							<div class="col-6 text-end">
							</div>
						</div>
					</div>
				</footer>
				<div class="modal fade" id="siteModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title"> Enviar e-mail </h5>
								<button type="button" class="close" data-dismiss="modal"> 
									<span> × </span>
								</button>
							</div>

							<div class="modal-body">
								<div class="row justify-content-center">
									<div class="col-sm-10 col-md-12">
										<form method="POST" action="enviar.php">     
											<div class="form-row">
												<div class="form-group col-6">
													<label> Nome: </label> 
													<input type="text" name="nome" class="form-control" placeholder="Nome" required>  
												</div>
												<div class="form-group col-6">
													<label> Sobrenome: </label>
													<input type="text" name="sobrenome" class="form-control" placeholder="Sobrenome" required>   
												</div>      
											</div>
											<div class="form-row">
												<div class="form-group col-6">
													<label> Email: </label>
													<input type="text" name="email" class="form-control" placeholder="Email do coordenador" required>
												</div>
												<div class="form-group col-6">
													<label> Assunto: </label>
													<input type="text" name="assunto" class="form-control" placeholder="Assunto" value="TROCAR DE PLANTÃO" READONLY STYLE="pointer-events: none;background: #ccc;" required>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-12">
													<label> Mensagem: </label>
													<textarea name="mensagem" class="form-control" rows="10" cols="100" placeholder="Mensagem do email" required></textarea> 
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-sm-10">
													<input type="submit" class="btn btn-primary" value="Enviar">
												</div>
											</div>    
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="js/app.js"></script>

	</body>

	</html>