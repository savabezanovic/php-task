<?php

class UserModel extends Model {

    public static $table = 'users';

    public $firstName;
    public $lastName;
    public $age;
    public static $id;
    public $counter = 0;

    public static $array;
    protected $query;

    public function __construct() {

    	{

    		$this->query = self::$array;

    		self::$array = "";

    	}

    }

    public static function select($string) {

			self::$array = 'SELECT ' . $string . ' FROM '. self::$table;

			return new self; 

    }


    public function join($table, $fieldOne, $symbol, $fieldTwo) {

    	$this->query = $this->query . " RIGHT JOIN " . $table . " ON " . $fieldOne . $symbol . $fieldTwo;

    	return $this;

    }

    public function where($one, $two, $three) {

    	if($this->counter === 0) {

    		$this->counter++;

    		$this->query = $this->query . " WHERE " . $one . " " . $two . " " . $three;

    	} else if ($this->counter !== 0) {

    		$this->query = $this->query . " AND " . $one . " " . $two . " " . $three;

    	}

    	return $this;

    }

    public function orderBy($one, $two) {

    	$this->query = $this->query . " ORDER BY " . $one . " " . $two;

    	return $this;

    }

    public function limit($one) {

    	$this->query = $this->query . ' LIMIT ' . $one;

    	return $this;

    }



    public function get() {

    	try {

    		// $sql = implode(" ", $this->query);
    		$sql = $this->query;
    		$stmt = Database::connect()->prepare($sql);
    		$stmt->execute();
    		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    		return $results;

    	} catch (PDOException $e) {

    		echo "Get is not working " . $e->getMessage() . " !";

    	}	

    }

    public static function find($id) {

    	try {

    		$sql = "SELECT * FROM users WHERE users.id = '$id' ";

			$stmt = Database::connect()->prepare($sql);

			$stmt->execute();

			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			self::$id = $results[0]["id"];

			return $results;

    	} catch (PDOException $e) {

    		echo "Find is not working " . $e->getMessage() . " !";

    	}

    }

    public function update($array) {

    	$name = $array["name"];

    	$id = self::$id;

    	try {

    		$sql = "UPDATE users SET users.firstName = '$name' WHERE users.id = '$id' ";

			$stmt = Database::connect()->prepare($sql);

			$stmt->execute();

			echo "Update was succesful!";

    	} catch (PDOException $e) {

    		echo "Update is not working " . $e->getMessage() . " !";

    	}	

    }

}