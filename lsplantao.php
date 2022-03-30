<?php include("config.php");
include("verificar.php");
$consultaPlant = $MySQLi->query("SELECT * FROM TB_PLANTOES
	JOIN TB_MEDICOS ON PLANT_MED_CODIGO = MED_CODIGO WHERE PLANT_CODIGO != '1'
	ORDER BY PLANT_DATA ASC");
if(isset($_GET['excluir'])) {
	$codigo = $_GET['excluir'];
	$consulta2 = $MySQLi->query("DELETE FROM TB_PLANTOES WHERE PLANT_CODIGO = $codigo");
	header("Location: lsplantao.php");
}
if (isset($_SESSION['med'])) {
	if (strcmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)) === 0) {
		header("location: medico.php");
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

	<title>Listar Plantões | Sistema de Controle Hospitalar</title>

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
					<li class="sidebar-item">
						<a class="sidebar-link" href="coordenador.php"><i class="align-middle" data-feather="user"></i><span class="align-middle">Perfil</span></a>
					</li>
					<li class="sidebar-item">
						<a href="#med" data-bs-toggle="collapse" class="sidebar-link collapsed"> <i class="align-middle" data-feather="users"></i> <span class="align-middle">Médicos</span> </a>
						<ul id="med" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="lsmedico.php">Listar</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="cad-medico.php">Cadastrar</a></li>
						</ul>
					</li>

					<li class="sidebar-item active">
						<a href="#coord" data-bs-toggle="collapse" class="sidebar-link collapsed"> <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Plantões</span> </a>
						<ul id="coord" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item active"><a class="sidebar-link" href="lsplantao.php">Listar</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="cad-plantao.php">Cadastrar</a></li>
						</ul>
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
							<h3><strong>Plantão:</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex order-3 order-xxl-2">
								<div class="card flex-fill w-100">
									<div class="card-body table-border-style">
										<div class="table-responsive">
											<table class="table table-hover" align="center text-center">
												<thead>
													<tr>
														<th width="15%"> Médico: </th>
														<th width="10%"> 1º turno: </th>
														<th width="10%"> 2º turno: </th>
														<th width="10%"> Data: </th>
														<th width="10%"> Ações: </th>
													</tr>
												</thead>
												<?php while($resultadoPlant = $consultaPlant -> fetch_assoc()) { ?>
													
													<tbody>
														<tr>
															<?php if($resultadoPlant['PLANT_ESTADO'] == '2'){?>
																<td class="text-danger"> <?php echo $resultadoPlant['MED_NOME']; ?> </td>
																<td class="text-danger"> <?php echo $resultadoPlant['PLANT_DIA1']; ?> </td>
																<td class="text-danger"> <?php echo $resultadoPlant['PLANT_DIA2']; ?> </td>
																<td class="text-danger"> <?php echo us_br($resultadoPlant['PLANT_DATA']); ?> </td>
																<td>
																	<a href="editar-plantao.php?codigo=<?PHP echo $resultadoPlant['PLANT_CODIGO']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle me-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a> | <a href="?excluir=<?PHP echo $resultadoPlant['PLANT_CODIGO']; ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 align-middle me-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a> 
																</td>
															<?php } else { ?>
																<td> <?php echo $resultadoPlant['MED_NOME']; ?> </td>
																<td> <?php echo $resultadoPlant['PLANT_DIA1']; ?> </td>
																<td> <?php echo $resultadoPlant['PLANT_DIA2']; ?> </td>
																<td> <?php echo us_br($resultadoPlant['PLANT_DATA']); ?> </td>
																<td>
																	<a href="editar-plantao.php?codigo=<?PHP echo $resultadoPlant['PLANT_CODIGO']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle me-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a> | <a href="?excluir=<?PHP echo $resultadoPlant['PLANT_CODIGO']; ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 align-middle me-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a> 
																</td>
															<?php } ?>
														</tr>
													</tbody>
												<?php } ?>
											</table>
										</div>
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