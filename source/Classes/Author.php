<?php

namespace Source\Classes;

use \Source\Core\Connect;
class Author
{
    private $id;
    private $name;

    /**
     * Author constructor.
     * @param $name
     */
    public function __construct($name = '')
    {
        $this->id = 0;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public static function create(Author $author)
    {
        try {
            $stmt = Connect::getInstance()->prepare("INSERT INTO author (name) VALUES (?)");
            $stmt->execute([$author->getName()]);

            return Connect::getInstance()->lastInsertId();
        } catch (\PDOException $exception) {
            return 'Erro ao cadastrar o autor.'.$exception->getMessage();
        }
    }

    public static function read(int $id)
    {
        try {
            $stmt = Connect::getInstance()->prepare("SELECT id, name FROM author WHERE id = ?");
            $stmt->execute([$id]);

            $author = new Author();
            foreach($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row)
		    {
                $author->setId($row['id']);
                $author->setName($row["name"]);

                return $author;
            }

        } catch (\PDOException $exception) {
            return 'Erro ao carregar o autor.'.$exception->getMessage();
        }
    }

    public static function update(Author $author)
    {
        try {
            $stmt = Connect::getInstance()->prepare("UPDATE author SET name = ? WHERE id = ?");
            $stmt->execute([$author->getName(), $author->getId()]);

            return true;
        } catch (\PDOException $exception) {
            return 'Erro ao atualizar.'.$exception->getMessage();
        }
    }

    public static function delete(int $id)
    {
        try {
            $stmt = Connect::getInstance()->prepare("DELETE FROM author WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            return 'Erro ao excluir.'.$exception->getMessage();
        }
    }

    protected static function all()
    {
        try {
            $stmt = Connect::getInstance()->prepare("SELECT id, name FROM author");
            $stmt->execute();

            $authors = [];
            foreach($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row)
		    {
                $author = new Author();
                $author->setId($row['id']);
                $author->setName($row["name"]);

                $authors[] = $author;
            }

            return $authors;

        } catch (\PDOException $exception) {
            return 'Erro ao trazer os autores.'.$exception->getMessage();
        }
    }

    public static function getall()
    {
        try {
            $authors = self::all();
            $datatable = [];
            foreach($authors as $author)
		    {
                $datatable[] = [
                    'ID' => $author->getId(),
                    'NOME' => $author->getName(),
                    'UPDATE' => '<a href="javascript: void(0)" onclick="Get('.$author->getId().')">Alterar</a>',
                    'DELETE' => '<a href="javascript: void(0)" onclick="Delete('.$author->getId().')">Excluir</a>'
                ];
            }

            return $datatable;

        } catch (\Exception $exception) {
            return 'Erro ao trazer os autores.'.$exception->getMessage();
        }
    }

}