<?php
	require_once "../config.php";
	if(isset($_SESSION['id_user'])){
		include_once "../classes/BD.class.php";
		$dataquery = @BD::conn()->prepare("SELECT * FROM configuracao_frete WHERE id_user = ?");
		$dataquery->execute([$_SESSION['id_user']]);
		$frete = $dataquery->fetchObject();

		$frete_condicoes = array();
		$dataquery = @BD::conn()->prepare("SELECT * FROM configuracao_frete_condicoes WHERE id_configuracao = ?");
		$dataquery->execute([$frete->id]);
		while($condicoes = $dataquery->fetchObject()){
			$frete_condicoes[] = $condicoes;
		}
	}
?>
<div class="container">
	<div class="row">
		<div class="card">
			<form action="" id="frete" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-12">
						<h4>Configuração de Frete</h4>
					</div>
					<div class="col-md-12">
						<table class="striped">
							<thead>
								<tr>
									<th>Taxas</th>
									<th>Frete peso líquido</th>
									<th>Ad Valorem</th>
									<th>Freto peso mínimo</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Até 10km</td>
									<td>
										<input type="text" class='frete_peso_liquido form-control input-md' placeholder="R$" id='10' value='<?= $frete_condicoes[0]->frete_peso_liquido; ?>'/>
									</td>
									<td>
										<input type="text" class='frete_ad_valorem form-control input-md' placeholder='%' id='10' value='<?= $frete_condicoes[0]->frete_ad_valorem; ?>'>
									</td>
									<td>
										<input type="text" class='frete_peso_minimo form-control input-md' placeholder='R$' id='10' value='<?= $frete_condicoes[0]->frete_peso_minimo; ?>'>
									</td>
								</tr>
								<tr>
									<td>Até 20km</td>
									<td>
										<input type="text" class='frete_peso_liquido form-control input-md' placeholder="R$" id='20' value='<?= $frete_condicoes[1]->frete_peso_liquido; ?>'>
									</td>
									<td>
										<input type="text" class='frete_ad_valorem form-control input-md' placeholder='%' id='20' value='<?= $frete_condicoes[1]->frete_ad_valorem; ?>'>
									</td>
									<td>
										<input type="text" class='frete_peso_minimo form-control input-md' placeholder='R$' id='20' value='<?= $frete_condicoes[1]->frete_peso_minimo; ?>'>
									</td>
								</tr>
								<tr>
									<td>Até 30km</td>
									<td>
										<input type="text" class='frete_peso_liquido form-control input-md' placeholder="R$" id='30' value='<?= $frete_condicoes[2]->frete_peso_liquido; ?>'>
									</td>
									<td>
										<input type="text" class='frete_ad_valorem form-control input-md' placeholder='%' id='30' value='<?= $frete_condicoes[2]->frete_ad_valorem; ?>'>
									</td>
									<td>
										<input type="text" class='frete_peso_minimo form-control input-md' placeholder='R$' id='30' value='<?= $frete_condicoes[2]->frete_peso_minimo; ?>'>
									</td>
								</tr>
								<tr>
									<td>Até 50km</td>
									<td>
										<input type="text" class='frete_peso_liquido form-control input-md' placeholder="R$" id='50' value='<?= $frete_condicoes[3]->frete_peso_liquido; ?>'>
									</td>
									<td>
										<input type="text" class='frete_ad_valorem form-control input-md' placeholder='%' id='50' value='<?= $frete_condicoes[3]->frete_ad_valorem; ?>'>
									</td>
									<td>
										<input type="text" class='frete_peso_minimo form-control input-md' placeholder='R$' id='50' value='<?= $frete_condicoes[3]->frete_peso_minimo; ?>'>
									</td>
								</tr>
								<tr>
									<td>Até 100km</td>
									<td>
										<input type="text" class='frete_peso_liquido form-control input-md' placeholder="R$" id='100' value='<?= $frete_condicoes[4]->frete_peso_liquido; ?>'>
									</td>
									<td>
										<input type="text" class='frete_ad_valorem form-control input-md' placeholder='%' id='100' value='<?= $frete_condicoes[4]->frete_ad_valorem; ?>'>
									</td>
									<td>
										<input type="text" class='frete_peso_minimo form-control input-md' placeholder='R$' id='100' value='<?= $frete_condicoes[4]->frete_peso_minimo; ?>'>
									</td>
								</tr>
								<tr>
									<td>Até 100km</td>
									<td>
										<input type="text" class='frete_peso_liquido form-control input-md' placeholder="R$" id='999' value='<?= $frete_condicoes[5]->frete_peso_liquido; ?>'>
									</td>
									<td>
										<input type="text" class='frete_ad_valorem form-control input-md' placeholder='%' id='999' value='<?= $frete_condicoes[5]->frete_ad_valorem; ?>'>
									</td>
									<td>
										<input type="text" class='frete_peso_minimo form-control input-md' placeholder='R$' id='999' value='<?= $frete_condicoes[5]->frete_peso_minimo; ?>'>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<hr>
					</div>
					<div class="col-md-4">
						<label>Gris</label>
						<input type="text" name="gris" class="form-control input-md" placeholder="%" id="gris" value="<?= $frete->gris; ?>">
					</div>
					<div class="col-md-4">
						<label>Despacho</label>
						<input type="text" name="despacho" class="form-control input-md" placeholder="%" id="despacho" value="<?= $frete->despacho; ?>">
					</div>
					<div class="col-md-4">
						<label>TAS</label>
						<input type="text" name="tas" class="form-control input-md" placeholder="%" id="tas" value="<?= $frete->tas; ?>">
					</div>
					<div class="col-md-12">
						<hr>
					</div>
					<div class="col-md-12" id="feedback"></div>
					<div class="col-md-12">
						<input type="submit" class="submit" value="Salvar">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

