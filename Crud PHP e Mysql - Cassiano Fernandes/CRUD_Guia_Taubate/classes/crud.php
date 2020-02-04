<?php
	require_once('constantes/conexao_singleton.php');

	class Crud{
		private static $conexao;
		public static function getAll(){
			$query = "SELECT * FROM cadastro_cliente ORDER BY id";

			try {
				self::$conexao = Conexao::getConexao();
				$result = self::$conexao->query($query);
				unset($conexao);				
				return $result;
				
			} catch (Exception $e) {				
				print $e->getMessage();
			}
			
			unset($conexao);				
		}

		public static function insert_cliente($request){
			$query = "INSERT INTO cadastro_cliente(nome_cliente,email_cliente,nome_empresa_cliente,contato_cliente,mensagem_cliente) VALUES(:nome, :email, :empresa, :contato, :mensagem)";
			try {
				self::$conexao = Conexao::getConexao();
				$result = self::$conexao->prepare($query);
				$result->execute([':nome' => $request['nome_cliente'],
								  ':email' => $request['email_cliente'],
								  ':empresa' => $request['nome_empresa'],
								  ':contato' => $request['contato_empresa'],
								  ':mensagem' => $request['mensagem_empresa']]);
				if($result){
					print 1;
				}else{
					print 'Cliente não cadastrado';
				}
			} catch (Exception $e) {
				print $e->getMessage();
			}
			unset($conexao);				
		}

		public static function getUsuarioSelecionado($id){
			$query = "SELECT * FROM cadastro_cliente WHERE id = '{$id}'";
			try {
				self::$conexao = Conexao::getConexao();
				$result = self::$conexao->query($query);

				if($result->rowCount() > 0){
					$row = $result->fetch(PDO::FETCH_ASSOC);
					unset($conexao);				
					return $row;
				}else{
					unset($conexao);				
					return json_encode(['Usuário não encontrado']);
				}
			} catch (Exception $e) {
				print $e->getMessage();				
			}
			unset($conexao);				
		}

		public static function atualizarCliente($request){
			$id_atualizar = $request['id_cliente_editar'];
			$query = "UPDATE cadastro_cliente SET nome_cliente = :nome_atualizar, email_cliente = :email_atualizar, nome_empresa_cliente = :empresa_atualizar, contato_cliente = :contato_atualizar, mensagem_cliente = :mensagem_atualizar WHERE id = '{$id_atualizar}' LIMIT 1";
			try {
				self::$conexao = Conexao::getConexao();
				$result = self::$conexao->prepare($query);
				$result->execute([':nome_atualizar' => $request['nome_editar'],
								  ':email_atualizar' => $request['email_editar'],
								  ':empresa_atualizar' => $request['empresa_editar'],
								  ':contato_atualizar' => $request['contato_editar'],
								  ':mensagem_atualizar' => $request['mensagem_editar'],
								]);

				if($result){
					print 1;
				}else{
					print 'Usuário não atualizado';
				}
			} catch (Exception $e) {
				print $e->getMessage();
			}
			unset($conexao);				
		}

		public static function deletarCliente($id){

			$query = "DELETE FROM cadastro_cliente WHERE id = '{$id}' LIMIT 1";

			try {
				self::$conexao = Conexao::getConexao();
				$result = self::$conexao->query($query);
				if($result){
					print 1;
				}else{
					print 'Cliente não deletado';
				}
			} catch (Exception $e) {
				print $e->getMessage();
			}
			unset($conexao);				
		}
	}

?>