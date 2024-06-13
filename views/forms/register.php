<div class="form">
	<div class="form__header">
		<a href="<?= BASE_URL . 'index.php' ?>" class="form__logo"><img src="assets/img/logo.png" alt=""></a>
		<a href="<?= BASE_URL . 'login.php' ?>" class="form__link-reg">Войти</a>
	</div>
	<div class="form__container">
		<form action="" method="POST" class="form__body">
			<h1 class="form__title">Регистрация клиента</h1>
			<div class="form__tabs">
				<div class="form__link i-active">Клиент</div>
				<a href="register-employee.php" class="form__link">Специалист</a>
			</div>
			<div class="form__label">Ваше имя</div>
			<div class="form__item">
				<input type="text" name="name" value="<?= $_SESSION['name'] ?>">
			</div>
			<div class="form__label">Мобильный телефон</div>
			<div class="form__item">
				<input type="text" name="phone" value="<?= $_SESSION['phone'] ?>">
			</div>
			<div class="form__label">Email</div>
			<div class="form__item">
				<input type="text" name="email" value="<?= $_SESSION['email'] ?>">
			</div>
			<div class="form__label">Пароль</div>
			<div class="form__item">
				<input type="password" name="password">
			</div>
			<div class="form__label">Повторите пароль</div>
			<div class="form__item">
				<input type="password" name="rep_pass">
			</div>
			<?php if (!empty($erroMessageRegister)) : ?>
				<div class="err"><?= $erroMessageRegister; ?></div>
			<?php endif ?>
			<button type="submit" name="register">Зарегистрироваться</button>
		</form>
	</div>
</div>