<?php
$fieldsAddClient = ['fields' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_client'])) {
	$name = $_POST['name_client'];
	$email = $_POST['email_client'];
	$phone = $_POST['phone_client'];
	// $password = $_POST['password_client'];

	$_SESSION['name_client'] = $name;
	$_SESSION['email_client'] = $email;
	$_SESSION['phone_client'] = $phone;

	if ($name === '' || $position === '' || $phone === '' || $email === '') {

		$fieldsAddClient['fields'] = 'Не все поля заполнены!';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$fieldsAddClient['fields'] = 'Введите корректный email!';
	} else {
		$isMail = selectOne('clients', ['email' => $email]);

		if ($isMail['email'] === $email) {
			$fieldsAddClient['fields'] = 'Такой email уже существует!';
		} else {
			$employee = [
				'name' => $name,
				'email' => $email,
				'phone' => $phone
			];

			insert('clients', $employee);
			unset($_SESSION['name_client']);
			unset($_SESSION['email_client']);
			unset($_SESSION['phone_client']);
			header('Location: ' . BASE_URL . 'admin-clients.php');
		}
	}
}
