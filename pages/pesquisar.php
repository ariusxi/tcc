<div class="container-fluid">
	<div class="row">
		<div class="card">
			<form action="" method="post" id="search" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-12">
						<h5>Pesquisa um anúncio</h5>
					</div>
					<div class="col-md-12" id="feedback"></div>
					<div class="col-md-9">
						<input type="text" name="search" class="form-control input-md" id="search" placeholder="Digite a sua pesquisa...">
					</div>
					<div class="col-md-3">
						<input type="submit" class="btn btn-default action-button" value="Pesquisar">
					</div>
				</div>
			</form>
		</div>
		<div class="card results" style='display:none;'>
			<div class="spinner">
			  <div class="bounce1"></div>
			  <div class="bounce2"></div>
			  <div class="bounce3"></div>
			</div>
		</div>
	</div>
</div>