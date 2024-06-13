<?php
$erroMessageData = '';
$successMessDate = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_data'])) {
	$name = $_POST['name'];
	$password = $_POST['password'];
	$description = $_POST['description'];
	$id = $_POST['id'];

	if ($name === '') {
		$erroMessageData = 'Введите свое имя!';
	} else {
		$updateUser = [
			'name' => $name,
			'description' => $description
		];
		if($user['position_id'] == 5) {
			update('clients', $id, $updateUser);
		} else {
			update('employees', $id, $updateUser);
		}
		$erroMessageData = '';
    header('location: ' . BASE_URL . 'personal-account.php');
	}
}
