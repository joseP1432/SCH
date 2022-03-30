<?php include("config.php");
include("verificar.php");
$codigo = $_GET['codigo'];
if(isset($_POST['codPlant'])) {
	$codPlant = $_POST['codPlant'];
	$data = $_POST['data'];
	$dia1 = $_POST['dia1'];
	$dia2 = $_POST['dia2'];
	$med = $_POST['med'];
	$estado = "";
	$consulta = $MySQLi->query("UPDATE TB_PLANTOES set PLANT_DATA = '$data', PLANT_DIA1 = '$dia1', PLANT_DIA2 = '$dia2', PLANT_MED_CODIGO = '$med', PLANT_ESTADO = '$estado' where PLANT_CODIGO = $codPlant");
	header("Location: lsplantao.php");
}
$consultaPlant = $MySQLi->query("SELECT * FROM TB_PLANTOES join TB_MEDICOS ON PLANT_MED_CODIGO = MED_CODIGO WHERE PLANT_CODIGO = $codigo");
$resultadoPlant = $consultaPlant->fetch_assoc();
$consulta2 = $MySQLi->query("SELECT * FROM TB_MEDICOS WHERE MED_CODIGO != '1'");
$consulta3 = $MySQLi->query("SELECT * FROM TB_PLANTOES");
$resultado2 = $consulta3 -> fetch_assoc();
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

	<title>Editar Plantão | Sistema de Controle Hospitalar</title>

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
						<a href="#coord" data-bs-toggle="collapse" class="sidebar-link collapsed" > <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Plantões</span> </a>
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
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					<div class="alert-message">
						<strong>Olá coordenador!</strong> O médico ao qual foi selecionado inicialmente, estará destacado com o seguinte caractere: <strong> > </strong>.
						Atente-se para não errar o nome dos dias e nem a formatação, começando sempre com letras MAIÚSCULA (Domingo, Segunda...).
					</div>
					<div></div>
				</div>				
				<div class="container-fluid p-0">
					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block" >
							<h3><strong>Editar Plantão:</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex order-3 order-xxl-2">
								<div class="card col-12 flex-fill w-100">
									<div class="card-body">
										<form action="?" method="POST">
											<div class="row">
												<div class="mb-3 col-4">
													<label>Codigo:</label>
													<input type="text" class="form-control" name="codPlant" value="<?php echo $resultadoPlant['PLANT_CODIGO']; ?>" READONLY STYLE="pointer-events: none;background: #ccc;" required="" >
												</div>
												<div class="mb-3 col-4">
													<label>Data:</label>
													<input type="date" class="form-control" name="data" value="<?php echo $resultadoPlant['PLANT_DATA']; ?>" placeholder="Data" required="" >
												</div>
												<div class="mb-3 col-4">
													<label>Médico</label>
													<select name="med" class="form-control" required>
														<option value="<?php echo $resultadoPlant['PLANT_MED_CODIGO']; ?>"><?php echo $resultadoPlant['MED_NOME']; ?> </option>
														<?php while ($resultado = $consulta2 -> fetch_assoc()) {
															if($resultado['MED_CODIGO'] == $resultadoPlant['PLANT_MED_CODIGO']){ continue; } ?>
															<option value="<?php echo $resultado['MED_CODIGO'] ?>">
																<?php echo $resultado['MED_NOME']; ?>
															</option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="mb-3 col-6">
													<label>1º Dia:</label>
													<select class="form-control" name="dia1" required>
														<?php if($resultadoPlant['PLANT_DIA1'] == 'Domingo'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Domingo'; ?>" selected>Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Segunda'; ?>">Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Terça'; ?>">Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quarta'; ?>">Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quinta'; ?>">Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sexta'; ?>">Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sábado'; ?>">Sábado</option>
														<?php } elseif($resultadoPlant['PLANT_DIA1'] == 'Segunda'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Domingo'; ?>">Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Segunda'; ?>" selected>Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Terça'; ?>">Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quarta'; ?>">Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quinta'; ?>">Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sexta'; ?>">Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sábado'; ?>">Sábado</option>
														<?php } elseif($resultadoPlant['PLANT_DIA1'] == 'Terça'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Domingo'; ?>">Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Segunda'; ?>">Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Terça'; ?>"  selected>Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quarta'; ?>">Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quinta'; ?>">Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sexta'; ?>">Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sábado'; ?>">Sábado</option>
														<?php } elseif($resultadoPlant['PLANT_DIA1'] == 'Quarta'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Domingo'; ?>">Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Segunda'; ?>">Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Terça'; ?>">Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quarta'; ?>" selected>Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quinta'; ?>">Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sexta'; ?>">Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sábado'; ?>">Sábado</option>
														<?php } elseif($resultadoPlant['PLANT_DIA1'] == 'Quinta'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Domingo'; ?>">Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Segunda'; ?>">Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Terça'; ?>">Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quarta'; ?>">Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quinta'; ?>"  selected>Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sexta'; ?>">Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sábado'; ?>">Sábado</option>
														<?php } elseif($resultadoPlant['PLANT_DIA1'] == 'Sexta'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Domingo'; ?>">Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Segunda'; ?>">Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Terça'; ?>">Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quarta'; ?>">Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quinta'; ?>">Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sexta'; ?>"  selected>Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sábado'; ?>">Sábado</option>
														<?php } elseif($resultadoPlant['PLANT_DIA1'] == 'Sábado'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Domingo'; ?>">Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Segunda'; ?>">Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Terça'; ?>">Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quarta'; ?>">Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Quinta'; ?>">Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sexta'; ?>">Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA1'] = 'Sábado'; ?>"  selected>Sábado</option>
														<?php } ?>
													</select>
												</div>
												<div class="mb-3 col-6">
													<label>2º dia:</label>
													<select class="form-control" name="dia2" required>
														<?php if($resultadoPlant['PLANT_DIA2'] == 'Domingo'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Domingo'; ?>" selected>Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Segunda'; ?>">Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Terça'; ?>">Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quarta'; ?>">Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quinta'; ?>">Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sexta'; ?>">Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sábado'; ?>">Sábado</option>

														<?php } elseif($resultadoPlant['PLANT_DIA2'] == 'Segunda'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Domingo'; ?>">Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Segunda'; ?>" selected>Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Terça'; ?>">Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quarta'; ?>">Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quinta'; ?>">Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sexta'; ?>">Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sábado'; ?>">Sábado</option>

														<?php } elseif($resultadoPlant['PLANT_DIA2'] == 'Terça'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Domingo'; ?>">Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Segunda'; ?>">Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Terça'; ?>"  selected>Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quarta'; ?>">Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quinta'; ?>">Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sexta'; ?>">Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sábado'; ?>">Sábado</option>

														<?php } elseif($resultadoPlant['PLANT_DIA2'] == 'Quarta'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Domingo'; ?>">Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Segunda'; ?>">Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Terça'; ?>">Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quarta'; ?>" selected>Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quinta'; ?>">Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sexta'; ?>">Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sábado'; ?>">Sábado</option>

														<?php } elseif($resultadoPlant['PLANT_DIA2'] == 'Quinta'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Domingo'; ?>">Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Segunda'; ?>">Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Terça'; ?>">Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quarta'; ?>">Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quinta'; ?>"  selected>Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sexta'; ?>">Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sábado'; ?>">Sábado</option>

														<?php } elseif($resultadoPlant['PLANT_DIA2'] == 'Sexta'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Domingo'; ?>">Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Segunda'; ?>">Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Terça'; ?>">Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quarta'; ?>">Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quinta'; ?>">Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sexta'; ?>"  selected>Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sábado'; ?>">Sábado</option>

														<?php } elseif($resultadoPlant['PLANT_DIA2'] == 'Sábado'){ ?>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Domingo'; ?>">Domingo</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Segunda'; ?>">Segunda</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Terça'; ?>">Terça</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quarta'; ?>">Quarta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Quinta'; ?>">Quinta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sexta'; ?>">Sexta</option>
															<option value="<?php echo $resultadoPlant['PLANT_DIA2'] = 'Sábado'; ?>"  selected>Sábado</option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-12" align="center">
													<button type="submit" class="btn btn-primary"> Salvar </button></a>
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