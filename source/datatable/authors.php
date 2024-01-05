<?php
	session_start();
	extract($_POST);
	require_once(dirname(__DIR__) . "/autoload.php");
	
	use \Source\Classes\Author;

	$msg = '';

	if($action== 'getall')
	{
		$json = ['data' => Author::getall()];
		
		echo json_encode($json);
	}
	elseif($action == 'get')
	{
		$author = Author::read($id);
		
		$json = ['id' => $author->getId(), 'name' => $author->getName()];
		
		echo json_encode($json);
	}
	elseif($action == 'create')
	{
		$author = new Author($name);
		
		if(Author::create($author)){
			$msg = 'Autor cadastrado com sucesso!';
		}
		else {
			$msg = 'Erro ao cadastrar!';
		}

		$json = ['msg' => $msg];

		echo json_encode($json);
	}
	elseif($action == 'update')
	{
		$author = Author::read($id);
		$author->setName($name);
		
		if(Author::update($author)){
			$msg = 'Autor atualizado com sucesso!';
		}
		else {
			$msg = 'Erro ao atualizar!';
		}

		$json = ['msg' => $msg];

		echo json_encode($json);
	}
	elseif($action == 'delete')
	{
		if(Author::delete($id)){
			echo json_encode(['msg' => 'Autor excluído com sucesso']);
		}
	}