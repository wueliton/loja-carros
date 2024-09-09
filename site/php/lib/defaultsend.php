<?php
//INCLUDE DA LIB DO PHP MAILER, NÃO ALTERAR OS ARQUIVOS INTERNOS

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';



function defaultsend($remetente, $assunto, $destinatario, $nomeremetente, $mensagemHTML, $files)
{

	$mail = new PHPMailer();
	// $mail->SMTPDebug  = 2;
	$mail->IsSMTP();
	$mail->CharSet = 'UTF-8';
	$mail->Encoding = 'base64';
	$mail->SMTPAuth  = true;
	$mail->Host  = 'smtp.conceitopublicidade.com.br';
	$mail->Port  = '587';
	if (isset($_POST['email'])) {
		$mail->addReplyTo($_POST['email'], $nomeremetente);
	}
	$mail->Username  = 'formularios@conceitopublicidade.com.br';
	$mail->Password  = '0G92ou08@QwO!';
	$mail->SMTPSecure = false;
	$mail->SMTPAutoTLS = false;
	$mail->From  = 'formularios@conceitopublicidade.com.br';
	$mail->FromName = mb_convert_encoding($nomeremetente, 'UTF-8');
	$mail->IsHTML(true);

	if (!empty($files)) {

		$mail->AddAttachment($files['tmp_name'], $files['name']);
	}

	$mail->Subject = mb_convert_encoding($assunto, 'UTF-8');
	$mail->Body = mb_convert_encoding($mensagemHTML, 'UTF-8');



	$mail->AddAddress($destinatario);

	try {

		if ($mail->Send()) {

			return true;
		} else {

			return false;
		}
	} catch (Exception $e) {

		return $e->getMessage();
	}
}
