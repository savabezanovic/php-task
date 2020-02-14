<?php

class UserModel extends Model {

    protected $table = 'users';

    public $firstName;
    public $lastName;
    public $age;
    public static $id;
    public static $array = [];

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

    	self::$array["what"] = $string;

 		return new self;

    }


    public function join($one, $two, $three, $four) {

    	return $this;

    }

    public function where($one, $two, $three) {

    	if (empty(self::$array["where"])) {
    		
    		self::$array["where"] = [$one, $two, $three];

    	} else {

    	self::$array["where2"] = [$one, $two, $three]; 

    	}

    	return $this;

    }

    public function orderBy($one, $two) {

    	self::$array["order"] = [$one, $two];

    	return $this;

    }

    public function limit($one) {

    	self::$array["limit"] = $one;

    	return $this;

    }



    public function get() {

    	// $array = [

    	// 	"what" => "*",
    	// 	"where" => ["age", ">", 40],
    	// 	"where2" => ["age", "<", 50],
    	// 	"order" => ["age", "DESC"],
    	// 	"limit" => 5

    	// ];

    	try {

    		$sql = "SELECT " . self::$array["what"] . " FROM users WHERE " . "users." . implode(" ", self::$array["where"]) . " AND " . "users."  . implode(" ", self::$array["where2"]) . " ORDER BY users." . implode(" ", self::$array["order"]) . " LIMIT " . self::$array["limit"];

    		// $sql = "SELECT * FROM users WHERE users.age > 40 AND users.age < 50 ORDER BY users.age DESC LIMIT 5";

    		$stmt = Database::connect()->prepare($sql);
    		$stmt->execute();
    		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    		echo "<br> Get found you this:";

    		foreach ($results as $key => $value) {
    			echo "<br>" . $value["firstName"];
    		}

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

			echo "<br> Find found you this: <br>" . $results[0]["firstName"];

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

    	} catch (PDOException $e) {

    		echo "Update is not working " . $e->getMessage() . " !";

    	}	

    }

}