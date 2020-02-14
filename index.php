<?php

require "Database.php";
require "Model.php";
require "UserModel.php";

// Saving
$user = new UserModel();
$user->firstName = 'Snoop';
$user->lastName = 'Dogg';
$user->age = 48;
$user->save();
// Fetching
$people = UserModel::
    select('*')
    ->where('age', '>', 40)
    ->where('age', '<', 50)
    ->orderBy('age', 'desc')
    ->limit(5)
    ->get();
// Find by id
$snoopDogg = UserModel::find(75);
$snoopDogg = new UserModel();
// Update
$snoopDogg->update(['name' => 'Snoopy']);
// Joining
$usersWithPets = UserModel::
			select('users.firstName, pets.name')
			->join('pets', 'pets.user_id', '=', 'users.id')
			->get();