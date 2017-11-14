<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<form id="msform">
				<!-- progressbar -->
				<ul id="progressbar">
					<li class="active">Categoria</li>
					<li>Subcategoria</li>
					<li>Detalhes do Anúncio</li>
				</ul>
				<!-- fieldsets -->
				<fieldset>
					<h2 class="fs-title">Escolha uma categoria</h2>
					<div class='categorias'>
						<div class="spinner">
						  <div class="bounce1"></div>
						  <div class="bounce2"></div>
						  <div class="bounce3"></div>
						</div>
					</div>
					<input type="button" name="next" class="next action-button" value="Próximo" />
				</fieldset>
				<fieldset>
					<h2 class="fs-title">Escolha uma subcategoria</h2>
					<div class='subcategorias'></div>
					<input type="button" name="previous" class="previous action-button" value="Anterior" />
					<input type="button" name="next" class="next action-button" value="Próximo" />
				</fieldset>
				<fieldset>
					<h2 class="fs-title">Informe os detalhes do anúncio</h2>
					<div class='items'>
						<div class='item' id='3'>
							<div class="row">
								<div class='col-md-12'>
									<h3>Item 1</h3>
								</div>
								<div class="col-md-12">
									<label>Nome do Item</label>
									<input type="text" id="nome_1" class="form-control input-md" style="width:100%" required="required">
								</div>
								<div class="col-md-3">
									<label>Comp</label>
									<input type="text" id="comp_1" class="form-control input-md" style="width:100%" required="required">
								</div>
								<div class="col-md-3">
									<label>Largura</label>
									<input type="text" id="largura_1" class="form-control input-md" style="width:100%" required="required">
								</div>
								<div class="col-md-3">
									<label>Altura</label>
									<input type="text" id="altura_1" class="form-control input-md" style="width:100%" required="required">
								</div>
								<div class="col-md-3">
									<div class="form-group">
									  	<label for="sel1">Medida</label>
									  	<select class="form-control" id="sel1_1" required="required">
											<option>M</option>
									  		<option>CM</option>
									  	</select>
									</div> 
								</div>
								<div class="col-md-6">
									<label>Peso</label>
									<input type="text" id="peso_1" class="form-control input-md" required="required">
								</div>
								<div class="col-md-6">
									<label>Quantidade</label>
									<input type="text" id="quantidade_1" class="form-control input-md" required="required">
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-default adicionar-item action-button" style="width:100%">
						<span class="glyphicon glyphicon-plus"></span> Adicionar mais um item
					</button>
					<br>
					<textarea name="address" placeholder="Address"></textarea>
					<input type="button" name="previous" class="previous action-button" value="Anterior" />
					<input type="submit" name="submit" class="submit action-button" value="Anunciar" />
				</fieldset>
			</form>
		</div>
	</div>
</div>
<br>