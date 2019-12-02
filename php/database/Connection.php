<?php 

// TODO: Isso vai vir de um arquivo db_properties.properties depois.
define ('HOST', 'localhost');
define('DB', 'todolist');
define('USERNAME', 'root');
define('PASS', 'root');

class Connection
{
  
    private static $connection;

    private function __construct(){ }

    public static function getInstance()
    {

        if(!isset(self::$connection))
        {
            try
            {
                self::$connection = new PDO(
                "mysql:host=".HOST.";dbname=".DB."",
                USERNAME,
                PASS
                );

                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            }
            catch(PDOException $e){
                echo 'Connection Failed: '.$e->getMessage();
            }
        }

        return self::$connection;

    }

    public static function closeConnection()
    {
        self::$connection = null;
    }

}