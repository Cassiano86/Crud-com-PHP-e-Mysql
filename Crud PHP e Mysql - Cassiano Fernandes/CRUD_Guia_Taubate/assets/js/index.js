$(function(){
	$('.alert').hide();
	$('.alert_atualizar').hide();
	$('#logo_cadastro').hide().fadeIn(1400);

	$('#form_insert').on('submit',function(e){
		let flag = 0;
		let dados = $(this).serialize();
		e.preventDefault();

		$('#form_insert input , #form_insert textarea').each(function(){
			if($(this).val() == '' || $(this).val() == null){
				flag = 1;
			}
		});

		if(flag == 0){
			$.ajax({
				url : 'classes/models/modelCrud.php',
				method : 'post',
				data : dados,
				dataType : 'html',
				timeout : 10000,
				success : function(retorno){
					if(retorno == 1){
						mostrarAlerta('alerta_insert',"Cliente cadastrado com sucesso<br>Recarregando..........",'alert-success','alert-danger',1);
					}else{
						mostrarAlerta('alerta_insert',retorno,'alert-danger','alert-success',0);
					}
				},
				error : function(){
					mostrarAlerta('alerta_insert','Dados não enviados','alert-danger','alert-success',0);		
				}
			});
		}else{
			mostrarAlerta('alerta_insert','Por favor, preencha todos os campos','alert-danger','alert-success',0);
		}
	});

	$('.btn_atualizar_cliente').on('click',function(){
		let id = $(this).val();
			$('#modal_editar_cliente').modal('show');
		$.ajax({
			url : 'classes/models/modelCrud.php',
			method : 'post',
			data : {id_cliente : id},
			dataType : 'json',
			timeout : 10000, 
			success : function(retorno){
				$('#id_cliente_editar').val(retorno.id);
				$('#nome_editar').val(retorno.nome_cliente);
				$('#email_editar').val(retorno.email_cliente);
				$('#empresa_editar').val(retorno.nome_empresa_cliente);
				$('#contato_editar').val(retorno.contato_cliente);
				$('#mensagem_editar').val(retorno.mensagem_cliente);
				$('#modal_editar_cliente').modal('show');
			},
			error : function(){
				mostrarAlerta('alerta_atualizar_cliente','Dados não enviados','alert-danger','alert-success',0);
			}
		})
	});

	$('form#atualizar_cliente').on('submit',function(e){
		e.preventDefault();
		let flag = 0;
		let dados = $(this).serialize();

		$('form#atualizar_cliente input, form#atualizar_cliente textarea').each(function(){
			if($(this).val() == '' || $(this).val() == null){
				flag = 1;				
			}
		});

		if(flag == 0){
			$.ajax({
				url : 'classes/models/modelCrud.php',
				method : 'post',
				data : dados,
				dataType : 'html',
				timeout : 10000,
				success : function(retorno){
					if(retorno == 1){
						mostrarAlerta('alerta_atualizar_cliente',"Cliente atualizado com sucesso<br>Recarregando..........",'alert-success','alert-danger',1);
					}else{
						mostrarAlerta('alerta_atualizar_cliente',retorno,'alert-danger','alert-success',0);
					}
				},
				error : function(){
					mostrarAlerta('alerta_atualizar_cliente','Dados não enviados','alert-danger','alert-success',0);		
				}
			});
		}else{
			mostrarAlerta('alerta_atualizar_cliente','Por favor, preencha todos os campos','alert-danger','alert-success',0);
		}
	});

	$('.btn_excluir_cliente').on('click',function(){
		$('#id_excluir').val($(this).prop('value'));
	});

	$('#form_excluir').on('submit',function(e){
		
		e.preventDefault();
		$.ajax({
			url : 'classes/models/modelCrud.php',
			method : 'post',
			dataType : 'html',
			data : {id_excluir : $('form#form_excluir #id_excluir').val()},			
			success : function(retorno){				
				if(retorno == 1){
					mostrarAlerta('alerta_deletar_cliente',"Cliente deletado com sucesso<br>Recarregando..........",'alert-success','alert-danger',1);
				}else{
					mostrarAlerta('alerta_deletar_cliente',retorno,'alert-danger','alert-success',0);	
				}
			},
			error : function(){
				mostrarAlerta('alerta_deletar_cliente','Dados não enviados','alert-danger','alert-success',0);
			}
		});
	});

	function mostrarAlerta(id_tag, mensagem_retorno, addClasse, removeClasse, situacao){
		if(addClasse == 'alert-success'){
			$('#'+id_tag).hide();
			$('#'+id_tag).removeClass(removeClasse);
			$('#'+id_tag).addClass(addClasse);
			$('#'+id_tag).html(mensagem_retorno);
			$('#'+id_tag).fadeIn(500);
			if(situacao == 1){
				$('a,button,input').prop('disabled',true);
				setTimeout(function(){
					location.reload();
				},3000);
			}			
		}else{
			$('#'+id_tag).hide();
			$('#'+id_tag).removeClass(removeClasse);
			$('#'+id_tag).addClass(addClasse);
			$('#'+id_tag).html(mensagem_retorno);
			$('#'+id_tag).fadeIn(500);
		}
	}
	
});