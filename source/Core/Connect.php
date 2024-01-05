<?php

namespace Source\Core;

class Connect
{
    /** @const array */
    private const OPTIONS = [
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::ATTR_CASE => \PDO::CASE_NATURAL
    ];

    private const CONF_DB_HOST = 'localhost';
    private const CONF_DB_USER = 'testetj';
    private const CONF_DB_PASS = 'testetj';
    private const CONF_DB_NAME = 'testetj';

    /** @var \PDO */
    private static $instance;

    /**
     * @return \PDO
     */
    public static function getInstance(): ?\PDO
    {
        if (empty(self::$instance)) {
            try {
                self::$instance = new \PDO(
                    "mysql:host=" . self::CONF_DB_HOST . ";dbname=" . self::CONF_DB_NAME,
                    self::CONF_DB_USER,
                    self::CONF_DB_PASS,
                    self::OPTIONS
                );
            } catch (\PDOException $exception) {
                echo 'Erro de conexão | '.$exception->getMessage();
            }
        }

        return self::$instance;
    }
}