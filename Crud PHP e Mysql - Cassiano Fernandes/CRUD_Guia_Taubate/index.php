<?php
    require_once('classes/constantes/conexao_singleton.php');
    require_once('classes/crud.php');
    $registros = Crud::getAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>Guia Taubaté - Cadastro de clientes</title>
	<meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/css/estilo.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">    
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body class='bg-light'>
	<div class="container">
        <?php 
            require_once('parts/parts_index/form_insert.html'); 

            if($registros->rowCount() > 0){
                $itens = '';
                foreach($registros as $registro){
                    $item = file_get_contents('parts/parts_index/dados_table_update.html');
                    $item = str_replace('{nome_cliente}', $registro['nome_cliente'], $item);
                    $item = str_replace('{email_cliente}', $registro['email_cliente'], $item);
                    $item = str_replace('{id_cliente}', $registro['id'], $item);
                    $item = str_replace('{id_cliente}', $registro['id'], $item);
                    $itens .= $item;
                }

                $carregar_tabela = file_get_contents('parts/parts_index/table_update.html');
                $carregar_tabela = str_replace('{cadastros}',$itens, $carregar_tabela);
                print $carregar_tabela;
            }else{ ?>
                <h2 class='text-secondary font-weight-bold text-center my-5'>Nenhum cliente registrado até o momento</h2>;
        <?php } 
            require_once('parts/parts_index/modal_atualizar_usuario.html');             
            require_once('parts/parts_index/modal_deletar_usuario.html');             
        ?>
    </div>    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script type="text/javascript" src='assets/js/index.js'></script>
</body>
</html>