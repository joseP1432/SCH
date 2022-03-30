<?php include("config.php");
$consulta1 = $MySQLi -> query("SELECT * FROM TB_HOSPITAIS");
$resultado1 = $consulta1->fetch_assoc();
$consulta3 = $MySQLi -> query("SELECT * FROM TB_MEDICOS join TB_PLANTOES on PLANT_MED_CODIGO = MED_CODIGO WHERE PLANT_CODIGO != '1' OR MED_CODIGO != '1' ORDER BY FIELD(PLANT_DIA1, 'Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado') LIMIT 0,7");
$consulta4 = $MySQLi -> query("SELECT * FROM TB_MEDICOS join TB_PLANTOES on PLANT_MED_CODIGO = MED_CODIGO WHERE PLANT_CODIGO != '1' OR MED_CODIGO != '1' ORDER BY FIELD(PLANT_DIA2, 'Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado') LIMIT 0,7");
$consultaMed = $MySQLi -> query("SELECT * FROM TB_MEDICOS WHERE PLANT_CODIGO != '1'");
$consultaCoord = $MySQLi -> query("SELECT * FROM TB_COORDENADORES");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SCH - Sistema de Controle Hospitalar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">
  
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/ionicons.min.css">
  
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
 
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
   <div class="container">
     <a class="navbar-brand" href="index.html"><span>SCH</span></a>
     <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#navbar-Site" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
       <span class="oi oi-menu"></span> Menu
     </button>
     <div class="collapse navbar-collapse" id="navbar-Site">
      <ul></ul>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php"> Início </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <?php if(!isset($_SESSION['codigo'])){ ?>
          <li class="nav-item"><a class="nav-link" href="login.php" title="login"> Login </a></li>
        <?php } elseif (isset($_SESSION['med'])) { ?>
          <li class="nav-item"><a class="nav-link" href="medico.php" title="voltar"> Voltar </a></li>
          <li class="nav-item"><a class="nav-link" href="sair.php" title="voltar"> Sair </a></li>
        <?php } elseif (isset($_SESSION['coord'])) { ?>
          <li class="nav-item"><a class="nav-link" href="coordenador.php" title="voltar"> Voltar </a></li>
          <li class="nav-item"><a class="nav-link" href="sair.php" title="voltar"> Sair </a></li>
        <?php } ?>
      </li>
    </ul>
  </div>
</div>
</nav>

<section class="hero-wrap js-fullheight" style="background-image: url('images/hosp-02.jpg');" data-section="home">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
      <div class="col-md-8 ftco-animate mt-5" data-scrollax=" properties: { translateY: '70%' }">
       <p class="d-flex align-items-center" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
       </p>
       <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Seja bem-vindo!</h1>
       <p class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Acompanhe aqui o plantão da sua cidade.</p>
     </div>
   </div>
 </div>

 <section class="ftco-section bg-light" data-section="blog">
  <h2 class=" ml-5 bg-light">Plantão Semanal:</h2> <br> <br>
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex order-3 order-xxl-2">
        <div class="card flex-fill w-100">
          <div class="card-body table-border-style">
            <div class="table-responsive">
              <table class="table table-hover text-dark" align="center text-center">
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
                        <?php } ?>                                    
                      <?php } ?>

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
</section>		

<footer class="ftco-footer ftco-section">
 <div class="footer-area footer-padding">
  <div class="container float-left">
   <div class="row justify-content-between">
    <div class="single-footer-caption mb-3 float-left">
     <ul>
      <li><?php echo $resultado1['HOSP_LOGRADOURO']; ?></li>
      <li><?php echo $resultado1['HOSP_TELEFONE']; ?></li>
      <li><?php echo $resultado1['HOSP_EMAIL']; ?></li>
    </ul>
  </div>
  <div class="single-footer-caption mb-3 float-right">
   <ul>
     <li>Facebook</li>
     <li>Twitter</li>
     <li>Instagram</li>
   </ul>
 </div>
</div>
</div>
</div>
</div>
</footer>

<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>

</body>
</html>