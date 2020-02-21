<?php

namespace Config;

class Config {

	private static $instance = null;

	private $config = [];

	private function __construct() {

		$this->config = [

			"host" => $_ENV['DB_HOST'],
			"user" => $_ENV['DB_USER'],
			"password" => $_ENV['DB_PASS'],
			"db" => $_ENV['DB_NAME']

		];
	}


	public static function get() {

		if (self::$instance == null) {

			return self::$instance = new Config();

		}

		return self::$instance;

	}

	public function getConfig() {

		return $this->config;

	}

}