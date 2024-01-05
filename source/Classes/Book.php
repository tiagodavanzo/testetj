<?php

namespace Source\Classes;

use \Source\Core\Connect;
class Book
{
    private $id;
    private $title;
    private $publisher;
    private $edition;
    private $year;
    private $price;

    /**
     * Book constructor.
     * @param $name
     */
    public function __construct($title = '', $publisher = '', $edition = '', $year = '', $price = '')
    {
        $this->id = 0;
        $this->title = $title;
        $this->publisher = $publisher;
        $this->edition = $edition;
        $this->year = $year;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPublisher()
    {
        return $this->publisher;
    }

    public function getEdition()
    {
        return $this->edition;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setPublisher($publisher): void
    {
        $this->publisher = $publisher;
    }

    public function setEdition($edition): void
    {
        $this->edition = $edition;
    }

    public function setYear($year): void
    {
        $this->year = $year;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public static function create(Book $book)
    {
        try {
            $stmt = Connect::getInstance()->prepare("INSERT INTO book (title, publisher, edition, year, price) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$book->getTitle(), $book->getPublisher(), $book->getEdition(), $book->getYear(), $book->getPrice()]);

            return Connect::getInstance()->lastInsertId();
        } catch (\PDOException $exception) {
            return 'Erro ao cadastrar o livro.'.$exception->getMessage();
        }
    }

    public static function read(int $id)
    {
        try {
            $stmt = Connect::getInstance()->prepare("SELECT id, title, publisher, edition, year, price FROM book WHERE id = ?");
            $stmt->execute([$id]);

            $book = new Book();
            foreach($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row)
		    {
                $book->setId($row['id']);
                $book->setTitle($row["title"]);
                $book->setPublisher($row["publisher"]);
                $book->setEdition($row["edition"]);
                $book->setYear($row["year"]);
                $book->setPrice($row["price"]);

                return $book;
            }

        } catch (\PDOException $exception) {
            return 'Erro ao carregar o livro.'.$exception->getMessage();
        }
    }

    public static function update(Book $book)
    {
        try {
            $stmt = Connect::getInstance()->prepare("UPDATE book SET title = ?, publisher = ?, edition = ?, year = ?, price = ? WHERE id = ?");
            $stmt->execute([$book->getTitle(), $book->getPublisher(), $book->getEdition(), $book->getYear(), $book->getPrice(), $book->getId()]);

            return true;
        } catch (\PDOException $exception) {
            return 'Erro ao atualizar o livro.'.$exception->getMessage();
        }
    }

    public static function delete(int $id)
    {
        try {
            $stmt = Connect::getInstance()->prepare("DELETE FROM book WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            return 'Erro ao excluir o livro.'.$exception->getMessage();
        }
    }

    protected static function all()
    {
        try {
            $stmt = Connect::getInstance()->prepare("SELECT id, title, publisher, edition, year, price FROM book");
            $stmt->execute();

            $books = [];
            foreach($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row)
		    {
                $book = new Book();
                $book->setId($row['id']);
                $book->setTitle($row["title"]);
                $book->setPublisher($row["publisher"]);
                $book->setEdition($row["edition"]);
                $book->setYear($row["year"]);
                $book->setPrice($row["price"]);

                $books[] = $book;
            }

            return $books;

        } catch (\PDOException $exception) {
            return 'Erro ao trazer os livros.'.$exception->getMessage();
        }
    }

    public static function getall()
    {
        try {
            $books = self::all();
            $datatable = [];
            foreach($books as $book)
		    {
                $datatable[] = [
                    'ID' => $book->getId(),
                    'TITLE' => $book->getTitle(),
                    'PUBLISHER' => $book->getPublisher(),
                    'EDITION' => $book->getEdition(),
                    'YEAR' => $book->getYear(),
                    'PRICE' => $book->getPrice(),
                    'UPDATE' => '<a href="javascript: void(0)" onclick="Get('.$book->getId().')">Alterar</a>',
                    'DELETE' => '<a href="javascript: void(0)" onclick="Delete('.$book->getId().')">Excluir</a>'
                ];
            }

            return $datatable;

        } catch (\Exception $exception) {
            return 'Erro ao trazer os livros.'.$exception->getMessage();
        }
    }

}