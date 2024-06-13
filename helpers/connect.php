<?php

$driver = 'mysql';
$host = 'localhost';

$db_name = 'salon_beaty';
$user = 'root';
$pass = '1234';
$charset = 'utf8mb4';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
  $pdo = new PDO("$driver:host=$host;dbname=$db_name;charset=$charset", $user, $pass, $options);
} catch (PDOException $i) {
  die('Error connected to BD...');
}
