<?php

require "Database.php";
require "Model.php";
require "UserModel.php";

// Saving
$user = new UserModel();
$user->firstName = 'Snoop';
$user->lastName = 'Dogg';
$user->age = 48;
echo $user->save();
// Fetching
$people = UserModel::
    select('*')
    ->where('age', '>', 40)
    ->where('age', '<', 50)
    ->orderBy('age', 'desc')
    ->limit(5)
    ->get();
foreach ($people as $key => $value) {
    echo "<br>" . $value["firstName"];
}
// Find by id
$snoopDogg = UserModel::find(75);
echo "<br> Find found this: " . $snoopDogg[0]["firstName"] . "<br>";
// Update
$snoopDogg = new UserModel();
$snoopDogg->update(['name' => 'Snoopy']);
// Joining
echo "<br> ZABO PRE <br>";

$usersWithPets = UserModel::
			select('users.firstName, pets.name')
			->join('pets', 'pets.user_id', '=', 'users.id')
			->get();

echo "<br> ZABO POSLE <br>";

echo $usersWithPets[0]["firstName"] . " " . $usersWithPets[0]["name"];

// $user1 = new UserModel();
// // $user1->firstName = 'Sava';
// // $user1->lastName = 'Truc';
// // $user1->age = 48;
// // $user1->save();

// $user2 = new UserModel();
// // $user2->firstName = 'Spasoje';
// // $user2->lastName = 'Bla';
// // $user2->age = 48;
// // // $user2->save();

// // $people = UserModel::
// //     select('*')
// //     ->where('age', '>', 40)
// //     ->where('age', '<', 50)
// //     ->orderBy('age', 'desc')
// //     ->limit(5)
// //     ->get();

// foreach ($people as $key => $value) {
//     echo "<br>" . $value["firstName"];
// }    

// $q1 = $user1::select('*');

// $q2 = $user2::select('*');

// $q1->where('age', '>', 40)->get();

// $q2->where('age', '<', 50)->get();