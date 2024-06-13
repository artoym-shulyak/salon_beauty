<?php

$erroMessageBrend = '';
$successMessBrend = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_brend'])) {
	$name = $_POST['name'];
	$adress = $_POST['adress'];
	$phone = $_POST['phone'];
	$id = $_POST['id'];

	$updateBrend = [
		'name' => $name,
		'adress' => $adress,
		'phone' => $phone
	];
	update('brends', $id, $updateBrend);
	$erroMessageBrend = '';
	$successMessBrend = 'Данные успешно сохранились!';
}
