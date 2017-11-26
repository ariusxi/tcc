<?php
	require_once "classes/BD.class.php";
	require "classes/Pagamento.class.php";

	$sandbox = false;

	if($sandbox){
		$user = 'papumtransportes_api1.gmail.com';
		$pswd = '36Z3H7KZW5DDH3MA';
		$signature = 'AXiMFXRWkmt9OxNFdW5tF1mgblXiAvjKN870DjpgxszWPsvppeMP1pif';

		$paypalURL = 'https://www.sandbox.com/cgi-bin/webscr';
	}else{
		$user = 'papumtransportes_api1.gmail.com';
		$pswd = '36Z3H7KZW5DDH3MA';
		$signature = 'AXiMFXRWkmt9OxNFdW5tF1mgblXiAvjKN870DjpgxszWPsvppeMP1pif';

		$paypalURL = 'https://www.paypal.com/cgi-bin/webscr';
	}

	$dataquery = @BD::conn()->prepare("SELECT * FROM cargas WHERE id = ?");
	$dataquery->execute(array($explode[1]));
	$fetch = $dataquery->fetchObject();


	$select = @BD::conn()->prepare("SELECT lance_minimo FROM proposta WHERE id = ?");
	$select->execute(array($fetch->proposta));
	$proposta = $select->fetchObject();

	$requestNvp = array(
	    'USER' => $user,
	    'PWD' => $pswd,
	    'SIGNATURE' => $signature,
	  
	    'VERSION' => '108.0',
	    'METHOD'=> 'SetExpressCheckout',
	  
	    'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
	    'PAYMENTREQUEST_0_AMT' => $proposta->lance_minimo,
	    'PAYMENTREQUEST_0_CURRENCYCODE' => 'BRL',
	    'PAYMENTREQUEST_0_ITEMAMT' => $proposta->lance_minimo,
	    'PAYMENTREQUEST_0_INVNUM' => '1234',
	  
	    'L_PAYMENTREQUEST_0_NAME0' => $fetch->titulo,
	    'L_PAYMENTREQUEST_0_DESC0' => $fetch->titulo,
	    'L_PAYMENTREQUEST_0_AMT0' => $proposta->lance_minimo,
	    'L_PAYMENTREQUEST_0_QTY0' => '1',
	    'L_PAYMENTREQUEST_0_ITEMAMT' => $proposta->lance_minimo,
	  
	    'RETURNURL' => 'http://PayPalPartner.com.br/VendeFrete?return=1',
	    'CANCELURL' => 'http://PayPalPartner.com.br/CancelaFrete',
	    'BUTTONSOURCE' => 'BR_EC_EMPRESA'
	);

	$responseNvp = Pagamento::sendNvpRequest($requestNvp, $sandbox);

	if(isset($responseNvp['ACK']) && $responseNvp['ACK'] == 'Success'){
		$query = array(
			'cmd' => '_express-checkout',
			'token' => $responseNvp['TOKEN']
		);

		$redirectURL = sprintf('%s?%s', $paypalURL, http_build_query($query));

		header('Location: ' . $redirectURL);
	}else{
		echo '<h4>ERRO 500</h4><p>Desculpe, ocorreu um erro durante o processo tente novamente mais tarde</p>';
	}
