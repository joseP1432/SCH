<?php
include("config.php");
include("verificar.php");

header('Content-Type: text/html; charset=utf-8');
$nome = utf8_decode($_POST['nome']);
$sobrenome = utf8_decode($_POST['sobrenome']);
$email = utf8_decode($_POST['email']);
$mensagem = utf8_decode($_POST['mensagem']);
$assunto = utf8_decode('TROCAR DE PLANTÃO');

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();

    //configuração
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = 'true';
$mail->Username = 'medicossch@gmail.com';
$mail->Password = '98medicos21';

    //configuração de mensagem
    $mail->setFrom($mail->Username, "$nome $sobrenome"); //Remetente
    $mail->addAddress($email); //Destinatario 
    $mail->Subject = "$assunto"; //Assunto

    $conteudo_email = "$mensagem";

    $mail->IsHTML(true);
    $mail->Body = $conteudo_email;
    if ($mail->send()){
      echo "Email enviado com sucesso";
      header("Location: medico.php");
  }else{
      echo "<script>alert('Envio errado.') . </script>" . $mail->ErrorInfo;
  }

  if (isset($_SESSION['coord'])) {
    if (strcmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)) === 0) {
      header("location: coordenador.php");
  }
}
?>