<?php

require "Database.php";
require "Model.php";
require "UserModel.php";

// Saving

$user1 = new UserModel();
$user1->firstName = 'Snoop';
$user1->lastName = 'Dogg';
$user1->age = 48;
$user1->save();

echo "<br>";

$user2 = new UserModel();
$user2->firstName = 'Bla';
$user2->lastName = 'Truc';
$user2->age = 45;
$user2->save();

echo "<br>";


// Fetching

echo "People: <br>";

$people = UserModel
    ::select('*')
    ->where('age', '>', 40)
    ->where('age', '<', 50)
    ->orderBy('age', 'desc')
    ->limit(5)
    ->get();

foreach($people as $person => $data) {

	echo $data["firstName"] . "<br>";

}  

echo "Find: <br>";    

// Find by id

$snoopDogg = UserModel::find(75);

foreach($snoopDogg as $data => $values) {

	echo $values["firstName"] . " " . $values["lastName"] . "<br>";

}

// Update

echo "Update: <br>";

$snoopDogg = new UserModel();
$snoopDogg->update(['name' => 'Snoopy']);

// Joining

echo "<br> Users With Pets: <br>";

$usersWithPets = UserModel::
    select('users.firstName, pets.name')
    ->join('pets', 'pets.user_id', '=', 'users.id')
    ->get();  

foreach($usersWithPets as $data => $values) {

	echo "User: " . $values["firstName"] . "<br> Pet: " . $values["name"];

}