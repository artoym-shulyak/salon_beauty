<?php
$erroMessageRegisterEmployee = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_employee'])) {
    $name = $_POST['name'];
    $brend = $_POST['brend'];
    $position = $_POST['position']; // corrected from 'employee' to 'position'
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rep_pass = $_POST['rep_pass'];
    $isNext = true;
    $isNewBrend = false;

    // formatEnter($_POST);

    // Initialize session variables
    $_SESSION['name'] = $name;
    $_SESSION['brend'] = $brend;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;

    // Check if the position is 'Администратор' and if the brand already exists
    if ($position == 4) { // assuming '4' is the id for 'Администратор'
        $isNewBrend = true;
        $isBrend = selectOne('brends', ['id' => $brend]);
        if ($isBrend && $isBrend['id'] === $brend) {
            $isNext = false;
        }
    }

    // Validate input fields
    if ($isNext) {
        if (empty($name) || empty($phone) || empty($password) || empty($rep_pass) || empty($email) || empty($position) || empty($brend)) {
            $erroMessageRegisterEmployee = 'Не все поля заполнены!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erroMessageRegisterEmployee = 'Введите корректный email!';
        } elseif ($password !== $rep_pass) {
            $erroMessageRegisterEmployee = 'Пароли не совпадают!';
        } else {
            // Check if email already exists
            $isMail = selectOne('employees', ['email' => $email]);
            if ($isMail && $isMail['email'] === $email) {
                $erroMessageRegisterEmployee = 'Такой email уже существует!';
            } else {
                // Create or get the brand id
                if ($isNewBrend) {
                    $company = ['name' => $brend];
                    $brend_id = insert('brends', $company);
                } else {
                    $brendData = selectOne('brends', ['id' => $brend]);
                    $brend_id = $brendData['id'];
                }

                // Create the new employee
                $user = [
                    'name' => $name,
                    'brend_id' => $brend_id,
                    'position_id' => $position,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => password_hash($password, PASSWORD_DEFAULT), // Always hash passwords
                ];

                $id = insert('employees', $user);
                $user = selectOne('employees', ['id' => $id]);
                $_SESSION['id'] = $user['id'];
                
                // Clear session variables
                unset($_SESSION['name'], $_SESSION['email'], $_SESSION['brend'], $_SESSION['position'], $_SESSION['phone']);
                
                $erroMessageRegisterEmployee = '';
    echo '<script>window.location.href="' . BASE_URL . 'personal-account.php";</script>';
    exit();
                exit();
            }
        }
    } else {
        $erroMessageRegisterEmployee = 'Такой бренд уже существует!';
    }
}
?>
