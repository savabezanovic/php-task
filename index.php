<?php

require "Database.php";
require "Model.php";
require "UserModel.php";

// Saving

$user1 = new UserModel();
// $user1->save(["Sava", "Bezanovic", 23]);

// echo "<br>";

// $user2 = new UserModel();
// $user2->save(["Spasoje", "Spasic", 30]);

echo "<br>";


// Fetching

echo "People: <br>";

$people = UserModel
    ::select('*')
    ->where('age', '>', 20)
    ->where('age', '<', 30)
    ->orderBy('age', 'desc')
    ->limit(5)
    ->get();

foreach($people as $person => $data) {

	echo $data["firstName"] . "<br>";

}  

echo "Find: <br>";    

// Find by id

$snoopDogg = UserModel::find(75);

foreach($snoopDogg->{"foundData"} as $data) {

    echo $data . "<br>";

}



// Update

echo "<br> Update: <br>";

// $snoopDogg = new UserModel();
$snoopDogg->update(['name' => 'Sava']);

// Joining

echo "<br> Users With Pets: <br>";

$usersWithPets = UserModel::
    select('users.firstName, pets.name')
    ->join('pets', 'pets.user_id', '=', 'users.id')
    ->get();  

foreach($usersWithPets as $data => $values) {

	echo "User: " . $values["firstName"] . "<br> Pet: " . $values["name"];

}