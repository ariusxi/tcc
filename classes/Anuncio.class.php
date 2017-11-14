<?php
	class Anuncio extends BD{

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

	}