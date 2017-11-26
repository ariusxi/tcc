<?php session_start(); ?>
<div class="container-fluid">
	<div class="row">
		<div class="card">
			<?php if($_SESSION['level'] == 0){ ?>
			<h3>Histórico de anúncios</h3>
			<?php }else{ ?>
			<h3>Histórico de propostas</h3>
			<?php } ?>
			<div class='historico'>
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
	$(document).ready(function(){
		var url = "http://localhost/tcc/";

		$.ajax({
			type: 'POST',
			url: url+'sys/Anuncio/historico',
			dataType: 'json',
			success: function(retorno){
				console.log(retorno);
				if(retorno == false){
					$(".historico").html("<center><h5>Nenhum Anúncio Registrado</h5></center>");
				}else{
					if(localStorage.getItem("level") == 0){
						var html = "<table><thead><tr><th>#</th><th>Título</th><th>Status</th><th>Criado em</th></tr></tbody><tbody>";
						$.each(retorno.results, function(i, value){
							html += "<tr><td>"+value.id+"</td><td>"+value.titulo+"</td><td>"+value.status+"</td><td><a href='#!' class='view-anuncio' id='"+value.id+"'>Ver detalhes</a></td></tr>";
						});
						html += "</tbody></table>"
						$(".historico").html(html);
						$(".historico table").dataTable({
							language: {
							    "sEmptyTable": "Nenhum registro encontrado",
							    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
							    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
							    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
							    "sInfoPostFix": "",
							    "sInfoThousands": ".",
							    "sLengthMenu": "_MENU_ resultados por página",
							    "sLoadingRecords": "Carregando...",
							    "sProcessing": "Processando...",
							    "sZeroRecords": "Nenhum registro encontrado",
							    "sSearch": "Pesquisar",
							    "oPaginate": {
							        "sNext": "Próximo",
							        "sPrevious": "Anterior",
							        "sFirst": "Primeiro",
							        "sLast": "Último"
							    },
							    "oAria": {
							        "sSortAscending": ": Ordenar colunas de forma ascendente",
							        "sSortDescending": ": Ordenar colunas de forma descendente"
							    }
							},
							responsive: true
						});
					}else{
						var html = "<table class='table'>";
						html += "<thead class='small-text'><tr><th>#</th><th>Título</th><th>Status</th><th>Categoria</th><th>Subcategoria</th><th>Enviada em</th><th>Ações</th></tr></thead><tbody>";
						$.each(retorno.results, function(i, value){
							var status = "";
							if(value.status == 0){
								status = "Pendente";
							}else if(value.status == 1){
								status = "Proposta aceita";
							}else{
								status = "Proposta recusada";
							}
							html += "<tr><td>"+(i+1)+"</td><td>"+value.titulo+"</td><td>"+status+"</td><td>"+value.categoria+"</td><td>"+value.subcategoria+"</td><td>"+value.created_at+"</td><td><a href='javascript:void(0);' id='"+value.id+"'>Ver detalhes</a></td></tr>";
						});
						html += "</tbody></table>";
						$(".historico").html(html);
						$(".historico table").dataTable({
							language: {
							    "sEmptyTable": "Nenhum registro encontrado",
							    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
							    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
							    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
							    "sInfoPostFix": "",
							    "sInfoThousands": ".",
							    "sLengthMenu": "_MENU_ resultados por página",
							    "sLoadingRecords": "Carregando...",
							    "sProcessing": "Processando...",
							    "sZeroRecords": "Nenhum registro encontrado",
							    "sSearch": "Pesquisar",
							    "oPaginate": {
							        "sNext": "Próximo",
							        "sPrevious": "Anterior",
							        "sFirst": "Primeiro",
							        "sLast": "Último"
							    },
							    "oAria": {
							        "sSortAscending": ": Ordenar colunas de forma ascendente",
							        "sSortDescending": ": Ordenar colunas de forma descendente"
							    }
							},
							responsive: true
						});
					}
				}
			}, error: function(e){
				console.log(e);
			}
		})
	});
</script>