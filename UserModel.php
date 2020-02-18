<?php

class UserModel extends Model {

    public static $table = 'users';

    public $firstName;
    public $lastName;
    public $age;
    public static $id;
    public static $array = [];
    public $counter = 0;

    public function save() {


    	try {

    		$sql = "INSERT INTO users (firstName, lastName, age) VALUES (:firstName, :lastName, :age)";

			$stmt = Database::connect()->prepare($sql);

			$stmt->BindParam(':firstName', $this->firstName, PDO::PARAM_STR);
			$stmt->BindParam(':lastName', $this->lastName, PDO::PARAM_STR);
			$stmt->BindParam(':age', $this->age, PDO::PARAM_STR);

			$stmt->execute();

			echo " New user saved to the database! ";

    	} catch (PDOException $e) {

    		echo " Did not manage to save new user " . $e->getMessage() . " !";

    	}

    }

    public static function select($string) {

    	self::$array[] = " SELECT " . $string . " FROM " . self::$table;

  //   	$n = count(self::$array);

		// self::$array[$n] = ['SELECT ' . $string . ' FROM '. self::$table];

		// return new self($array[$n]);

 		return new self;

    }


    public function join($table, $fieldOne, $symbol, $fieldTwo) {

    	self::$array[] = " RIGHT JOIN " . $table . " ON " . $fieldOne . $symbol . $fieldTwo;

    	return $this;

    }

    public function where($one, $two, $three) {

    	if($this->counter === 0) {

    		$this->counter++;

    		self::$array[] = " WHERE " . $one . " " . $two . " " . $three;

    	} else if ($this->counter !== 0) {

    		self::$array[] = " AND " . $one . " " . $two . " " . $three;

    	}

    	return $this;

    }

    public function orderBy($one, $two) {

    	self::$array[] = " ORDER BY " . $one . " " . $two;

    	return $this;

    }

    public function limit($one) {

    	self::$array[] = ' LIMIT ' . $one;

    	return $this;

    }



    public function get() {

    	try {

    		$sql = implode(" ", self::$array);
    		$stmt = Database::connect()->prepare($sql);
    		$stmt->execute();
    		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    		var_dump($results);

    		self::$array = null;

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