<?php
$erroMessagePhone = '';
$successMessPhone = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_phone'])) {
	$old_phone = $_POST['old_phone'];
	$new_phone = $_POST['new_phone'];
	$id = $_POST['id'];
	$position = $_POST['position'];

	if ($old_phone === '' || $new_phone === '') {
		$erroMessagePhone = 'Заполните все поля!';
	} else if ($old_phone === $new_phone) {
		$erroMessagePhone = 'Этот номер уже является Вашим!';
	} else {
		if ($position === 'Клиент') {
			update('clients', $id, ["phone" => $new_phone]);
		} else {
			update('employees', $id, ["phone" => $new_phone]);
		}
		$erroMessagePhone = '';
		$successMessPhone = 'Телефон успешно изменен!';
	}
}
