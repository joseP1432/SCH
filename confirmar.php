<?php
include("config.php");
include("verificar.php");
$codigo = $_GET['codigo'];
if (isset($_POST['codPlant'])) {
	$codPlant = $_POST['codPlant'];
	$data = $_POST['data'];
	$dia1 = $_POST['dia1'];
	$dia2 = $_POST['dia2'];
	$med = $_POST['med'];
	$estado = $_POST['radios-example'];
	$consulta = $MySQLi->query("UPDATE TB_PLANTOES set PLANT_DATA = '$data', PLANT_DIA1 = '$dia1', PLANT_DIA2 = '$dia2', PLANT_MED_CODIGO = '$med', PLANT_ESTADO = '$estado' where PLANT_CODIGO = $codPlant");
	header("Location: medico.php");
}
$consultaPlant = $MySQLi->query("SELECT * FROM TB_PLANTOES JOIN TB_MEDICOS ON PLANT_MED_CODIGO = MED_CODIGO WHERE PLANT_CODIGO = $codigo");
$resultadoPlant = $consultaPlant->fetch_assoc();
$consulta = $MySQLi->query("SELECT * FROM TB_MEDICOS WHERE MED_CODIGO != '1'");
$resultado = $consulta->fetch_assoc();

if (isset($_SESSION['coord'])) {
	if (strcmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)) === 0) {
		header("location: coordenador.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Confirmar Plantão | Sistema de Controle Hospitalar</title>

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
							<h3><strong>Confirmar Plantão:</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex order-3 order-xxl-2">
								<div class="card">
									<div class="card-body col-12">
										<form action="?" method="POST">
											<div class="row">
												<div class="mb-3 col-4">
													<label>Codigo:</label>
													<input type="text" class="form-control" name="codPlant" value="<?php echo $resultadoPlant['PLANT_CODIGO']; ?>" READONLY STYLE="pointer-events: none;background: #ccc;">
												</div>
												<div class="mb-3 col-4">
													<label>Data:</label>
													<input type="date" class="form-control" name="data" value="<?php echo $resultadoPlant['PLANT_DATA']; ?>" placeholder="Data" READONLY STYLE="pointer-events: none;background: #ccc;">
												</div>
												<div class="mb-3 col-4">
													<label>1º Dia:</label>
													<input type="text" class="form-control" name="dia1" value="<?php echo $resultadoPlant['PLANT_DIA1']; ?>" placeholder="DIA 1" READONLY STYLE="pointer-events: none;background: #ccc;">
												</div>
												<div class="mb-3 col-4">
													<label>2º dia:</label>
													<input type="text" class="form-control" name="dia2" value="<?php echo $resultadoPlant['PLANT_DIA2']; ?>" placeholder="DIA 2" READONLY STYLE="pointer-events: none;background: #ccc;">
												</div>
												<div class="mb-3 col-4">
													<label>Médico:</label>
													<input type="text" class="form-control" name="med" value="<?php echo $resultadoPlant['PLANT_MED_CODIGO']; ?>" placeholder="DIA 2" READONLY STYLE="pointer-events: none;background: #ccc;">
												</div>
												<div class="mb-3 col-4">
													<label class="form-check">
														<input class="form-check-input" type="radio" value="1" name="radios-example">
														<span class="form-check-label">
															Eu aceito o plantão proposto.
														</span>
													</label>
													<label class="form-check">
														<input class="form-check-input" type="radio" value="2" name="radios-example">
														<span class="form-check-label">
															Eu recuso o plantão proposto.
														</span>
													</label>
												</div>
												<div class="row">
													<div class="form-group col-12" align="center">
														<button type="submit" class="btn btn-primary"> Responder </button></a>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
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
	</body>
	</html>