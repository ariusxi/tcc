<div class='container-fluid'>
	<div class="row">
		<div class="card transporte">
			<div class="spinner">
			  <div class="bounce1"></div>
			  <div class="bounce2"></div>
			  <div class="bounce3"></div>
			</div>
		</div>
		<div class="card success" style="display: none;">
			<h3>Transporte definido com sucesso</h3>
			<p>Quando o transporte for finalizado, defina que ele foi finalizado em seu perfil</p>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		var transporte = <?= $_GET['anuncio']; ?>;
		var url = "http://localhost:8000/";

		$(document).on("click", ".enviar", function(){
			var motorista = $("input[name=motorista]:checked").val();
			var veiculo = $("input[name=veiculo]:checked").val();
			var prazo = $("input[name=prazo]").val();

			if(motorista == undefined){
				$("#feedback").html("<div style='color:red;'>Você deve selecionar o motorista</div>");
				hidemessage("#feedback");
				return false;
			}
			if(veiculo == undefined){
				$("#feedback").html("<div style='color:red;'>Você deve selecionar o veiculo</div>");
				hidemessage("#feedback");
				return false;
			}
			if(prazo == ""){
				$("#feedback").html("<div style='color:red;'>Você deve informar o prazo de entrega</div>");
				hidemessage("#feedback");
				return false;
			}

			$.ajax({
				type: 'POST',
				url: url+'sys/Anuncio/transporte',
				dataType: 'json',
				data: {
					carga: transporte,
					motorista: motorista,
					veiculo: veiculo,
					prazo: prazo
				}, success: function(retorno){
					if(retorno == true){
						$(".transporte").hide();
						$(".success").fadeIn();
					}else{
						$("#feedback").html("<div style='color:red;'>Ocorreu um erro, tente novamente mais tarde</div>");
						hidemessage("#feedback");
					}
				}
			})
		});
		
		$(".transporte").ready(function(){
			$.ajax({
				type: 'POST',
				url: url+'sys/User/getDadosTransportadora',
				dataType: 'json',
				data: {
					anuncio: transporte
				},
				success: function(retorno){
					if(retorno.status == 'ok'){
						var html = "<h4>Definir Transporte</h4>";
							html += "<label>* campos obrigatórios</label>";
							html += "<p>* Motorista</p>";
							if(retorno.results.motoristas.length == 0){
								html += "<center><h4>Nenhum motorista cadastrado</h4></center>";
							}else{
								html += "<ul class='list-items'>";
								$.each(retorno.results.motoristas, function(i, value){
									html += "<li class='motorista_"+value.id+"'>";
									html += '<div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>';
									html += '<div class="details">';
									html += '<strong><label>'+value.firstname+' '+value.lastname+'</label></strong>';
									html += '<p>';
									html += 'RG: '+value.rg+'<br>';
									html += 'OE: '+value.oe+'<br>';
									html += 'CPF: '+value.cpf+'<br>';
									html += 'Nº Registro: '+value.nregistro+'<br>';
									html += 'Categoria da Carteira: '+value.cathab+'<br>';
									html += 'Validade: '+value.validade+'<br>';
									html += '</p>';
									html += '</div>';
									html += '<input type="radio" name="motorista" value="'+value.id+'"/>';
									html += "</li>";
								});
								html += "</ul>";
							}
							html += "<hr/>";
							html += "<p>* Veiculo</p>";
							if(retorno.results.veiculos.length == 0){
								html += "<center><h4>Nenhum veiculo cadastrado</h4></center>";
							}else{
								html += "<ul class='list-items'>";
								$.each(retorno.results.veiculos, function(i, value){
									html += "<li class='veiculo_"+value.id+"'>";
									html += '<div class="icon"><i class="fa fa-truck" aria-hidden="true"></i></div>';
									html += '<div class="details">';
									html += '<strong><label>'+value.modelo+'</label></strong>';
									html += '<p>';
									html += 'Placa: '+value.placa+'<br>';
									html += 'Marca: '+value.marca+'<br>';
									html += 'Chassi: '+value.chassi+'<br>';
									html += 'Ano de Fabricação: '+value.anofabricacao+'<br>';
									html += 'Ano do Modelo: '+value.anomodelo+'<br>';
									html += 'Renavam: '+value.renavam+'<br>';
									html += '</p>';
									html += '</div>';
									html += '<input type="radio" name="veiculo" value="'+value.id+'"/>';
									html += "</li>";
								});
								html += "</ul>";
							}
							html += '<table class="striped"><tr><td>* Prazo de Entrega</td><td><input type="date" class="form-control input-md" name="prazo"/></td></tr></table>';
							html += "<div id='feedback'></div>";
							html += "<button class='action-button enviar'>Mandar para transporte</button>";
						$(".transporte").html(html);
					}
				}
			});
		});
	});
</script>