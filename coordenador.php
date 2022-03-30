<?php
include("config.php");
include("verificar.php");
$consulta1 = $MySQLi -> query("SELECT * FROM TB_HOSPITAIS");
$consulta2 = $MySQLi -> query("SELECT * FROM TB_PLANTOES join TB_MEDICOS on PLANT_MED_CODIGO = MED_CODIGO WHERE PLANT_CODIGO != '1' OR MED_CODIGO != '1'");

$consulta3 = $MySQLi -> query("SELECT * FROM TB_MEDICOS join TB_PLANTOES on PLANT_MED_CODIGO = MED_CODIGO WHERE PLANT_CODIGO != '1' OR MED_CODIGO != '1' ORDER BY FIELD(PLANT_DIA1, 'Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado') LIMIT 0,7");
$consulta4 = $MySQLi -> query("SELECT * FROM TB_MEDICOS join TB_PLANTOES on PLANT_MED_CODIGO = MED_CODIGO WHERE PLANT_CODIGO != '1' OR MED_CODIGO != '1' ORDER BY FIELD(PLANT_DIA2, 'Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado') LIMIT 0,7");
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

	<title>Coordenador | Sistema de Controle Hospitalar</title>

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
						<a class="sidebar-link" href="coordenador.php"><i class="align-middle" data-feather="user"></i><span class="align-middle">Perfil</span></a>
					</li>
					<li class="sidebar-item">
						<a href="#med" data-bs-toggle="collapse" class="sidebar-link collapsed"> <i class="align-middle" data-feather="users"></i> <span class="align-middle">Médicos</span> </a>
						<ul id="med" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="lsmedico.php">Listar</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="cad-medico.php">Cadastrar</a></li>
						</ul>
					</li>

					<li class="sidebar-item">
						<a href="#coord" data-bs-toggle="collapse" class="sidebar-link collapsed"> <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Plantões</span> </a>
						<ul id="coord" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="lsplantao.php">Listar</a></li>
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
				<?php while($resultado2 = $consulta2->fetch_assoc()) { ?>
					<?php if ($resultado2['PLANT_ESTADO'] == '2') { ?>
						<div class="alert alert-info alert-dismissible" role="alert">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							<div class="alert-message">
								<strong>Olá coordenador!</strong> O(a) médico(a) <?php echo $resultado2['MED_NOME']; ?> recusou o plantão dos dias <?php echo $resultado2['PLANT_DIA1'];?> e <?php echo $resultado2['PLANT_DIA2']; ?>. Tente uma nova escala.
							</div>
						</div>
					<?php }elseif($resultado2['PLANT_ESTADO'] <= '0'){ ?>
						<div class="alert alert-info alert-dismissible" role="alert">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							<div class="alert-message">
								<strong>Olá coordenador!</strong> O(a) médico(a) <?php echo $resultado2['MED_NOME']; ?> ainda não respondeu.
							</div>
						</div>
					<?php } ?>
				<?php } ?>
				<div class="container-fluid p-0">
					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block" >
							<h3><strong>Plantão semanal:</h3>
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
														<th width="10%">#</th>
														<th width="10%">Domingo</th>
														<th width="10%">Segunda</th>
														<th width="10%">Terça</th>
														<th width="10%">Quarta</th>
														<th width="10%">Quinta</th>
														<th width="10%">Sexta</th>
														<th width="10%">Sábado</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td> 00:00 - 11:59 </td>

														<?php while($resultado3 = $consulta3 -> fetch_assoc()) { ?>
															<?php if($resultado3['PLANT_DIA1'] == 'Domingo'){ ?>
																<?php if($resultado3['PLANT_ESTADO'] == '1') { ?>
																	<td> <?php echo $resultado3['MED_NOME']; ?> </td>
																<?php } else { ?>
																	<td> - </td>
																<?php } ?>
															<?php } ?>

															<?php if($resultado3['PLANT_DIA1'] == 'Segunda'){ ?>
																<?php if($resultado3['PLANT_ESTADO'] == '1') { ?>
																	<td> <?php echo $resultado3['MED_NOME']; ?> </td>
																<?php } else { ?>
																	<td> - </td>
																<?php } ?>								                      <?php } ?>

																<?php if($resultado3['PLANT_DIA1'] == 'Terça'){ ?>
																	<?php if($resultado3['PLANT_ESTADO'] == '1') { ?>
																		<td> <?php echo $resultado3['MED_NOME']; ?> </td>
																	<?php } else { ?>
																		<td> - </td>
																	<?php } ?>
																<?php } ?>

																<?php if($resultado3['PLANT_DIA1'] == 'Quarta'){ ?>
																	<?php if($resultado3['PLANT_ESTADO'] == '1') { ?>
																		<td> <?php echo $resultado3['MED_NOME']; ?> </td>
																	<?php } else { ?>
																		<td> - </td>
																	<?php } ?>
																<?php } ?>

																<?php if($resultado3['PLANT_DIA1'] == 'Quinta'){ ?>
																	<?php if($resultado3['PLANT_ESTADO'] == '1') { ?>
																		<td> <?php echo $resultado3['MED_NOME']; ?> </td>
																	<?php } else { ?>
																		<td> - </td>
																	<?php } ?>
																<?php } ?>

																<?php if($resultado3['PLANT_DIA1'] == 'Sexta'){ ?>
																	<?php if($resultado3['PLANT_ESTADO'] == '1') { ?>
																		<td> <?php echo $resultado3['MED_NOME']; ?> </td>
																	<?php } else { ?>
																		<td> - </td>
																	<?php } ?>
																<?php } ?>

																<?php if($resultado3['PLANT_DIA1'] == 'Sábado'){ ?>
																	<?php if($resultado3['PLANT_ESTADO'] == '1') { ?>
																		<td> <?php echo $resultado3['MED_NOME']; ?> </td>
																	<?php } else { ?>
																		<td> - </td>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
														</tr>
														<tr>
															<td> 12:00 - 23:59 </td>
															<?php while($resultado4 = $consulta4 -> fetch_assoc()) {  ?>
																<?php if($resultado4['PLANT_DIA2'] == 'Domingo'){ ?>
																	<?php if($resultado4['PLANT_ESTADO'] == '1') { ?>
																		<td> <?php echo $resultado4['MED_NOME']; ?> </td>
																	<?php } else { ?>
																		<td> - </td>
																	<?php } ?>
																<?php } ?>

																<?php if($resultado4['PLANT_DIA2'] == 'Segunda'){ ?>
																	<?php if($resultado4['PLANT_ESTADO'] == '1') { ?>
																		<td> <?php echo $resultado4['MED_NOME']; ?> </td>
																	<?php } else { ?>
																		<td> - </td>
																	<?php } ?>
																<?php } ?>

																<?php if($resultado4['PLANT_DIA2'] == 'Terça'){ ?>
																	<?php if($resultado4['PLANT_ESTADO'] == '1') { ?>
																		<td> <?php echo $resultado4['MED_NOME']; ?> </td>
																	<?php } else { ?>
																		<td> - </td>
																	<?php } ?>
																<?php } ?>

																<?php if($resultado4['PLANT_DIA2'] == 'Quarta'){ ?>
																	<?php if($resultado4['PLANT_ESTADO'] == '1') { ?>
																		<td> <?php echo $resultado4['MED_NOME']; ?> </td>
																	<?php } else { ?>
																		<td> - </td>
																	<?php } ?>
																<?php } ?>

																<?php if($resultado4['PLANT_DIA2'] == 'Quinta'){ ?>
																	<?php if($resultado4['PLANT_ESTADO'] == '1') { ?>
																		<td> <?php echo $resultado4['MED_NOME']; ?> </td>
																	<?php } else { ?>
																		<td> - </td>
																	<?php } ?>
																<?php } ?>

																<?php if($resultado4['PLANT_DIA2'] == 'Sexta'){ ?>
																	<?php if($resultado4['PLANT_ESTADO'] == '1') { ?>
																		<td> <?php echo $resultado4['MED_NOME']; ?> </td>
																	<?php } else { ?>
																		<td> - </td>
																	<?php } ?>
																<?php } ?>

																<?php if($resultado4['PLANT_DIA2'] == 'Sábado'){ ?>
																	<?php if($resultado4['PLANT_ESTADO'] == '1') { ?>
																		<td> <?php echo $resultado4['MED_NOME']; ?> </td>
																	<?php } else { ?>
																		<td> - </td>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
														</tr>
													</tbody>
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