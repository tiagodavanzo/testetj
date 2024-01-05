<?php

namespace Source\Classes;

use \Source\Core\Connect;
class Subject
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

    public static function create(Subject $subject)
    {
        try {
            $stmt = Connect::getInstance()->prepare("INSERT INTO subject (name) VALUES (?)");
            $stmt->execute([$subject->getName()]);

            return Connect::getInstance()->lastInsertId();
        } catch (\PDOException $exception) {
            return 'Erro ao cadastrar o assunto.'.$exception->getMessage();
        }
    }

    public static function read(int $id)
    {
        try {
            $stmt = Connect::getInstance()->prepare("SELECT id, name FROM subject WHERE id = ?");
            $stmt->execute([$id]);

            $subject = new Subject();
            foreach($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row)
		    {
                $subject->setId($row['id']);
                $subject->setName($row["name"]);

                return $subject;
            }

        } catch (\PDOException $exception) {
            return 'Erro ao carregar o assunto.'.$exception->getMessage();
        }
    }

    public static function update(Subject $subject)
    {
        try {
            $stmt = Connect::getInstance()->prepare("UPDATE subject SET name = ? WHERE id = ?");
            $stmt->execute([$subject->getName(), $subject->getId()]);

            return true;
        } catch (\PDOException $exception) {
            return 'Erro ao atualizar o assunto.'.$exception->getMessage();
        }
    }

    public static function delete(int $id)
    {
        try {
            $stmt = Connect::getInstance()->prepare("DELETE FROM subject WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            return 'Erro ao excluir o assunto.'.$exception->getMessage();
        }
    }

    protected static function all()
    {
        try {
            $stmt = Connect::getInstance()->prepare("SELECT id, name FROM subject");
            $stmt->execute();

            $subjects = [];
            foreach($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row)
		    {
                $subject = new Subject();
                $subject->setId($row['id']);
                $subject->setName($row["name"]);

                $subjects[] = $subject;
            }

            return $subjects;

        } catch (\PDOException $exception) {
            return 'Erro ao trazer os assuntos.'.$exception->getMessage();
        }
    }

    public static function getall()
    {
        try {
            $subjects = self::all();
            $datatable = [];
            foreach($subjects as $subject)
		    {
                $datatable[] = [
                    'ID' => $subject->getId(),
                    'NOME' => $subject->getName(),
                    'UPDATE' => '<a href="javascript: void(0)" onclick="Get('.$subject->getId().')">Alterar</a>',
                    'DELETE' => '<a href="javascript: void(0)" onclick="Delete('.$subject->getId().')">Excluir</a>'
                ];
            }

            return $datatable;

        } catch (\Exception $exception) {
            return 'Erro ao trazer os autores.'.$exception->getMessage();
        }
    }

}