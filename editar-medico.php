<?php include("config.php");
include("verificar.php");
$codigo = $_GET['codigo'];
if(isset($_POST['nome'])) {
	$codMed = $_POST['codMed'];
	$nome = $_POST['nome'];
	$cpf = $_POST['cpf'];
	$crm = $_POST['crm'];
	$dtnasc = $_POST['dtnasc'];
	$logradouro = $_POST['logradouro'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$tel = $_POST['tel'];
	$tel2 = $_POST['tel2'];
	$consulta = $MySQLi->query("UPDATE TB_MEDICOS set MED_NOME = '$nome', MED_CPF = '$cpf', MED_CRM = '$crm', MED_DTNASC = '$dtnasc', MED_LOGRADOURO = '$logradouro', MED_EMAIL = '$email', MED_SENHA = '$senha', MED_TEL = '$tel', MED_TEL2 = '$tel2' where MED_CODIGO = $codMed");
	header("Location: medico.php");
}
$consultaMed = $MySQLi->query("SELECT * FROM TB_MEDICOS WHERE MED_CODIGO = $codigo");
$resultadoMed = $consultaMed->fetch_assoc();
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
							<h3><strong>Editar Médico:</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex order-3 order-xxl-2">
								<div class="card col-12">
									<div class="card-body ">
										<form action="?" method="POST">
											<div class="row">
												<div class="mb-3 col-4">
													<label>Codigo:</label>
													<input type="text" class="form-control" name="codMed" value="<?php echo $resultadoMed['MED_CODIGO']; ?>" required="" READONLY STYLE="pointer-events: none;background: #ccc;">	
												</div>
											</div>
											<div class="row">
												<div class="mb-3 col-4">
													<label>Nome:</label>
													<input type="text" class="form-control" name="nome" value="<?php echo $resultadoMed['MED_NOME']; ?>" placeholder="Nome" required="" >
												</div>
												<div class="mb-3 col-4">
													<label>CPF:</label>
													<input type="text" class="form-control" name="cpf" id="cpf" value="<?php echo $resultadoMed['MED_CPF']; ?>" placeholder="CPF" required="" >
												</div>
												<div class="mb-3 col-4">
													<label>CRM:</label>
													<input type="text" class="form-control" name="crm" id="crm" value="<?php echo $resultadoMed['MED_CRM']; ?>" placeholder="CRM" required="" >
												</div>
											</div>
											<div class="row">
												<div class="mb-3 col-8">
													<label>Logradouro:</label>
													<input type="text" name="logradouro" class="form-control" value="<?php echo $resultadoMed['MED_LOGRADOURO']; ?>" placeholder="Logradouro" required="" >
												</div>
												<div class="mb-3 col-4">
													<label>Data de Nascimento:</label>
													<input type="date" name="dtnasc" value="<?php echo $resultadoMed['MED_DTNASC']; ?>" class="form-control" required="" >
												</div>
											</div>
											<div class="row">
												<div class="mb-3 col-4">
													<label>Email:</label>
													<input type="text" name="email" class="form-control" value="<?php echo $resultadoMed['MED_EMAIL']; ?>" placeholder="Email" required="" >
												</div>
												<div class="mb-3 col-4">
													<label>Senha:</label>
													<input type="password" name="senha" class="form-control" value="<?php echo $resultadoMed['MED_SENHA']; ?>" placeholder="Senha" required="" >
												</div>
												<div class="mb-3 col-4">
													<label>Telefone:</label>
													<input type="text" name="tel" value="<?php echo $resultadoMed['MED_TEL']; ?>" class="telefone form-control" placeholder="Telefone" required="" >
												</div>
												<div class="mb-3 col-4">
													<label>Telefone Secundário:</label>
													<input type="text" name="tel2" value="<?php echo $resultadoMed['MED_TEL2']; ?>" class="telefone form-control" placeholder="Telefone Secundário">
												</div>
											</div>
											<div class="row">
												<div class="form-group col-12" align="center">
													<button type="submit" class="btn btn-primary"> Salvar </button>
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
		<script> 
			$(document).ready(function () { 
				var $seuCampoCpf = $("#cpf");
			});
		</script>


		<script>
			$(document).ready(function () { 
				var $seuCampoCpf = $("#cpf");
				$seuCampoCpf.mask('000.000.000-00', {reverse: true});
			});
		</script>

		<script> 
			$(document).ready(function () { 
				var $seuCampoCrm = $("#crm");
			});
		</script>

		<script>
			$(document).ready(function () { 
				var $seuCampoCrm = $("#crm");
				$seuCampoCrm.mask('000000-AA', {reverse: true});
			});
		</script>

		<script>
			$('.telefone').mask('(00) 0 0000-0000');
		</script>
	</body>

	</html>