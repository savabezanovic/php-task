<?php  

require_once "Model.php";

class PetModel extends Model {

	public $fields = ["name", "breed", "user_id"];
	protected static $table = "pets";

}