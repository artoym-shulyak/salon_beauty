<?php
$erroMessageEmail = '';
$successMessEmail = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_email'])) {
	$old_email = $_POST['old_email'];
	$new_email = $_POST['new_email'];
	$id = $_POST['id'];
	$position = $_POST['position'];

	// formatEnter($_POST);

	if ($old_email === '' || $new_email === '') {
		$erroMessageEmail = 'Заполните все поля!';
	} else if ($old_email === $new_email) {
		$erroMessageEmail = 'Этот Email уже является Вашим!';
	} else if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
		$erroMessageEmail = 'Введите корректный email!';
	} else {
		$user = findUserById($id);

		if ($user['email'] === $new_email) {
			$erroMessageEmail = 'Такой email уже существует!';
		} else {
			if ($position === 'Клиент') {
				update('clients', $id, ["email" => $new_email]);
			} else {
				update('employees', $id, ["email" => $new_email]);
			}
			$erroMessageEmail = '';
			$successMessEmail = 'Email успешно изменен!';
		}
	}
}
