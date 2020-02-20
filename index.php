<?php

require_once "UserModel.php";
require_once "PetModel.php";

// Saving

$user1 = new UserModel();

$user1->save(["first_name" => "Sava", "last_name" => "Bezanovic", "age" => 23, "pet_type" => "doggo"]);

echo "<br>";

$user2 = new UserModel();

$user2->save(["first_name" => "Spasoje", "last_name" => "Spasic", "age" => 30]);

echo "<br>";

// Fetching

echo "People: <br>";

$people = UserModel
    ::select('*')
    ->where('age', '>', 20)
    ->where('age', '<', 50)
    ->orderBy('age', 'desc')
    ->limit(5)
    ->get();

foreach($people as $person => $data) {
	echo $data["first_name"] . "<br>";
}  

echo "Find: <br>";   

// Find by id

$snoopDogg = UserModel::find(75);

foreach($snoopDogg->{"foundData"} as $data) {
    echo $data . " ";
}

$snoopDogg2 = UserModel::find(1095);

    echo "<br>";

foreach($snoopDogg2->{"foundData"} as $data) {
    echo $data . " ";
}
// Update

echo "<br> Update: <br>";

// $snoopDogg = new UserModel();

$snoopDogg->update(['first_name' => 'TRUC']);

echo "<br>";

$snoopDogg2->update(["first_name" => "BLA"]);

// Joining

echo "<br> Users With Pets: <br>";

$usersWithPets = UserModel::
    select('users.first_name, pets.name')
    ->join('pets', 'pets.user_id', '=', 'users.id')
    ->limit(5)
    ->get();  

foreach($usersWithPets as $data => $values) {
	echo "User: " . $values["first_name"] . "<br> Pet: " . $values["name"];
}

$lesi = new PetModel();

echo "<br>";

$lesi->save(["name" => "Lessie", "breed" => "Collie", "user_id" => 75]);

echo "<br>";

$pets = PetModel
    ::select('*')
    ->where('user_id', '>', 10)
    ->where('user_id', '<', 2000)
    ->orderBy('user_id', 'desc')
    ->limit(5)
    ->get();

foreach($pets as $pet => $data) {
    echo $data["name"] . "<br>";
} 

echo "Find: <br>"; 

$lessie = PetModel::find(2);

foreach($lessie->{"foundData"} as $data) {
    echo $data . " ";
}

echo "<br>";

$bea = PetModel::find(1);

foreach($bea->{"foundData"} as $data) {
    echo $data . " ";
}

echo "<br> Update: <br>";

// $snoopDogg = new UserModel();

$lessie->update(['name' => 'Bea']);

echo "<br>";

$bea->update(["name" => "Lessie"]);