<?php
	class Anuncio extends BD{

		private static function verifyAnuncio($proposta){
			$pdo = @BD::conn();

			$dataquery = $pdo->prepare("SELECT id_cargas FROM proposta WHERE id = :id");
			$dataquery->bindParam(":id", $proposta);
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				$fetch = $dataquery->fetchObject();
				$select = $pdo->prepare("SELECT id FROM cargas WHERE id = '$fetch->id_cargas' AND status = 2");
				$select->execute();
				if($select->rowCount() > 0){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		private static function insereItems($parameters = array(), $id_evento){
			$pdo = @BD::conn();
			$status = false;

			foreach($parameters as $key => $value){
				$dataquery = $pdo->prepare("INSERT INTO items_cargas(id_cargas,nome,comp,largura,altura,medida,peso,quantidade) VALUES(:id_cargas,:nome,:comp,:largura,:altura,:medida,:peso,:quantidade)");
				$dataquery->bindParam(':id_cargas', $id_evento);
				$dataquery->bindParam(':nome', $value['nome']);
				$dataquery->bindParam(':comp', $value['comp']);
				$dataquery->bindParam(':largura', $value['largura']);
				$dataquery->bindParam(':altura', $value['altura']);
				$dataquery->bindParam(':medida', $value['medida']);
				$dataquery->bindParam(':peso', $value['peso']);
				$dataquery->bindParam(':quantidade', $value['quantidade']);
				if($dataquery->execute()){
					$status = true;
				}else{
					$status = false;
				}
			}

			return $status;
		}

		public function carregarAction($parameters = array()){
			session_start();
			$pdo = parent::conn();
			$arr = array("status" => "ok", "results" => array());
			$ids_carregados = array();

			$dataquery = $pdo->prepare("SELECT cargas.id, cargas.titulo, cargas.created_at,categorias.categoria, subcategorias.subcategoria FROM cargas INNER JOIN categorias ON cargas.categoria = categorias.id INNER JOIN subcategorias ON subcategorias.id = cargas.id WHERE cargas.id_user = :id_user AND cargas.status = 0");
			$dataquery->bindParam(":id_user", $_SESSION['id_user']);
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				while($fetch = $dataquery->fetchObject()){
					if(!in_array($fetch->id, $ids_carregados)){
						$arr["results"][] = array(
							"id" => $fetch->id,
							"titulo" => $fetch->titulo,
							"created_at" => date("d/m/Y", strtotime($fetch->created_at)),
							"categoria" => $fetch->categoria,
							"subcategoria" => $fetch->subcategoria
						);
						$ids_carregados[] = $fetch->id;
					}
				}

				return $arr;
			}else{
				return false;
			}
		}

		public function historicoAction($parameters = array()){
			session_start();
			$pdo = parent::conn();
			$arr = array("status" => "ok", "results" => array());

			$dataquery = $pdo->prepare("SELECT id, titulo, status, created_at FROM cargas WHERE id_user = :id_user");
			$dataquery->bindParam(":id_user", $_SESSION['id_user']);
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				while($fetch = $dataquery->fetchObject()){
					$status = "Em aberto";
					if($fetch->status == 1){
						$status = "Combinando";
					}else if($fetch->status == 2){
						$status = "Em processo";
					}else if($fetch->status == 3){
						$status = "Finalizado";
					}

					$arr["results"][] = array(
						"id" => $fetch->id,
						"titulo" => $fetch->titulo,
						"status" => $status,
						"criado" => date("d/m/Y H:i:s", strtotime($fetch->created_at))
					);
				};

				return $arr;
			}else{
				return false;
			}
		} 

		public function registerAction($parameters = array()){
			session_start();
			$pdo = parent::conn();

			$dataquery = $pdo->prepare("INSERT INTO cargas(id_user, titulo, categoria, subcategoria, cep_r, rua_r, numero_r, bairro_r, cidade_r, estado_r, cep_e, rua_e, numero_e, bairro_e, cidade_e, estado_e, descricao, status, proposta, created_at) VALUES(:id_user,:titulo,:categoria,:subcategoria,:cep_r,:rua_r,:numero_r,:bairro_r,:cidade_r,:estado_r,:cep_e,:rua_e,:numero_e,:bairro_e,:cidade_e,:estado_e,:descricao,0,0,NOW())");
			$dataquery->bindParam(':id_user', $_SESSION['id_user']);
			$dataquery->bindParam(':titulo', $parameters['titulo']);
			$dataquery->bindParam(':categoria', $parameters['categoria']);
			$dataquery->bindParam(':subcategoria', $parameters['subcategoria']);
			$dataquery->bindParam(':cep_r', $parameters['cep_r']);
			$dataquery->bindParam(':rua_r', $parameters['rua_r']);
			$dataquery->bindParam(':numero_r', $parameters['numero_r']);
			$dataquery->bindParam(':bairro_r', $parameters['bairro_r']);
			$dataquery->bindParam(':cidade_r', $parameters['cidade_r']);
			$dataquery->bindParam(':estado_r', $parameters['estado_r']);
			$dataquery->bindParam(':cep_e', $parameters['cep_e']);
			$dataquery->bindParam(':rua_e', $parameters['rua_e']);
			$dataquery->bindParam(':numero_e', $parameters['numero_e']);
			$dataquery->bindParam(':bairro_e', $parameters['bairro_e']);
			$dataquery->bindParam(':cidade_e', $parameters['cidade_e']);
			$dataquery->bindParam(':estado_e', $parameters['estado_e']);
			$dataquery->bindParam(':descricao', $parameters['descricao']);
			if($dataquery->execute()){
				$select = $pdo->prepare("SELECT id FROM cargas WHERE id_user = ? AND cep_r = ? AND cep_e = ? AND created_at = NOW()");
				$select->execute([$_SESSION['id_user'], $parameters['cep_r'], $parameters['cep_e']]);
				$fetch = $select->fetchObject();
				if(Anuncio::insereItems($parameters['items'], $fetch->id)){
					Anuncio::atualizaViews($parameters['categoria'], $parameters['subcategoria']);
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		private static function atualizaViews($categoria, $subcategoria){
			$pdo = @BD::conn();

			$categoria = $categoria;
			$subcategoria = $subcategoria;
			
			$category = $pdo->prepare("SELECT views FROM categorias WHERE id = '".$categoria."'");
			$category->execute();
			$c = $category->fetchObject();
			$c  = $c->views;
			$c = $c + 1;
			$category = $pdo->prepare("UPDATE categorias SET views = '".$c."' WHERE id = '".$categoria."'");
			$category->execute();
			
			$subcategory = $pdo->prepare("SELECT views FROM subcategorias WHERE id = '".$subcategoria."'");
			$subcategory->execute();
			$s = $subcategory->fetchObject();
			$s = $s->views;
			$s = $s + 1;
			$subcategory = $pdo->prepare("UPDATE subcategorias SET views = '".$s."' WHERE id = '".$subcategoria."'");
			$subcategory->execute();
		}

		public function categoriasAction($parameters = array()){
			$pdo = parent::conn();
			$arr = array("status" => "ok", "results" => array());
			$ids = array();

			$dataquery = $pdo->prepare("SELECT * FROM categorias");
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				while($fetch = $dataquery->fetchObject()){
					if(!in_array($fetch->id, $ids)){
						$arr["results"][] = array(
							"id" => $fetch->id,
							"categoria" => $fetch->categoria,
							"views" => $fetch->views
						);
						$ids[] = $fetch->id;
					}
				}

				return $arr;
			}else{
				return false;
			}
		}

		public function subcategoriasAction($parameters = array()){
			$pdo = parent::conn();
			$arr = array("status" => "ok", "results" => array());
			$ids = array();

			$dataquery = $pdo->prepare("SELECT * FROM subcategorias WHERE id_categoria = :id_categoria");
			$dataquery->bindParam(":id_categoria", $parameters['id_categoria']);
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				while($fetch = $dataquery->fetchObject()){
					if(!in_array($fetch->id, $ids)){
						$arr["results"][] = array(
							"id" => $fetch->id,
							"subcategoria" => $fetch->subcategoria,
							"views" => $fetch->views
						);
						$ids[] = $fetch->id;
					}
				}

				return $arr;
			}else{
				return false;
			}
		}

		public function searchAction($parameters = array()){
			session_start();
			$pdo = parent::conn();
			$arr = array("status" => "ok", "results" => array(), "more" => false);
			$_SESSION['pesquisa'] = $parameters['search'];
			$_SESSION['ids_carregados'] = array();

			$dataquery = $pdo->prepare("SELECT * FROM cargas WHERE titulo LIKE '%".$parameters['search']."%' OR rua_r LIKE '%".$parameters['search']."%' OR bairro_r LIKE '%".$parameters['search']."%' OR cidade_r  LIKE '%".$parameters['search']."%' OR rua_e LIKE '%".$parameters['search']."%' OR bairro_e LIKE '%".$parameters['search']."%' OR cidade_e LIKE '%".$parameters['search']."%' AND status = 0");
			$dataquery->execute();
			if($dataquery->rowCount() > 5){
				$arr["more"] = true;
			}

			$dataquery = $pdo->prepare("SELECT * FROM cargas WHERE titulo LIKE '%".$parameters['search']."%' OR rua_r LIKE '%".$parameters['search']."%' OR bairro_r LIKE '%".$parameters['search']."%' OR cidade_r  LIKE '%".$parameters['search']."%' OR rua_e LIKE '%".$parameters['search']."%' OR bairro_e LIKE '%".$parameters['search']."%' OR cidade_e LIKE '%".$parameters['search']."%' AND status = 0 ORDER BY id LIMIT 5");
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				while($fetch = $dataquery->fetchObject()){
					$arr["results"][] = array(
						"id" => $fetch->id,
						"titulo" => $fetch->titulo,
						"cidade_r" => $fetch->cidade_r,
						"cidade_e" => $fetch->cidade_e,
						"estado_r" => $fetch->estado_r,
						"estado_e" => $fetch->estado_e,
						"data" => date("d/m/Y H:i:s", strtotime($fetch->created_at))
					);
					$_SESSION['ids_carregados'][] = $fetch->id;
				}
				return $arr;
			}else{
				return false;
			}
		}

		public function loadMoreAction($parameters = array()){
			session_start();
			$pdo = parent::conn();
			$arr = array("status" => "ok", "results" => array(), "more" => false);
			$implode_ids = implode(",", $_SESSION['ids_carregados']);
			$parameters['search'] = $_SESSION['pesquisa'];

			$dataquery = $pdo->prepare("SELECT * FROM cargas WHERE (titulo LIKE '%".$parameters['search']."%' OR rua_r LIKE '%".$parameters['search']."%' OR bairro_r LIKE '%".$parameters['search']."%' OR cidade_r  LIKE '%".$parameters['search']."%' OR rua_e LIKE '%".$parameters['search']."%' OR bairro_e LIKE '%".$parameters['search']."%' OR cidade_e LIKE '%".$parameters['search']."%') AND id NOT IN($implode_ids) AND status = 0");
			$dataquery->execute();
			if($dataquery->rowCount() > 5){
				$arr["more"] = true;
			}

			$dataquery = $pdo->prepare("SELECT * FROM cargas WHERE (titulo LIKE '%".$parameters['search']."%' OR rua_r LIKE '%".$parameters['search']."%' OR bairro_r LIKE '%".$parameters['search']."%' OR cidade_r  LIKE '%".$parameters['search']."%' OR rua_e LIKE '%".$parameters['search']."%' OR bairro_e LIKE '%".$parameters['search']."%' OR cidade_e LIKE '%".$parameters['search']."%') AND id NOT IN($implode_ids) AND status = 0 ORDER BY id LIMIT 5");
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				while($fetch = $dataquery->fetchObject()){
					$arr["results"][] = array(
						"id" => $fetch->id,
						"titulo" => $fetch->titulo,
						"cidade_r" => $fetch->cidade_r,
						"cidade_e" => $fetch->cidade_e,
						"estado_r" => $fetch->estado_r,
						"estado_e" => $fetch->estado_e,
						"data" => date("d/m/Y H:i:s", strtotime($fetch->created_at))
					);
					$_SESSION['ids_carregados'][] = $fetch->id;
				}

				return $arr;
			}else{
				return false;
			}
		}

		public function visualizaAction($parameters = array()){
			session_start();
			$pdo = parent::conn();
			$arr = array("status" => "ok", "results" => array());

			$dataquery = $pdo->prepare("SELECT * FROM cargas WHERE id = :id AND id_user = :id_user");
			$dataquery->bindParam(":id", $parameters['anuncio']);
			$dataquery->bindParam(":id_user", $_SESSION['id_user']);
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				$fetch = $dataquery->fetchObject();
				$status = "Em aberto";
				if($fetch->status == 1){
					$status = "Combinando";
				}else if($fetch->status == 2){
					$status = "Em processo";
				}else if($fetch->status == 3){
					$status = "Finalizado";
				}
				$arr["results"][0] = array(
					"id" => $fetch->id,
					"titulo" => $fetch->titulo,
					"descricao" => $fetch->descricao,
					"rua_r" => $fetch->rua_r,
					"numero_r" => $fetch->numero_r,
					"bairro_r" => $fetch->bairro_r,
					"cidade_r" => $fetch->cidade_r,
					"estado_r" => $fetch->estado_r,
					"rua_e" => $fetch->rua_e,
					"numero_e" => $fetch->numero_e,
					"bairro_e" => $fetch->bairro_e,
					"cidade_e" => $fetch->cidade_e,
					"estado_e" => $fetch->estado_e,
					"itens" => array(),
					"proposta" => array(),
					"status" => $fetch->status,
					"status_text" => $status,
					"retirada" => "",
					"entrega" => ""
				);

				if($fetch->proposta != 0){
					$select = $pdo->prepare("SELECT * FROM proposta WHERE id = :id");
					$select->bindParam(":id", $fetch->proposta);
					$select->execute();
					$proposta = $select->fetchObject();

					$select = $pdo->prepare("SELECT firstname FROM users WHERE id = ?");
					$select->execute(array($proposta->id_usuario));
					$transportadora = $select->fetchObject();

					$arr["results"][0]['proposta'] = array(
						"id" => $proposta->id,
						"id_transportadora" => $proposta->id_usuario,
						"anuncio" => $fetch->titulo,
						"nome_transportadora" => $transportadora->firstname,
						"lance_minimo" => $proposta->lance_minimo,
						"created_at" => date("d/m/Y H:i:s",strtotime($proposta->created_at))
					);
				}

				$select = $pdo->prepare("SELECT nome, quantidade FROM items_cargas WHERE id_cargas = ?");
				$select->execute(array($fetch->id));
				while($item = $select->fetchObject()){
					$arr["results"][0]['itens'][] = array(
						"nome" => $item->nome,
						"quantidade" => $item->quantidade
					);
				}


				return $arr;
			}else{
				return false;
			}
		}

		public function viewAction($parameters = array()){
			$pdo = parent::conn();
			$arr = array("status" => "ok", "results" => array());

			$dataquery = $pdo->prepare("SELECT * FROM cargas WHERE id = :id AND status = 0");
			$dataquery->bindParam(":id", $parameters['anuncio']);
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				while($fetch = $dataquery->fetchObject()){
					$arr['results'][] = array(
						"id" => $fetch->id,
						"titulo" => $fetch->titulo,
						"cidade_r" => $fetch->cidade_r,
						"estado_r" => $fetch->estado_r,
						"cidade_e" => $fetch->cidade_e,
						"estado_e" => $fetch->estado_e,
						"descricao" => $fetch->descricao,
						"data" => date("d/m/Y H:i:s", strtotime($fetch->created_at))
					);
				}
				return $arr;
			}else{
				return false;
			}
		}

		public function defineAction($parameters = array()){
			session_start();
			$_SESSION['anuncio'] = $parameters['anuncio'];
		}

		public function anuncioAction($parameters = array()){
			session_start();
			$pdo = parent::conn();
			$arr = array("status" => "ok", "results" => array());

			$dataquery = $pdo->prepare("SELECT * FROM cargas WHERE id = :id");
			$dataquery->bindParam(":id", $_SESSION['anuncio']);
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				$fetch = $dataquery->fetchObject();
				$arr["results"][0] = array(
					"id" => $fetch->id,
					"titulo" => $fetch->titulo,
					"rua_r" => $fetch->rua_r,
					"numero_r" => $fetch->numero_r,
					"bairro_r" => $fetch->bairro_r,
					"cidade_r" => $fetch->cidade_r,
					"estado_r" => $fetch->estado_r,
					"rua_e" => $fetch->rua_e,
					"numero_e" => $fetch->numero_e,
					"bairro_e" => $fetch->bairro_e,
					"cidade_e" => $fetch->cidade_e,
					"estado_e" => $fetch->estado_e,
					"itens" => array(),
					"retirada" => "",
					"entrega" => ""
				);

				$select = $pdo->prepare("SELECT nome, quantidade FROM items_cargas WHERE id_cargas = ?");
				$select->execute(array($fetch->id));
				while($item = $select->fetchObject()){
					$arr["results"][0]['itens'][] = array(
						"nome" => $item->nome,
						"quantidade" => $item->quantidade
					);
				}

				return $arr;
			}else{
				return false;
			}
		}

		public function propostaAction($parameters = array()){
			session_start();
			$pdo = parent::conn();

			// Mostrar erros do PHP PDO
			// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$dataquery = $pdo->prepare("INSERT INTO proposta(status, id_cargas, id_usuario, peso_total, peso_tabela, valor_total, valor_tabela, tas, despacho, pedagio, lance_inicial, lance_minimo, info_cliente, termo_condicoes, created_at) VALUES(0, :id_cargas, :id_usuario, :peso_total, :peso_tabela, :valor_total, :valor_tabela, :tas, :despacho, :pedagio, :lance_inicial, :lance_minimo, :info_cliente, :termo_condicoes, NOW())");
			$dataquery->bindParam(":id_cargas", $parameters['anuncio']);
			$dataquery->bindParam(":id_usuario", $_SESSION['id_user']);
			$dataquery->bindParam(":peso_total", $parameters['peso_total']);
			$dataquery->bindParam(":peso_tabela", $parameters['peso_tabela']);
			$dataquery->bindParam(":valor_total", $parameters['valor_total']);
			$dataquery->bindParam(":valor_tabela", $parameters['valor_tabela']);
			$dataquery->bindParam(":tas", $parameters['tas']);
			$dataquery->bindParam(":despacho", $parameters['despacho']);
			$dataquery->bindParam(":pedagio", $parameters['pedagio']);
			$dataquery->bindParam(":lance_inicial", $parameters['lance_inicial']);
			$dataquery->bindParam(":lance_minimo", $parameters['lance_minimo']);
			$dataquery->bindParam(":info_cliente", $parameters['info_cliente']);
			$dataquery->bindParam(":termo_condicoes", $parameters['termo_condicoes']);
			if($dataquery->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function propostasAction($parameters = array()){
			session_start();
			$pdo = parent::conn();
			$arr = array("status" => "ok", "results" => array());

			$dataquery = $pdo->prepare("SELECT p.*, c.titulo FROM proposta AS p INNER JOIN cargas AS c ON p.id_cargas = c.id INNER JOIN users AS u ON c.id_user = u.id WHERE u.id = :id_user AND p.status = 0 AND c.status = 0");
			$dataquery->bindParam(":id_user", $_SESSION['id_user']);
			$dataquery->execute();
			if($dataquery->rowCount() > 0){
				while($fetch = $dataquery->fetchObject()){
					$select = $pdo->prepare("SELECT firstname FROM users WHERE id = ?");
					$select->execute(array($fetch->id_usuario));
					$transportadora = $select->fetchObject();

					$arr["results"][] = array(
						"id" => $fetch->id,
						"id_transportadora" => $fetch->id_usuario,
						"anuncio" => $fetch->titulo,
						"nome_transportadora" => $transportadora->firstname,
						"lance_minimo" => $fetch->lance_minimo,
						"created_at" => date("d/m/Y H:i:s",strtotime($fetch->created_at))
					);
				}
				return $arr;
			}else{
				return false;
			}
		}

		public function respondePropostaAction($parameters = array()){
			$pdo = parent::conn();

			if(Anuncio::verifyAnuncio($parameters['proposta'])){
				return 'already';
			}

			$dataquery = $pdo->prepare("UPDATE proposta SET status = :status WHERE id = :id");
			$dataquery->bindParam(":status", $parameters['response']);
			$dataquery->bindParam(":id", $parameters['proposta']);
			if($dataquery->execute()){
				$select = $pdo->prepare("SELECT id_cargas FROM proposta WHERE id = ?");
				$select->execute(array($parameters['proposta']));
				$proposta = $select->fetchObject();

				$update = $pdo->prepare("UPDATE cargas SET status = 2, proposta = ? WHERE id = ?");
				if($update->execute(array($parameters['proposta'], $proposta->id_cargas))){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

	}