 <?php include("config.php");
 include("verificar.php");

 if(isset($_POST['dia1'])){
 	$dia1 = $_POST['dia1'];
 	$dia2 = $_POST['dia2'];
 	$data = $_POST['data'];
 	$med = $_POST['med'];
 	$coord = '1';
 	$consulta = $MySQLi -> query("insert into TB_PLANTOES (PLANT_DIA1, PLANT_DIA2, PLANT_DATA, PLANT_MED_CODIGO, PLANT_COORD_CODIGO)
 		values ('$dia1', '$dia2', '$data', '$med', '$coord')");
 	header("Location: lsplantao.php");
 }
 $consulta2 = $MySQLi -> query("SELECT * FROM TB_MEDICOS WHERE MED_CODIGO != '1'");
 $consulta3 = $MySQLi -> query("SELECT * FROM TB_PLANTOES");
 $resultado2 = $consulta3->fetch_assoc();
 
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

 	<title>Cadastrar Plantão | Sistema de Controle Hospitalar</title>

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
 						<li class="sidebar-item">
 							<a class="sidebar-link" href="coordenador.php"><i class="align-middle" data-feather="user"></i><span class="align-middle">Perfil</span></a>
 						</li>
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
 							<li class="sidebar-item"><a class="sidebar-link" href="lsplantao.php">Listar</a></li>
 							<li class="sidebar-item active"><a class="sidebar-link" href="cad-plantao.php">Cadastrar</a></li>
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
 							<h3><strong>Cadastrar Plantão:</h3>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
 								<div class="card">
 									<div class="card-body col-12">
 										<form action="?" method="POST">
 											<div class="row">
 												<div class="mb-3 col-4">
 													<label>Data:</label>
 													<input type="date" name="data" class="form-control" required="" placeholder="Data">
 												</div>
 												<div class="mb-3 col-8">
 													<label>Médico:</label>
 													<select name="med" class="form-control" required="" >
 														<option>Selecione o médico:</option>
 														<?php while ($resultado = $consulta2 -> fetch_assoc()) { ?>
 															<option value="<?php echo $resultado['MED_CODIGO'] ?>">
 																<?php if ($resultado['MED_CODIGO'] == $resultado2['PLANT_MED_CODIGO']) {
 																	echo "";
 																} ?>
 																<?php echo $resultado['MED_NOME']; ?>
 															</option>
 														<?php } ?>
 													</select>
 												</div>
 												<div class="mb-3 col-6">
 													<label>1º: Dia</label>
 													<select name="dia1" class="form-control" required="" >
 														<option>Selecione o 1º dia:</option>
 														<option value="<?php echo $resultado2['PLANT_DIA1'] = 'Domingo' ?>"> Domingo </option>
 														<option value="<?php echo $resultado2['PLANT_DIA1'] = 'Segunda' ?>"> Segunda </option>
 														<option value="<?php echo $resultado2['PLANT_DIA1'] = 'Terça' ?>"> Terça </option>
 														<option value="<?php echo $resultado2['PLANT_DIA1'] = 'Quarta' ?>"> Quarta </option>
 														<option value="<?php echo $resultado2['PLANT_DIA1'] = 'Quinta' ?>"> Quinta </option>
 														<option value="<?php echo $resultado2['PLANT_DIA1'] = 'Sexta' ?>"> Sexta </option>
 														<option value="<?php echo $resultado2['PLANT_DIA1'] = 'Sábado' ?>"> Sábado </option>
 													</select>
 												</div>
 												<div class="mb-3 col-6">
 													<label>2º Dia:</label>
 													<select name="dia2" class="form-control" required="" >
 														<option>Selecione o 2º dia:</option>
 														<option value="<?php echo $resultado2['PLANT_DIA2'] = 'Domingo' ?>"> Domingo </option>
 														<option value="<?php echo $resultado2['PLANT_DIA2'] = 'Segunda' ?>"> Segunda </option>
 														<option value="<?php echo $resultado2['PLANT_DIA2'] = 'Terça' ?>"> Terça </option>
 														<option value="<?php echo $resultado2['PLANT_DIA2'] = 'Quarta' ?>"> Quarta </option>
 														<option value="<?php echo $resultado2['PLANT_DIA2'] = 'Quinta' ?>"> Quinta </option>
 														<option value="<?php echo $resultado2['PLANT_DIA2'] = 'Sexta' ?>"> Sexta </option>
 														<option value="<?php echo $resultado2['PLANT_DIA2'] = 'Sábado' ?>"> Sábado </option>
 													</select>
 												</div>
 												<div class="row">
 													<div class="form-group col-12" align="center">
 														<button type="submit" class="btn btn-primary"> Cadastrar </button>
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