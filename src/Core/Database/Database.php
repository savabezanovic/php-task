<?php

namespace Core\Database;

use \PDO;

class Database {

	private static $pdo;

	private static function setConnection() {

		$dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";";
		self::$pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
		self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return self::$pdo;
	}

	public static function connect() {

	    return self::setConnection();

    }

}	