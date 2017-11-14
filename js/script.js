$(function(){

	var url = "http://localhost/tcc/";
	var type = "";
	var current_fs, next_fs, previous_fs;
	var left, opacity, scale;
	var animating;
	var numitems = 1;

	$("#cpf_c").mask("999.999.999-99");
	$("#rg_c").mask("99.999.999-9");
	$("#telefone_c, #telefone_t, #phone").mask("(99)9999-9999");
	$("#celular_c, #celular_t").mask("(99)99999-9999");
	$("#cnpj_t").mask("99.999.999/9999-99");

	$(".m").click(function(e){
		e.preventDefault();
		$(".email").hide();
		if(type != ""){
			$("."+type).hide();
		}
		$(".categoria").hide();
		$(".login").show();
		$("#login").modal("toggle");
		return false;
	});

	$(".select-categoria").click(function(e){
		e.preventDefault();

		$(".login").hide();
		$(".categoria").fadeIn();

		return false;
	});

	$(".back-login").click(function(e){
		e.preventDefault();

		$(".categoria").hide();
		$(".login").fadeIn();

		return false;
	});

	$(".select-tipo").click(function(e){
		e.preventDefault();

		type = $(this).attr('id');

		$(".categoria").hide();
		$("."+type).fadeIn();

		return false;
	});

	$(".back-categoria").click(function(e){
		$(".categoria").fadeIn();
		e.preventDefault();

		$("."+type).hide();

		return false;
	});
	
	$(".page").click(function(e){
		e.preventDefault();

		numitems = 1;

		var page = $(this).attr("id");

		$(".perfil").load(url+'pages/'+page+'.php');

		$.ajax({
			type: 'POST',
			url: url+'sys/Anuncio/categorias',
			dataType: 'json',
			success: function(retorno){
				if(retorno.status == "ok"){
					var html = "<ul class='collection'>";
					$.each(retorno.results, function(i, value){
						html += "<li class='collection-item'>";
						html += '<div class="md-radio md-radio-inline"><input type="radio" name="categoria" id="'+value.id+'" value="'+value.id+'"/><label for="'+value.id+'">'+value.categoria+'</label></div><p>Anúncios nessa categoria: '+value.views+'</p>';
						html += "</li>";
					});
					html += "</ul>";
					$(".categorias").html(html);
				}
			}, error: function(e){
				console.log(e);
			}
		});

		return false;
	});

	$(document).on("click", ".adicionar-item", function(){
		numitems++;
		var add = '<div class="item" id="'+numitems+'"><div class="row"><div class="col-md-12"><h3>Item '+numitems+'</h3></div><div class="col-md-12"><label>Nome do Item</label><input type="text" id="nome_'+numitems+'" class="form-control input-md" style="width:100%"></div><div class="col-md-3"><label>Comp</label><input type="text" id="comp_'+numitems+'" class="form-control input-md" style="width:100%"></div><div class="col-md-3"><label>Largura</label><input type="text" id="largura_'+numitems+'" class="form-control input-md" style="width:100%"></div><div class="col-md-3"><label>Altura</label><input type="text" id="altura_'+numitems+'" class="form-control input-md" style="width:100%"></div><div class="col-md-3"><div class="form-group"><label for="sel1">Medida</label><select class="form-control" id="sel1_'+numitems+'"><option>M</option><option>CM</option></select></div></div><div class="col-md-6"><label>Peso</label><input type="text" id="peso_'+numitems+'" class="form-control input-md"></div><div class="col-md-6"><label>Quantidade</label><input type="text" id="quantidade_'+numitems+'" class="form-control input-md"></div></div></div>';
		$(".items").append(add);
	});

	

	$(document).on("click", ".next", function(){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();

		var categoria = $("input[name=categoria]:checked").val();

		$.ajax({
			type: 'POST',
			url: url+'sys/Anuncio/subcategorias',
			dataType: 'json',
			data: {
				id_categoria: categoria
			}, success: function(retorno){
				if(retorno.status == "ok"){
					var html = "<ul class='collection'>";
					$.each(retorno.results, function(i, value){
						html += "<li class='collection-item'>";
						html += '<div class="md-radio md-radio-inline"><input type="radio" name="subcategoria" id="'+value.id+'" value="'+value.id+'"/><label for="'+value.id+'">'+value.subcategoria+'</label></div><p>Anúncios nessa subcategoria: '+value.views+'</p>';
						html += "</li>";
					});
					html += "</ul>";
					$(".subcategorias").html(html);
				}
			}
		})
		
		//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale current_fs down to 80%
				scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+"%";
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'transform': 'scale('+scale+')'});
				next_fs.css({'left': left, 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});

	$(document).on("click", ".previous", function(){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();
		
		//de-activate current step on progressbar
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
		
		//show the previous fieldset
		previous_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale previous_fs from 80% to 100%
				scale = 0.8 + (1 - now) * 0.2;
				//2. take current_fs to the right(50%) - from 0%
				left = ((1-now) * 50)+"%";
				//3. increase opacity of previous_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'left': left});
				previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});

	$("#login").submit(function(e){
		e.preventDefault();

		var login = $("#login_l").val();
		var senha = $("#password_l").val();

		if(login == "" || senha == ""){
			$("#feedback").html("<div style='color:red;'>Voce deve preencher login e senha</div>");
			hidemessage("#feedback");
			return false;
		}

		$.ajax({
			type: 'POST',
			url: url+'sys/User/login',
			dataType: 'json',
			data: {
				login: login,
				senha: senha
			},
			success: function(retorno){
				console.log(retorno);
				if(retorno == true){
					$(".ml-auto").html('<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">Serviços</a></li><li class="nav-item"><a class="nav-link js-scroll-trigger" href="#categorias">Categorias</a></li><li class="nav-item"><a class="nav-link js-scroll-trigger" href="#sobre">Sobre</a></li><li class="nav-item"> <a class="nav-link js-scroll-trigger" href="profile">Meu Perfil</a></li><li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contato">Contato</a></li>');
					$('#login').modal('toggle');
				}else{
					$("#feedback").html("<div style='color:red;'>Login ou Senha Incorretos</div>");
					hidemessage("#feedback");
				}
			}
		})

		return false;
	});

	$(".btn-cliente").click(function(e){
		e.preventDefault();

		var firstname = $("#firstname_c").val();
		var lastname = $("#lastname_c").val();
		var cpf = $("#cpf_c").val();
		var rg = $("#rg_c").val();
		var datanasc = $("#dtnasci_c").val();
		var sexo = $(".escolha").val();
		var telefone = $("#telefone_c").val();
		var celular = $("#celular_c").val();
		var email = $("#email_c").val();
		var cemail = $("#cemail_c").val();
		var password = $("#password_c").val();
		var confpass = $("#confpass_c").val();

		if(firstname == "" || lastname == "" || cpf == "" || rg == "" || datanasc == "" || sexo == "" || telefone == "" || celular == "" || email == "" || cemail == "" || password == "" || confpass == ""){
			$("#feedback_c").html("<div style='color:red;'>Voce deve preencher todos os campos</div>");
			hidemessage("#feedback_c");
			return false;
		}

		if(email != cemail){
			$("#feedback_c").html("<div style='color:red;'>Os emails informados não estão conferindo</div>");
			hidemessage("#feedback_c");
			return false;
		}

		if(password != confpass){
			$("#feedback_c").html("<div style='color:red;'>As senhas informadas não estão conferindo</div>");
			hidemessage("#feedback_c");
			return false
		}

		if(password.length < 8){
			$("#feedback_c").html("<div style='color:red;'>Sua senha deve ter no mínimo 8 dígitos</div>");
			hidemessage("#feedback_c");
			return false
		}

		$.ajax({
			type: 'POST',
			url: url+'sys/User/cliente',
			dataType: 'json',
			data: {
				firstname: firstname,
				lastname: lastname,
				cpf: cpf,
				rg: rg,
				datanasc: datanasc,
				sexo: sexo,
				telefone: telefone,
				celular: celular,
				email: email,
				password: password,
				level: 0
			}, success: function(retorno){
				console.log(retorno);
				if(retorno == true){
					$(".send").text(email);
					$("."+type).hide();
					$(".email").fadeIn();
				}else if(retorno == "existe"){
					$("#feedback_c").html("<div style='color:red;'>Já existe uma conta com esses dados</div>");
					hidemessage("#feedback_c");
				}else{
					$("#feedback_c").html("<div style='color:red;'>Ocorreu um erro, tente novamente mais tarde</div>");
					hidemessage("#feedback_c");
				}
			}, error: function(e){
				console.log(e);
			}
		})

		return false;
	});

	$(".btn-transportadora").click(function(e){
		e.preventDefault();

		var firstname = $("#firstname_t").val();
		var lastname = $("#lastname_t").val();
		var cnpj = $("#cnpj_t").val();
		var telefone = $("#telefone_t").val();
		var celular = $("#celular_t").val();
		var email = $("#email_t").val();
		var cemail = $("#cemail_t").val();
		var password = $("#password_t").val();
		var confpass = $("#confpass_t").val();

		if(firstname == "" || lastname == "" || cnpj == "" || telefone == "" || telefone == "" || email == "" || cemail == "" || password == "" || confpass == ""){
			$("#feedback_t").html("<div style='color:red;'>Voce deve preencher todos os campos</div>");
			hidemessage("#feedback_t");
			return false;
		}

		if(email != cemail){
			$("#feedback_t").html("<div style='color:red;'>Os emails informados não estão conferindo</div>");
			hidemessage("#feedback_t");
			return false;
		}

		if(password != confpass){
			$("#feedback_t").html("<div style='color:red;'>As senhas informadas não estão conferindo</div>");
			hidemessage("#feedback_t");
			return false
		}

		$.ajax({
			type: 'POST',
			url: url+'sys/User/transportadora',
			dataType: 'json',
			data: {
				firstname: firstname,
				lastname: lastname,
				cnpj: cnpj,
				telefone: telefone,
				celular: celular,
				email: email,
				password: password,
				level: 1
			}, success: function(retorno){
				console.log(retorno);
				if(retorno == true){
					$(".send").text(email);
					$("."+type).hide();
					$(".email").fadeIn();
				}else if(retorno == "existe"){
					$("#feedback_c").html("<div style='color:red;'>Já existe uma conta com esses dados</div>");
					hidemessage("#feedback_c");
				}else{
					$("#feedback_c").html("<div style='color:red;'>Ocorreu um erro, tente novamente mais tarde</div>");
					hidemessage("#feedback_c");
				}
			}, error: function(e){
				console.log(e);
			}
		})

		return false;
	});

});