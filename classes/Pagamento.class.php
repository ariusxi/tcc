<?php
	class Pagamento{

		public static function sendNvpRequest(array $requestNvp, $sandbox = false){
		    //Endpoint da API
		    $apiEndpoint  = 'https://api-3t.' . ($sandbox? 'sandbox.': null);
		    $apiEndpoint .= 'paypal.com/nvp';

		    //Executando a operação
		    $curl = curl_init();
		    curl_setopt($curl, CURLOPT_URL, $apiEndpoint);
		    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($curl, CURLOPT_POST, true);
		    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($requestNvp));
		  
		    $response = urldecode(curl_exec($curl));

		    curl_close($curl);
		    //Tratando a resposta
		    $responseNvp = array();
		    if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
		        foreach ($matches['name'] as $offset => $name) {
		            $responseNvp[$name] = $matches['value'][$offset];
		        }
		    }
		    //Verificando se deu tudo certo e, caso algum erro tenha ocorrido,
		    //gravamos um log para depuração.
		    if (isset($responseNvp['ACK']) && $responseNvp['ACK'] != 'Success') {
		        for ($i = 0; isset($responseNvp['L_ERRORCODE' . $i]); ++$i) {
		            $message = sprintf("PayPal NVP %s[%d]: %s\n",
		                               $responseNvp['L_SEVERITYCODE' . $i],
		                               $responseNvp['L_ERRORCODE' . $i],
		                               $responseNvp['L_LONGMESSAGE' . $i]);
		  
		            error_log($message);
		        }
		    }
		  
		    return $responseNvp;
		}

		public static function getNvpRequest(array $requestNvp, $sandbox = false){
			$postback = 'cmd=_notify-validate';

			foreach($_POST as $key => $value){
				$value = urlencode(stripslashes($value));
				$postback .= "&key=$value";
			}

			$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
			$header .= "Content-Type: application:/x-www-form-urlencoded\r\n";
			$header .= "Content-Length: " . strlen($postback) . "\r\n\r\n";

			$fp = fsockopen('ssl//www.paypal.com', 443, $errno, $errstr, 30);

			if(!$fp){
				echo "<h4>ERRO 500</h4><p>Desculpe, ocorreu um erro durante o processo tente novamente mais tarde</p>";
			}else{
				fputs($fp, $header . $postback);
				while(!feof($fp)){
					$response = fgets($fp, 1024);
					if(strcmp($response, "VERIFIED") == 0){
						$payment_status = $_POST['payment_status'];

						var_dump($payment_status);
					}else if(strcmp($response, "INVALID") == 0){
						echo "<h4>ERRO 500</h4><p>Desculpe, ocorreu um erro durante o processo tente novamente mais tarde</p>";
					}
				}
			}
			fclose($fp);
		}
	}