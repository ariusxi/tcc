<div class="container-fluid">
	<div class="row anuncio">
		<div class="spinner">
		  <div class="bounce1"></div>
		  <div class="bounce2"></div>
		  <div class="bounce3"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		var url = "http://localhost/tcc/";
		var anuncio = "<?= $_GET['anuncio']; ?>";

		$(".anuncio").ready(function(){
			$.ajax({
				type: 'POST',
				url: url+'sys/Anuncio/view',
				dataType: 'json',
				data: {
					anuncio: anuncio
				}, success: function(retorno){
					if(retorno == false){
						$(".anuncio").html("<center><h4>Desculpe, mas esse anúncio não foi encontrado</h4></center>");
					}else{
						var html = "";
						$.each(retorno.results, function(i, value){
							html += "<div class='card'><div class='row'><div class='col-md-12'>";
							html += "<h4>"+value.titulo+"</h4>";
							html += "De "+value.cidade_r+", "+value.estado_e+" para "+value.cidade_e+", "+value.estado_e+"<br/>";
							html += "Anúnciado em "+value.data;
							html += "</div></div></div>";
							html += "<div class='card'><div class='row'><div class='col-md-12'>";
							html += "<p>"+value.descricao+"</p>";
							html += "</div></div></div>";
							html += "<div class='card'><div class='row'><div class='col-md-12'>";
							html += "<button class='submit proposta' id='"+value.id+"'>Fazer proposta</button>";
							html += "</div></div></div>";
						});
						$(".anuncio").html(html);
					}
				}
			});
		});
	});
</script>