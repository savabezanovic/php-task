<?php

require "Database.php";
require "Model.php";
require "UserModel.php";

$user1 = new UserModel();
$user1->firstName = 'Sava';
$user1->lastName = 'Truc';
$user1->age = 48;
// $user1->save();

$user2 = new UserModel();
$user2->firstName = 'Spasoje';
$user2->lastName = 'Bla';
$user2->age = 48;
// // $user2->save(); 

$q1 = $user1::select('*');

$q2 = $user2::select('*');

$q1->where('age', '>', 40)->get();


$q2->where('age', '<', 40)->get();

$q1->where('age', '<', 50)->get();

$q1->bla();