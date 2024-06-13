<div class="form">
	<div class="form__header">
		<a href="<?= BASE_URL . 'index.php' ?>" class="form__logo"><img src="assets/img/logo.png" alt=""></a>
		<a href="<?= BASE_URL . 'register.php' ?>" class="form__link-reg">Регистрация</a>
	</div>
	<div class="form__container">
		<form action="" method="POST" class="form__body">
			<h1 class="form__title">Вход</h1>
			<div class="form__label">Email</div>
			<div class="form__item">
				<input type="text" name="email" value="<?= $_SESSION['email'] ?>">
			</div>
			<div class="form__label">Пароль</div>
			<div class="form__item">
				<input type="password" name="password">
			</div>
			<?php if (!empty($erroMessageLogin)) : ?>
				<div class="err"><?= $erroMessageLogin; ?></div>
			<?php endif ?>
			<button type="submit" name="login">Войти</button>
		</form>
	</div>
</div>