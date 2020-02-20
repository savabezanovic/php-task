<?php

namespace App\Models;

use Core\Models\Model;

class UserModel extends Model {

    protected static $table = 'users';
    public $fields = ["first_name", "last_name", "age", "pet_type"];
    
}