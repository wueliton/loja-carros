<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = array(

	"secret" => '6LdZXBcqAAAAAG8P5Ly7XUYXvjD5_CtELt3qdidd',

	"response" => $_POST['g-recaptcha-response']

);



$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");

curl_setopt($curl, CURLOPT_POST, true);

curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);



$result = json_decode(curl_exec($curl));

curl_close($curl);



if (isset($result->success) && $result->success) {

	require_once 'lib/defaultsend.php';



	$campos = $_POST;

	$data = date("H:i d-m-y");
	$campos['data'] = $data;

	reset($campos);

	// $remetente = 'mauricio.conceitopub@gmail.com';
	$remetente = 'vendas@raposoautoshopping.com.br';
	

	$assunto = isset($_FILES['arquivo']) ? 'Trabalhe Conosco' : 'Fale Conosco';
	$nomeremetente = "Contato Pelo Site";
	$destinatario = $remetente;



	$valores = "";
	$valor = "";



	foreach ($campos as $key => $val) {

		if ($key != 'submit' && $key != 'g-recaptcha-response' && $val != '' && $key != 'tipo_form') {



			if (is_array($val)) {

				$val = implode(", ", $val);
			}



			$keyModif = str_replace('_', ' ', ucfirst($key));



			$val = preg_replace("@-@", " ", $val);



			$valores .= "<li style='width: 530px; /*border-bottom: solid 1px #c0c0c0*/; padding: 5px 0 ;font: 16px Helvetica Neue,Arial,Helvetica,Geneva,sans-serif; color: #808080;margin: 20px 15px;'><strong>$keyModif:</strong> $val</li>";

			$valor .= "'$keyModif'=>'$val',";
		}
	}



	$valorCampos = $valores;



	$arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : null;

	$values = "array(" . $valor . ");";


	function addRegisterJson($params = false)
	{
		$fileName = "backup-emails.txt";
		$conteudo = file_exists($fileName) ? file_get_contents($fileName) : "";
		$file = fopen($fileName, 'w');

		if ($conteudo == "") {
			$paramsNew = array(
				$params
			);
			$conteudo = json_encode($paramsNew);
		} else {
			$conteudo = json_decode($conteudo);
			$paramsNew = array(
				$params
			);
			array_push($conteudo, $paramsNew);
			$conteudo = json_encode($conteudo);
		}

		fwrite($file, $conteudo);
		fclose($file);
	}

	foreach ($_GET as $key => $value) {
		$values[$key] = $value;
	}
	addRegisterJson($values);



	$mensagemHTML =
		"<html>
<head>
	<style type='text/css'>
		body {
			margin: 0px;
			font-family: Verdana;
			font-size: 16px;
			color: #808080;
		}
		h2 {
			text-transform: capitalize;
		}
	</style>
</head>
<body style='font-family: Verdana;color: #808080;background-color: #dedede;'>
	<div id='wrapper-email'>	
		<br /><br />

		<div class=\"campos\">
			<ul style='box-shadow: 0px 0 14px #716f6f;width: 600px;list-style-type: none; background: #fff; border-radius: 5px; color: #808080; margin: 50px; font: 16px Helvetica Neue,Arial,Helvetica,Geneva,sans-serif; box-shadow: 0px 0 14px #716f6f;'>

				<li style='width: 530px; text-align: center; padding: 20px 0;'><img src='https://www.raposoautoshopping.com.br/assets/img/logo.png' style='width: 120px;height:auto;'></li>

				<li><h3 style='border-bottom: solid 1px #808080; width: 530px;font-size: 18px; line-height: 24px; color: rgb(176,176,176); font-weight: bold; margin-top: 0px; margin-bottom: 18px; font-family: Helvetica Neue,Arial,Helvetica,Geneva,sans-serif;'>Contato através do site</h3></li>

				$valorCampos

				<li style='width: 530px; border-bottom: solid 1px #c0c0c0; text-align: right; padding: 5px 0 ;font: 16px Helvetica Neue,Arial,Helvetica,Geneva,sans-serif;'>$data</li>

				<li style='width: 530px;background: #d2d2d2; padding: 10px 0; text-align: right; margin: 5px 0 5px 15px;'><a target='_blank' href='https://www.conceitopublicidade.com.br' style='margin-right: 10px;'><img src='https://www.raposoautoshopping.com.br/assets/img/conceito.png' style=' width: 20px;' ></li >  

				</ul>
				<br /><br />
			</div>
		</div>
	</body>
	</html>";



	if (defaultsend($remetente, $assunto, $destinatario, $nomeremetente, $mensagemHTML,  $arquivo)) {

		$json = array('result' => 'sucesso');
	} else {

		$json = array('result' => 'falha');
	}
} else {

	$json = array('result' => 'Por favor, tente novamente');
}



exit(json_encode($json));
