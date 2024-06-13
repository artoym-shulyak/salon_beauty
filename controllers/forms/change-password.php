<?php

$erroMessagePass = '';
$successMessPass = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$rep_password = $_POST['rep_password'];
	$id = $_POST['id'];
	$position = $_POST['position'];

	if ($old_password === '' || $new_password === '' || $rep_password === '') {
		$erroMessagePass = 'Заполните все поля!';
	} else if ($new_password !== $rep_password) {
		$erroMessagePass = 'Пароли не совпадают!';
	} else {
		$updateUser = [
			'password' => $new_password,
		];

		if ($position === 'Клиент') {
			update('clients', $id, $updateUser);
		} else {
			update('employees', $id, $updateUser);

			$erroMessagePass = '';
			$successMessPass = 'Пароль успешно изменен!';
		}
	}
}
