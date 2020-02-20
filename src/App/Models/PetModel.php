<?php  

namespace App\Models;

use Core\Models\Model;

class PetModel extends Model {

	public $fields = ["name", "breed", "user_id"];
	protected static $table = "pets";

}