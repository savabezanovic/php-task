<?php

namespace Core\Database;
use Config\Config;
use \PDO;

class Database {

	private static $pdo;

	private static function setConnection() {

		$configProvider = Config::get();
		$config = $configProvider->getConfig();

		$dsn = "mysql:host=" . $config["host"] . ";dbname=" . $config["db"] . ";";
		self::$pdo = new PDO($dsn, $config["user"], $config["password"]);
		self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return self::$pdo;
	}

	public static function connect() {

	    return self::setConnection();

    }

}	