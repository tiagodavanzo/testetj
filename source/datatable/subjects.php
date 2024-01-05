<?php
	session_start();
	extract($_POST);
	require_once(dirname(__DIR__) . "/autoload.php");
	
	use \Source\Classes\Subject;

	$msg = '';

	if($action== 'getall')
	{
		$json = ['data' => Subject::getall()];
		
		echo json_encode($json);
	}
	elseif($action == 'get')
	{
		$subject = Subject::read($id);
		
		$json = ['id' => $subject->getId(), 'name' => $subject->getName()];
		
		echo json_encode($json);
	}
	elseif($action == 'create')
	{
		$subject = new Subject($name);
		
		if(Subject::create($subject)){
			$msg = 'Assunto cadastrado com sucesso!';
		}
		else {
			$msg = 'Erro ao cadastrar!';
		}

		$json = ['msg' => $msg];

		echo json_encode($json);
	}
	elseif($action == 'update')
	{
		$subject = Subject::read($id);
		$subject->setName($name);
		
		if(Subject::update($subject)){
			$msg = 'Assunto atualizado com sucesso!';
		}
		else {
			$msg = 'Erro ao atualizar!';
		}

		$json = ['msg' => $msg];

		echo json_encode($json);
	}
	elseif($action == 'delete')
	{
		if(Subject::delete($id)){
			echo json_encode(['msg' => 'Assunto excluído com sucesso']);
		}
	}