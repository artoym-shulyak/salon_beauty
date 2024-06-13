<?php
ob_start();
function findUserByEmail($email)
{
	global $pdo;

	$sql = "
			SELECT 'employee' AS user_type, id, email, password 
			FROM employees 
			WHERE email = :email
			UNION
			SELECT 'client' AS user_type, id, email, password 
			FROM clients 
			WHERE email = :email
	";

	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	$stmt->execute();

	return $stmt->fetch(PDO::FETCH_ASSOC);
}

$erroMessageLogin = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $_SESSION['email'] = $email;

  if ($email === '' || $password === '') {
    $erroMessageLogin = 'Не все поля заполнены!';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erroMessageLogin = 'Введите корректный email!';
  } else {
    $user = findUserByEmail($email);



    if ($user && password_verify($password, $user['password'])) {
    $_SESSION['id'] = $user['id'];
    unset($_SESSION['email']);
    $erroMessageLogin = '';
    echo '<script>window.location.href="' . BASE_URL . 'personal-account.php";</script>';
    exit();
    } else {
      $erroMessageLogin = 'Не правильный email или пароль.';
    }
  }
}
ob_end_flush();
