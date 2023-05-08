<?php

class Database
{
    private $DB_HOST = DB_HOST;
    private $DB_NAME = DB_NAME;
    private $DB_TYPE = DB_TYPE;

    protected static $connection;

    public function __construct()
    {
        try
        {
            $dsn = "$this->DB_TYPE:host=$this->DB_HOST;dbname=$this->DB_NAME";
            self::$connection = new PDO($dsn, DB_USER, DB_PASS);
        }catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$connection)
        {
            return self::$connection;
        }

        $instance = new self();
        return $instance;
    }
}
