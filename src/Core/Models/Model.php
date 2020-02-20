<?php

namespace Core\Models;

use Core\Database\Database;
use \PDO;

class Model {

	protected static $table;
	public $fields = [];
    public $values = [];

    public static $id; 
    public $userId;

    public $counter = 0;

    public static $array = [];
    protected $query = [];

    public $foundData;

    public function __construct($foundData = null) {

        {

            $this->query = self::$array;

            self::$array = [];

            $this->userId = self::$id;

            self::$id = null;

            if($foundData) {

                $this->foundData = $foundData;

            }
        }   

    }


	public function save($niz) {

    //     $niz = [
    //     "first_name" => "Sava", 
    //     "last_name" => "Bezanovic", 
    //     "age" => 48];

        $this->values = $niz;

    	try {

    		$sql = "INSERT INTO " . static::$table . " (" . implode(", ", array_keys($this->values)) . ") VALUES (:" . implode(", :", array_keys($this->values)) . ")";

			$stmt = Database::connect()->prepare($sql);

            foreach($this->values as $field => $value) { 
            
                $stmt->bindValue(":" . $field, $value, PDO::PARAM_STR);

            }

			$stmt->execute();

			echo " New user saved to the database! ";

    	} catch (PDOException $e) {

    		echo " Did not manage to save new user " . $e->getMessage() . " !";

    	}

    }

    public static function select($string) {

			self::$array["select"] = 'SELECT ' . $string . ' FROM '. static::$table;

			return new static; 

    }

   	public function join($table, $fieldOne, $symbol, $fieldTwo) {

    	$this->query["join"] = " RIGHT JOIN " . $table . " ON " . $fieldOne . $symbol . $fieldTwo;

    	return $this;

    }

    public function where($one, $two, $three) {

    	if($this->counter === 0) {

    		$this->counter++;

    		$this->query["where"] = " WHERE " . $one . " " . $two . " " . $three;

    	} else if ($this->counter !== 0) {

    		$this->query["where"] .= " AND " . $one . " " . $two . " " . $three;

    	}

    	return $this;

    }

    public function orderBy($one, $two) {

    	$this->query["orderBy"] = " ORDER BY " . $one . " " . $two;

    	return $this;

    }

    public function limit($one) {

    	$this->query["limit"] = ' LIMIT ' . $one;

    	return $this;

    }



    public function get() {

        // $query = [

        //     "select" => 'SELECT ' . $string . ' FROM '. static::$table,
        //     "join" => " RIGHT JOIN " . $table . " ON " . $fieldOne . $symbol . $fieldTwo,
        //     "where" => " WHERE " . $one . " " . $two . " " . $three " AND " . $one . " " . $two . " " . $three,
        //     "orderBy" => " ORDER BY " . $one . " " . $two,
        //     "limit" => ' LIMIT ' . $one

        // ];

    	try {

    		$sql = implode(" ", $this->query);
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

    		$sql = "SELECT * FROM " . static::$table . " WHERE " . static::$table . ".id = '$id' ";

			$stmt = Database::connect()->prepare($sql);

			$stmt->execute();

			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			self::$id = $results[0]["id"];

            if(count($results) == 0) {
                return null;
            }

			return new static($results[0]);

    	} catch (PDOException $e) {

    		echo "Find is not working " . $e->getMessage() . " !";

    	}

    }

    public function update($data) {

    	$id = $this->userId;

    	try {

            $sql = "UPDATE " . static::$table . " SET " . static::$table . "." . key($data) . " = '" . $data[key($data)] . "' WHERE " . static::$table .".id = '$id' ";

			$stmt = Database::connect()->prepare($sql);

			$stmt->execute();

			echo "Update was succesful!";

    	} catch (PDOException $e) {

    		echo "Update is not working " . $e->getMessage() . " !";

    	}	

    }

}