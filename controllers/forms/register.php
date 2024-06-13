<?php
ob_start();
$erroMessageRegister = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$rep_pass = $_POST['rep_pass'];

	$_SESSION['name'] = $name;
	$_SESSION['email'] = $email;
	$_SESSION['phone'] = $phone;

	if ($name === '' || $phone === '' || $password === '' || $rep_pass === '' || $email === '') {
		$erroMessageRegister = 'Не все поля заполнены!';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$erroMessageRegister = 'Введите корректный email!';
	} else if ($password != $rep_pass) {
		$erroMessageRegister = 'Пароли не совпадают!';
	} else {
		$isMail = selectOne('clients', ['email' => $email]);

		if ($isMail['email'] === $email) {
			$erroMessageRegister = 'Такой email уже существует!';
		} else {
			$user = [
				'name' => $name,
				'email' => $email,
				'phone' => $phone,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'position_id' => 5,
			];

			$id = insert('clients', $user);
			$user = selectOne('clients', ['id' => $id]);
			$_SESSION['id'] = $user['id'];
			unset($_SESSION['name']);
			unset($_SESSION['email']);
			unset($_SESSION['phone']);
			$erroMessageRegister = '';
    echo '<script>window.location.href="' . BASE_URL . 'personal-account.php";</script>';
    exit();
		}
	}
}

ob_end_flush();