<?php
	session_start();
	extract($_POST);
	require_once(dirname(__DIR__) . "/autoload.php");
	
	use \Source\Classes\Book;

	$msg = '';

	if($action== 'getall')
	{
		$json = ['data' => Book::getall()];
		
		echo json_encode($json);
	}
	elseif($action == 'get')
	{
		$book = Book::read($id);
		
		$json = [
			'id' => $book->getId(), 
			'title' => $book->getTitle(), 
			'publisher' => $book->getPublisher(), 
			'edition' => $book->getEdition(), 
			'year' => $book->getYear(),
			'price' => $book->getPrice()
		];
		
		echo json_encode($json);
	}
	elseif($action == 'create')
	{
		$book = new Book($title, $publisher, $edition, $year, $price);
		
		if(Book::create($book)){
			$msg = 'Livro cadastrado com sucesso!';
		}
		else {
			$msg = 'Erro ao cadastrar!';
		}

		$json = ['msg' => $msg];

		echo json_encode($json);
	}
	elseif($action == 'update')
	{
		$book = Book::read($id);
		$book->setTitle($title);
		$book->setPublisher($publisher);
		$book->setEdition($edition);
		$book->setYear($year);
		$book->setPrice($price);
		
		if(Book::update($book)){
			$msg = 'Livro atualizado com sucesso!';
		}
		else {
			$msg = 'Erro ao atualizar!';
		}

		$json = ['msg' => $msg];

		echo json_encode($json);
	}
	elseif($action == 'delete')
	{
		if(Book::delete($id)){
			echo json_encode(['msg' => 'Livro excluído com sucesso']);
		}
	}