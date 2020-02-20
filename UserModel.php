<?php

require_once "Model.php";


class UserModel extends Model {

    protected static $table = 'users';
    public $fields = ["first_name", "last_name", "age", "pet_type"];

    public function save() {

    	

    }
    
}