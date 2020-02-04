<?php
	require_once('../crud.php');
	//Inserir cliente
	if(isset($_POST['nome_cliente']) &&
	   isset($_POST['nome_empresa']) &&
	   isset($_POST['email_cliente']) &&
	   isset($_POST['contato_empresa']) &&
	   isset($_POST['mensagem_empresa'])){
		$dados = $_POST;
		$consulta = Crud::insert_cliente($dados);
		print $consulta;
	}

	//Buscando o cliente pelo ID
	if(isset($_POST['id_cliente'])){
		$id_cliente = $_POST['id_cliente'];
		$consulta = Crud::getUsuarioSelecionado($id_cliente);

		print json_encode($consulta);
	}

	//Atualizar dados do cliente
	if(isset($_POST['nome_editar']) 	 &&
	   isset($_POST['empresa_editar']) 	 &&
	   isset($_POST['email_editar'])    &&
	   isset($_POST['contato_editar'])  &&
	   isset($_POST['mensagem_editar']) &&
	   isset($_POST['id_cliente_editar'])
	){
		$dados = $_POST;
		$consulta = Crud::atualizarCliente($dados);
		print $consulta;
	}

	if(isset($_POST['id_excluir'])){
		
		$consulta = Crud::deletarCliente($_POST['id_excluir']);
		print $consulta;
	}

?>