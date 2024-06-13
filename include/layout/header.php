<header class="header">
    <div class="header__container">
        <div class="header__primary">
            <nav class="header__nav">
                <ul class="header__menu">
                    <li><a class="logo" href="index.php"><img src="assets/img/logo.png" alt=""></a></li>
                </ul>
            </nav>
            <?php if (isset($_SESSION['id'])) : ?>
              <div class="header__btns">
                <a href="personal-account.php" class="header__sign-in">Личный кабинет</a>
                <a href="<?= BASE_URL . 'controllers/forms/logout.php'; ?>" class="header__sign-in">Выйти</a>
              </div>
            <?php else : ?>
                <div class="header__btns">
                    <a href="login.php" class="header__sign-in">Войти</a>
                    <a href="register.php" class="header__sign-in">Зарегистрироваться</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>
<main>