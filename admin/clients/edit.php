<?php
$fieldsEditClient = ['fields' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_client'])) {
	$name = $_POST['name_client'];
	$email = $_POST['email_client'];
	$phone = $_POST['phone_client'];
	// $password = $_POST['password_employee'];
	$id = $_POST['id_client'];

	$_SESSION['name_client'] = $name;
	$_SESSION['email_client'] = $email;
	$_SESSION['phone_client'] = $phone;
	$_SESSION['id_client'] = $id;
	// $_SESSION['password_employee'] = $password;

	// formatEnter($_POST);

	if ($name === '' || $phone === '' || $email === '') {
		$fieldsEditClient['fields'] = 'Не все поля заполнены!';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$fieldsEditClient['fields'] = 'Введите корректный email!';
	} else {
		$isMail = selectOne('clients', ['email' => $email]);
		$updateClient = [
			'name' => $name,
			'email' => $email,
			'phone' => $phone
		];

		update('clients', $id, $updateClient);
		unset($_SESSION['name_client']);
		unset($_SESSION['position_client']);
		unset($_SESSION['email_client']);
		unset($_SESSION['phone_client']);
		unset($_SESSION['id_employee']);
		header('Location: ' . BASE_URL . 'admin-clients.php');
	}
}
