<?php
	require "../config.php";
	if(isset($_SESSION['id_user'])){
		include_once "../classes/BD.class.php";
		$dataquery = @BD::conn()->prepare("SELECT * FROM configuracao_frete WHERE id_user = ?");
		$dataquery->execute([$_SESSION['id_user']]);
		$configuracao = $dataquery->fetchObject();
	}
?>
<div class="container-fluid">
	<div class="row">
		<div class="card proposta" style="display:block !important;">
			<form action="" method="post" id="proposta" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-12">
						<h4>Anúncio de Frete</h4>
					</div>
					<div class="col-md-12">
						<label>* campos obrigatórios</label>
					</div>
					<div class="col-md-12">
						<hr>
					</div>
					<div class="col-md-12">
						<p>Mudança</p>
					</div>
					<div class="col-md-8">
						<div id="map"></div>
					</div>
					<div class="col-md-4">
						<p>
							<i class="fa fa-map-marker" aria-hidden="true"></i>
							Origem: <span class='marker-origem'>Carregando...</span>
						</p>
						<p>
							<i class="fa fa-map-marker" aria-hidden="true"></i>
							Destino: <span class='marker-destino'>Carregando...</span>
						</p>
					</div>
					<div class="col-md-12">
						<hr>
					</div>
					<div class="col-md-12">
						<h4>Itens</h4>
					</div>
					<div class="col-md-12">
						<table class='striped items'>
							<thead>
								<tr>
									<th>#</th>
									<th>Nome</th>
									<th>Quantidade</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan='3'>
										<center>
											<div class="spinner">
											  	<div class="bounce1"></div>
											 	<div class="bounce2"></div>
											  	<div class="bounce3"></div>
											</div>
										</center>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<hr>
					</div>
					<div class="col-md-12" style='margin-top:20px'>
						<h4>Fazer proposta</h4>
					</div>
					<div class="ajuste">
						<div class="row">
							<div class="col-md-12">
								<span class="negrito">Origem: </span>
								<span class='origem'>XXXX</span>
								<span>Destino: </span>
								<span class='destino'>XXXX</span>
							</div>
							<div class="col-md-3">
								<label>Frete peso:</label>
								<input type="text" id="peso_total" class='form-control input-md'>
							</div>
							<div class="col-md-3">
								<label>&nbsp;</label>
								<input type="text" id="peso_tabela" class='form-control input-md'>
							</div>
							<div class="col-md-3">
								<label>Frete valor:</label>
								<input type="text" id="valor_total" class='form-control input-md'>
							</div>
							<div class="col-md-3">
								<label>&nbsp;</label>
								<input type="text" id="valor_tabela" class='form-control input-md'>
							</div>
							<div class="col-md-4">
								<label>TAS:</label>
								<input type="text" id="tas" class='form-control input-md' value="<?= $configuracao->tas; ?>">
							</div>
							<div class="col-md-4">
								<label>Despacho:</label>
								<input type="text" id="despacho" class='form-control input-md' value="<?= $configuracao->despacho; ?>">
							</div>
							<div class="col-md-4">
								<label>Pedagio:</label>
								<input type="text" id="pedagio" class='form-control input-md'>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<a class='btn btn-default action-button mostrar-ajuste'>Ajustar calculo</a>
					</div>
					<div class="col-md-4">
						<label>
							<span>* Lance inicial R$</span>
							<input type="text" id="lance_inicial" class='form-control input-md' placeholder="Valor inicial">
							<span>* Lance minimo R$</span>
							<input type="text" id="lance_minimo" class='form-control input-md' placeholder="Valor minimo">
						</label>
					</div>
					<div class="col-md-4">
						<label style="line-height: 80px;">
							Valor inicial total
							<span>R$ --,--</span>
						</label>
						<label>
							Valor minimo total
							<span>R$ --,--</span>
						</label>
					</div>
					<div class="col-md-4">
						<h3 style="line-height: 125px;">Valor total R$:</h3>
					</div>
					<div class="col-md-12">
						<hr>
					</div>
					<div class="col-md-12" style='margin-top:20px'>
						<h4>Informações</h4>
					</div>
					<div class="col-md-6">
						<label>* Informações para o cliente</label>
						<textarea class='form-control input-md' id='info_cliente' placeholder="Informações sobre prazos, preços, etc" maxlength="1000"></textarea>
					</div>
					<div class="col-md-6">
						<span>Aviso</span>
						<p>
							(<span id="letters">1,000</span> caracteres restantes)
							Não inclua dados de contato como e-mails ou números de telefone no seu lance. Estas informações serão públicas e poderão ser identificadas por outros usuários, resultando em uma possível suspensão da sua conta
						</p>
					</div>
					<div class="col-md-6">
						<span>* Termo e Condições Padrão</span>
						<textarea class='form-control input-md' id="termo_condicoes" placeholder="Informações sobre prazos, preços, etc"></textarea>
					</div>
					<div class="col-md-6">
						<span>Aviso</span>
						<p>Insira aqui um modelo de contrato ou as condições vigentes na politica da empresa para a execução do transporte</p>
					</div>
					<div class="col-md-12" id="feedback"></div>
					<div class="col-md-12">
						<input type="hidden" id="anuncio" value="<?= $_SESSION['anuncio']; ?>">
						<button class='submit proposta' style="display:block;">Fazer proposta</button>
					</div>
				</div>
			</form>
		</div>
		<div class="success card" style="display:none;">
			<div class="row">
				<div class="col-md-12">
					<h4>Proposta enviada</h4>
					<p>Sua proposta foi enviada, caso ela seja aceita voce será notificado em seu perfil</p>
				</div>
			</div>
		</div>
	</div>
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7Uycm85bGgWwbxsfsq-Y5bD2EGNbeBsk"></script>
<script type="text/javascript">
	var map;
	var url = "http://localhost/tcc/";

	function initMap(address) {
    	var map = new google.maps.Map(document.getElementById("map"), {
    		zoom: 14,
    		center: {lat: -23.57790671, lng: -46.72408238}
    	});
    	var geocoder = new google.maps.Geocoder();

    	geocodeAddress(geocoder, map, address);
  	}

  	function geocodeAddress(geocoder, resultsMap, address){
  		for(var i = 0; i < address.length; i++){
	  		geocoder.geocode({'address': address[0]}, function(results, status){
	  			if(status == 'OK'){
	  				resultsMap.setCenter(results[0].geometry.location);
	  				var marker = new google.maps.Marker({
	  					map: resultsMap,
	  					position: results[0].geometry.location
	  				});
	  			}else{
	  				alert('Geocode was not successful for the following reason: '+ status)
	  			}
	  		});
	  	}
  	}

  	$(".proposta").ready(function(){
  		$.ajax({
  			type: 'POST',
  			url: url+'sys/Anuncio/anuncio',
  			dataType: 'json',
  			success: function(retorno){
  				console.log(retorno);
  				if(retorno == false){
  					$(".proposta").html("<center><h4>Não foi encontrado esse anúncio para fazer uma proposta</h4></center>");
  				}else{
  					$.each(retorno.results, function(i, value){
  						$(".marker-origem, .origem").text(value.rua_r+", "+value.bairro_r+", "+value.cidade_r+" - "+value.estado_r);
  						$(".marker-destino, .destino").text(value.rua_e+", "+value.bairro_e+", "+value.cidade_e+" - "+value.estado_e);

  						var address = Array($(".origem").text(),$(".destino").text());

  						initMap(address);
  						$(".items tbody").html("");
  						$.each(value.itens, function(n, item){
  							$(".items tbody").append("<tr><td>"+(n+1)+"</td><td>"+item.nome+"</td><td>"+item.quantidade+"</td></tr>");
  						});
  					});
  				}
  			}, error: function(e){
  				console.log(e);
  			}
  		});
  	});

  	$("#info_cliente").keyup(function(){
  		var quantidade = $("#info_cliente").val().length;
  		var restantes = 1000 - quantidade;

  		$("#letters").text(restantes);
  	});
</script>