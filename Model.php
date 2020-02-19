<?php

class Model {

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

}