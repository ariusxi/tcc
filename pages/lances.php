<div class="container-fluid">
	<div class="row">
		<div class="card">
			<h3>Lances</h3>
			<div id="feedback"></div>
			<div class="lances">
				<div class="spinner">
				  	<div class="bounce1"></div>
				  	<div class="bounce2"></div>
				  	<div class="bounce3"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		var url = "http://localhost/tcc/";

		$(".lances").ready(function(){
			$.ajax({
				type: 'POST',
				url: url+'sys/Anuncio/propostas',
				dataType: 'json',
				success: function(retorno){
					console.log(retorno);
					if(retorno == false){
						$(".lances").html("<center><h4>Nenhuma proposta recebida</h4></center>");
					}else{
						var html = "<ul class='list-items'>";
						$.each(retorno.results, function(i, value){
							html += "<li class='proposta_"+value.id+"'>";
							html += '<div class="icon"><i class="fa fa-truck" aria-hidden="true"></i></div>';
							html += '<div class="details">';
							html += '<a href="" class="page" id="perfil/'+value.id+'"><strong>'+value.nome_transportadora+'</strong></a>';
							html += '<p>';
							html += 'Anúncio: '+value.anuncio+'<br/>';
							html += 'Lance mínimo: R$'+value.lance_minimo+'<br/>';
							html += 'Proposta feita em '+value.created_at+'<br/>';
							html += '<button type="button" class="acao btn btn-success" id="1">Aceitar</button>&nbsp;<button type="button" class="acao btn btn-danger" id="2">Recusar</button>';
							html += '</p>';
							html += '</div>';
							html += '<a class="view" id="'+value.id+'"><i class="fa fa-eye" aria-hidden="true"></i></a>';
							html += '</li>';
						});
						html += "</ul>";
						$(".lances").html(html);
					}
				}
			});
		});
	});
</script>