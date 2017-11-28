<?php
	class User extends BD{

		private static function atualizaConfiguracao($configuracoes){
			$pdo = @BD::conn();

			$status = false;
			$querys = array();
			foreach($configuracoes as $key => $configuracao){
				$querys[] = "UPDATE configuracao_frete_condicoes SET frete_peso_liquido = '".$configuracao['frete_peso_liquido']."', frete_ad_valorem = '".$configuracao['frete_ad_valorem']."', frete_peso_minimo = '".$configuracao['frete_peso_minimo']."' WHERE id_configuracao = '".$_SESSION['id_configuracao']."' AND frete_km = '".$configuracao['km']."'";

				$dataquery = $pdo->prepare("UPDATE configuracao_frete_condicoes SET frete_peso_liquido = :frete_peso_liquido, frete_ad_valorem = :frete_ad_valorem, frete_peso_minimo = :frete_peso_minimo WHERE id_configuracao = :id_configuracao AND frete_km = :frete_km");
				$dataquery->bindParam(":frete_peso_liquido", $parameters['frete_peso_liquido']);
				$dataquery->bindParam(":frete_ad_valorem", $parameters['frete_ad_valorem']);
				$dataquery->bindParam(":frete_peso_minimo", $parameters['frete_peso_minimo']);
				$dataquery->bindParam(":id_configuracao", $_SESSION['id_configuracao']);
				$dataquery->bindParam(":frete_km", $parameters['km']);
				if($dataquery->execute()){
					$status = true;
				}else{
					$status = false;
				}
			}

			return $status;
		}

		private static function verifyUser($cpf, $email){
			$pdo = @BD::conn();

			$dataquery = $pdo->prepare("SELECT * FROM users WHERE cpf = :cpf OR email = :email");
			$dataquery->bindParam(":cpf", $cpf);
			$dataquery->bindParam(":email", $email);
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function loginAction($parameters = array()){
			$pdo = parent::conn();
			$arr = array("status" => true, "results" => array());

			$dataquery = $pdo->prepare("SELECT * FROM users WHERE (email = :login OR cpf = :login) AND password = :password");
			$dataquery->bindParam(":login", $parameters['login']);
			$dataquery->bindParam(":password", $parameters['senha']);
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				session_start();
				$fetch = $dataquery->fetchObject();
				$select = $pdo->prepare("SELECT id FROM configuracao_frete WHERE id_user = ?");
				$select->execute(array($fetch->id));
				$config = $select->fetchObject();
				if($fetch->level == 0){
					$arr["results"] = array(
						"fullname" => $fetch->firstname." ".$fetch->lastname,
						"cpf" => $fetch->cpf,
						"rg" => $fetch->rg,
						"datanasc" => date("d/m/Y", strtotime($fetch->datanasc)),
						"telefone" => $fetch->telefone,
						"celular" => $fetch->celular,
						"email" => $fetch->email,
						"level" => $fetch->level
					);
				}else{
					$_SESSION['id_configuracao'] = $config->id;
					$arr['results'] = array(
						"fullname" => $fetch->firstname,
						"razao" => $fetch->lastname,
						"cnpj" => $fetch->cpf,
						"telefone" => $fetch->telefone,
						"celular" => $fetch->celular,
						"email" => $fetch->email,
						"level" => $fetch->level
					);
				}
				$_SESSION['id_user'] = $fetch->id;
				$_SESSION['level'] = $fetch->level;
			}else{
				$arr["status"] = false;
			}

			return $arr;
		}

		public function editAction($parameters = array()){
			$pdo = parent::conn();
			session_start();

			$filtro = "";
			if($parameters['password'] != ""){
				$filtro = ", password = '".$parameters['password']."'";
			}

			if($_SESSION['level'] == 1){
				$parameters["rg"] = "";
				$parameters["datanasc"] = "";
				$parameters["sexo"] = "";
			}

			$dataquery = $pdo->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, cpf = :cpf, rg = :rg, datanasc = :datanasc, sexo = :sexo, telefone = :telefone, celular = :celular, email = :email ".$filtro." WHERE id = :id");
			$dataquery->bindParam(":firstname", $parameters['firstname']);
			$dataquery->bindParam(":lastname", $parameters['lastname']);
			$dataquery->bindParam(":cpf", $parameters['cpf']);
			$dataquery->bindParam(":rg", $parameters['rg']);
			$dataquery->bindParam(":datanasc", $parameters['datanasc']);
			$dataquery->bindParam(":sexo", $parameters['sexo']);
			$dataquery->bindParam(":telefone", $parameters['telefone']);
			$dataquery->bindParam(":celular", $parameters['celular']);
			$dataquery->bindParam(":email", $parameters['email']);
			$dataquery->bindParam(":id", $_SESSION['id_user']);
			if($dataquery->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function clienteAction($parameters = array()){
			$pdo = parent::conn();

			$existe = User::verifyUser($parameters['cpf'], $parameters['email']);
			if($existe == true){
				return 'existe';
			}

			// Level 0 Cliente
			// Level 1 Transportadora

			$dataquery = $pdo->prepare("INSERT INTO users(firstname, lastname, cpf, rg, datanasc, sexo, telefone, celular, email, password, level, created_at) VALUES(:firstname, :lastname, :cpf, :rg, :datanasc, :sexo, :telefone, :celular, :email, :password, :level, NOW())");
			$dataquery->bindParam(":firstname", $parameters['firstname']);
			$dataquery->bindParam(":lastname", $parameters['lastname']);
			$dataquery->bindParam(":cpf", $parameters['cpf']);
			$dataquery->bindParam(":rg", $parameters['rg']);
			$dataquery->bindParam(":datanasc", $parameters['datanasc']);
			$dataquery->bindParam(":sexo", $parameters['sexo']);
			$dataquery->bindParam(":telefone", $parameters['telefone']);
			$dataquery->bindParam(":celular", $parameters['celular']);
			$dataquery->bindParam(":email", $parameters['email']);
			$dataquery->bindParam(":password", $parameters['password']);
			$dataquery->bindParam(":level", $parameters['level']);
			if($dataquery->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function transportadoraAction($parameters = array()){
			$pdo = parent::conn();

			$existe = User::verifyUser($parameters['cnpj'], $parameters['email']);
			if($existe == true){
				return 'existe';
			}

			$dataquery = $pdo->prepare("INSERT INTO users(firstname, lastname, rg, cpf, telefone, celular, datanasc, email, sexo, password, level, created_at) VALUES(:firstname, :lastname, '', :cpf, :telefone, :celular, '', :email, '', :password, :level, NOW())");
			$dataquery->bindParam(":firstname", $parameters['firstname']);
			$dataquery->bindParam(":lastname", $parameters['lastname']);
			$dataquery->bindParam(":cpf", $parameters['cnpj']);
			$dataquery->bindParam(":telefone", $parameters['telefone']);
			$dataquery->bindParam(":celular", $parameters['celular']);
			$dataquery->bindParam(":email", $parameters['email']);
			$dataquery->bindParam(":password", $parameters['password']);
			$dataquery->bindParam("level", $parameters['level']);
			if($dataquery->execute()){
				$select = $pdo->prepare("SELECT id FROM users WHERE cpf = ? AND email = ?");
				$select->execute(array($parameters['cnpj'], $parameters['email']));
				$user = $select->fetchObject();

				$insert = $pdo->prepare("INSERT INTO configuracao_frete(id_user, gris, despacho, tas) VALUES (?,0,0,0)");
				$insert->execute(array($user->id));

				$select = $pdo->prepare("SELECT id FROM configuracao_frete WHERE id_user = ?");
				$select->execute(array($user->id));
				$config = $select->fetchObject();

				$item = 0;
				for($i = 0; $i < 6; $i++){
					if($item == 30){
						$item = 50;
					}else if($item == 50){
						$item += 50;
					}else if($item == 100){
						$item = 999;
					}else{
						$item += 10;
					}

					$insert = $pdo->prepare("INSERT INTO configuracao_frete_condicoes(id_configuracao,frete_peso_liquido,frete_ad_valorem,frete_peso_minimo,	frete_km) VALUES(?,0,0,0,?)");
					$insert->execute(array($config->id, $item));
				}
				return true;
			}else{
				return false;
			}
		}

		public function freteAction($parameters = array()){
			session_start();
			$pdo = parent::conn();

			$dataquery = $pdo->prepare("UPDATE configuracao_frete SET gris = :gris, despacho = :despacho, tas = :tas WHERE id_user = :id_user");
			$dataquery->bindParam(":gris", $parameters['gris']);
			$dataquery->bindParam(":despacho", $parameters['despacho']);
			$dataquery->bindParam(":tas", $parameters['tas']);
			$dataquery->bindParam(":id_user", $_SESSION['id_user']);
			if($dataquery->execute()){
				$status = User::atualizaConfiguracao($parameters['configuracao']);
				if($status == true){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		public function getDadosTransportadoraAction($parameters = array()){
			session_start();
			$pdo = parent::conn();
			$arr = array("status" => "ok", "results" => array("motoristas" => array(), "veiculos" => array(), "endereco" => array()));

			$dataquery = $pdo->prepare("SELECT * FROM motorista WHERE id_user = ?");
			$dataquery->execute(array($_SESSION['id_user']));
			while($fetch = $dataquery->fetchObject()){
				$arr["results"]["motoristas"][] = array(
					"id" => $fetch->id,
					"firstname" => $fetch->firstname,
					"lastname" => $fetch->lastname,
					"rg" => $fetch->rg,
					"oe" => $fetch->oe,
					"cpf" => $fetch->cpf,
					"nregistro" => $fetch->nregistro,
					"cathab" => $fetch->cathab,
					"validade" => date("d/m/Y", strtotime($fetch->validade))
				);
			}

			$dataquery = $pdo->prepare("SELECT * FROM veiculo WHERE id_user = ?");
			$dataquery->execute(array($_SESSION['id_user']));
			while($fetch = $dataquery->fetchObject()){
				$arr["results"]["veiculos"][] = array(
					"id" => $fetch->id,
					"renavam" => $fetch->renavam,
					"chassi" => $fetch->chassi,
					"placa" => $fetch->placa,
					"modelo" => $fetch->modelo,
					"marca" => $fetch->marca,
					"anomodelo" => $fetch->anomodelo,
					"anofabricacao" => $fetch->anofabricacao,
					"categoria" => $fetch->categoria,
					"comentario" => $fetch->comentario
				);
			}

			return $arr;
		}

	}