<?php

class Database {

	public static function connect() {

		try {

			return $pdo = new PDO("mysql:host=mysql;dbname=simpleorm", "admin", "admin");

		} catch (PDOException $e) {

			echo "Did not connect to database " . $e->getMessage() . " !";

		}

	}
}	