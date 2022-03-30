<?php include("config.php");
include("verificar.php");

if(isset($_POST['nome'])){
	$nome = $_POST['nome'];
	$cpf = $_POST['cpf'];
	$crm = $_POST['crm'];
	$dtnasc = $_POST['dtnasc'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$logradouro = $_POST['logradouro'];
	$tel = $_POST['tel'];
	$tel2 = $_POST['tel2'];
	$consulta = $MySQLi -> query("insert into TB_MEDICOS (MED_NOME, MED_CPF, MED_CRM, MED_DTNASC, MED_EMAIL, MED_SENHA, MED_LOGRADOURO, MED_TEL, MED_TEL2)
		values ('$nome', '$cpf', '$crm', '$dtnasc', '$email', '$senha', '$logradouro', '$tel', '$tel2')");
	header("Location: lsmedico.php");
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

	<title>Cadastrar Médico | Sistema de Controle Hospitalar</title>

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
					<li class="sidebar-item active">
						<a href="#med" data-bs-toggle="collapse" class="sidebar-link collapsed"> <i class="align-middle" data-feather="users"></i> <span class="align-middle">Médicos</span> </a>
						<ul id="med" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="lsmedico.php">Listar</a></li>
							<li class="sidebar-item active"><a class="sidebar-link" href="cad-medico.php">Cadastrar</a></li>
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
				<div class="container-fluid p-0">
					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block" >
							<h3><strong>Cadastrar Médico:</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div class="card">
									<div class="card-body col-12">
										<form action="?" method="POST">
											<div class="row">
												<div class="mb-3 col-4">
													<label>Nome completo:</label>
													<input type="text" required="" name="nome" class="form-control" placeholder="Nome completo">
												</div>
												<div class="mb-3 col-4">
													<label>CPF:</label>
													<input type="text" required="" name="cpf" id="cpf" class="form-control" placeholder="111.111.111-11">
												</div>
												<div class="mb-3 col-4">
													<label>Data de Nascimento:</label>
													<input type="date" required="" name="dtnasc" class="form-control">
												</div>
											</div>
											<div class="row">
												<div class="mb-3 col-8">
													<label>Logradouro:</label>
													<input type="text" required="" name="logradouro" class="form-control" placeholder="Rua, Número - Bairro, Cidade - UF, CEP">
												</div>
												<div class="mb-3 col-4">
													<label>CRM:</label>
													<input type="text" required="" name="crm" id="crm" class="form-control" placeholder="111111-UF">
												</div>
											</div>
											<div class="row">
												<div class="mb-3 col-4">
													<label>Email:</label>
													<input type="text" required="" name="email" class="form-control" placeholder="Email">
												</div>
												<div class="mb-3 col-4">
													<label>Senha:</label>
													<input type="password" required="" name="senha" class="form-control" placeholder="Senha">
												</div>
												<div class="mb-3 col-4">
													<label>Telefone:</label>
													<input type="text" required="" name="tel" class="telefone form-control" placeholder="DDD 91111-1111">
												</div>
												<div class="mb-3 col-4">
													<label>Telefone 2:</label>
													<input type="text" name="tel2" class="telefone form-control" placeholder="DDD 91111-1111">
												</div>

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