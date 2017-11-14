<div class="menu-side">
	<div class="menu-list">
		<div class="logo">Papum Transportes</div>
		<div class="img-profile">
			<img src="http://alt.rampages.us/wp-content/uploads/2017/08/default-profile-pic.jpg"/>
		</div>
		<div class="menu">
			<ul>
				<li class="active"><a href="" class='page' id='profile'><i class="fa fa-user"></i> Meu Perfil</a></li>
				<li><a href="" class='page' id='anuncios'><i class="fa fa-sign-out"></i> Meus Anúncios</a></li>
				<li><a href="" class='page' id='historico'><i class="fa fa-list"></i> Histórico</a></li>
			</ul>
		</div>
	</div>
	<div class="menu-options">
		<ul>
			<li><a href="" class='page' id='anuncio'>Fazer um anúncio</a></li>
			<li><a href="" class='page' id='pesquisa'>Pesquisar uma transportadora</a></li>
			<li><a href="" class='page' id='lances'>Lances</a></li>
		</ul>
	</div>
</div>
<div class="perfil">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="profile">
						<div class="img-profile">
							<img src="http://alt.rampages.us/wp-content/uploads/2017/08/default-profile-pic.jpg"/>
						</div>
						<div class="details-profile">
							<h3><?= $logado->firstname." ".$logado->lastname; ?></h3>
							<p>CPF: <?= $logado->cpf; ?></p>
							<p>RG: <?= $logado->rg; ?></p>
							<p>Data de Nascimento: <?= date("d/m/Y", strtotime($logado->datanasc)); ?></p>
							<p>Telefone: <?= $logado->telefone; ?></p>
							<p>Celular: <?= $logado->celular; ?></p>
							<p>Email: <?= $logado->email; ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<center><h3>Nenhum Anúncio em Andamento</h3></center>
				</div>
			</div>
		</div>
	</div>
</div>