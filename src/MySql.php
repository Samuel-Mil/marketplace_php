<?php

namespace Src;

use \PDO;

class MySql
{
	private static ?PDO $pdo = null;

	public static function connect()
	{
		$host     = $_ENV['DB_HOST'] ?? '';
        $name     = $_ENV['DB_NAME'] ?? '';
        $user     = $_ENV['DB_USER'] ?? '';
        $password = $_ENV['DB_PASSWORD'] ?? '';

        if(self::$pdo == null){
            try{
                self::$pdo = new PDO('mysql:host='.$host.';dbname='.$name,$user,$password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(\Exception $e){
                die("<h3>Database connection error!</h3>");
            }
        }

        return self::$pdo;
	}
}
