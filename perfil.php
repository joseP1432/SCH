<?php include("config.php");
include("verificar.php");
$codigo = $_GET['codigo'];
$consultaMed = $MySQLi->query("SELECT * FROM TB_MEDICOS WHERE MED_CODIGO = $codigo AND MED_CODIGO != '1'");
$consulta = $MySQLi->query("SELECT * FROM TB_MEDICOS WHERE MED_CODIGO != '1'");
$resultado = $consulta->fetch_assoc();
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

	<title>Editar Médico | Sistema de Controle Hospitalar</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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
						<a class="sidebar-link" href="index.php"> <i class="align-middle" data-feather="home"></i> <span class="align-middle">Início</span> </a>
					</li>
					<li class="sidebar-item active">
						<a class="sidebar-link" href="perfil.php?codigo=<?PHP echo $resultado['MED_CODIGO']; ?>"><i class="align-middle" data-feather="user"></i><span class="align-middle">Perfil</span></a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="medico.php"> <i class="align-middle" data-feather="users"></i> <span class="align-middle">Meu Plantão</span> </a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="sair.php"> <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Sair</span> </a>
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
						<div class="col-auto d-none d-sm-block" >
							<h3><strong>Médico:</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex order-3 order-xxl-2">
								<?php while ($resultadoMed = $consultaMed->fetch_assoc()) { ?>
									<div class="card col-12">
										<div class="card-body ">
											<div class="row">
												<div class="mb-3 col-4">
													<label>Nome:</label>
													<p> <?php echo $resultadoMed['MED_NOME']; ?> </p>
												</div>
												<div class="mb-3 col-4">
													<label>CPF:</label>
													<p><?php echo $resultadoMed['MED_CPF']; ?></p>
												</div>
												<div class="mb-3 col-4">
													<label>CRM:</label>
													<p><?php echo $resultadoMed['MED_CRM']; ?></p>
												</div>
											</div>
											<div class="row">
												<div class="mb-3 col-8">
													<label>Logradouro:</label>
													<p><?php echo $resultadoMed['MED_LOGRADOURO']; ?></p>
												</div>
												<div class="mb-3 col-4">
													<label>Data de Nascimento:</label>
													<p><?php echo $resultadoMed['MED_DTNASC']; ?></p>
												</div>
											</div>
											<div class="row">
												<div class="mb-3 col-4">
													<label>Email:</label>
													<p><?php echo $resultadoMed['MED_EMAIL']; ?></p>
												</div>
												<div class="mb-3 col-4">
													<label>Senha:</label>
													<p><?php echo $resultadoMed['MED_SENHA']; ?></p>
												</div>
												<div class="mb-3 col-4">
													<label>Telefone:</label>
													<p><?php echo $resultadoMed['MED_TEL']; ?></p>
												</div>
												<div class="mb-3 col-4">
													<label>Telefone Secundário:</label>
													<p><?php echo $resultadoMed['MED_TEL2']; ?></p>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-12" align="center">
													<a class="btn btn-primary" href="editar-medico.php?codigo=<?PHP echo $resultadoMed['MED_CODIGO']; ?>">Editar</a>
												</div>
											</div>
										</div>
									</div>
								<?php }?>
							</div>
						</div>
					</div>
				</main>

				<footer class="footer">
					<div class="container-fluid">
						<div class="row">
							<div class="col-6">
								<p class="mb-0">
									<strong>SCH</strong> &copy;
								</p>
							</div>
							<div class="col-6 text-end">
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>

		<script src="js/app.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
	</body>

	</html>