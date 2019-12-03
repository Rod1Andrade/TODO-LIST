<?php

namespace php\ado;

use php\ErrorExceptions\ConnectionException;

use PDO;

/**
 * @author: Rodrigo M.P Andrade
 * Classe para gerenciar Conexão com o banco de dados.
 */

class Connection
{

    private static $connection;

    private function __construct() { }

    /**
     * open()
     * Recebe o nome do banco de dados e instância um objeto
     * PDO correspondente
     */
    public static function open($configpath)
    {

        # Verifica a exitência de um arquivo de configuração:
        if(file_exists($configpath))
            $db = parse_ini_file($configpath);
        else
            throw new ConnectionException("Arquivo de Configuração não encontrado");
    
        # Lê as informações contidas no arquivo:
        $user   = isset($db['user']) ? $db['user'] : 'NULL';    
        $pass   = isset($db['pass']) ? $db['pass'] : 'NULL';   
        $dbname = isset($db['dbname']) ? $db['dbname'] : 'NULL';
        $host   = isset($db['host']) ? $db['host'] : 'NULL';    
        $type   = isset($db['type']) ? $db['type'] : 'NULL';    
        $port   = isset($db['port']) ? $db['port'] : 'NULL';  

        switch($type)
        {   
            case 'mysql':
                $port = $port ? $port : '3306';
                self::$connection = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $pass);
            break;

            case 'mariadb':
                $port = $port ? $port : '3306';
                self::$connection = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass);
            break;

            default:
                throw new ConnectionException('Banco de dados não contém Configurações');
            break;
        }

        # Define que o PDO lance exceções em caso de erro:
        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return self::$connection;
        
    }

    public static function closeConnection()
    {
        self::$connection = null;
    }

}