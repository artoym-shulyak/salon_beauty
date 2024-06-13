<form action="" method="post" class="profily__item">
	<input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
	<input type="hidden" name="position" value="<?= $user['position'] ?>">
	<h2 class="profily__title">Изменить пароль</h2>
	<div class="profily__wrap">
		<div class="profily__label">
			<div class="profily__key">Старый пароль</div>
			<div class="profily__value"><input type="password" name="old_password" value=""></div>
		</div>
		<div class="profily__label">
			<div class="profily__key">Новый пароль</div>
			<div class="profily__value"><input type="password" name="new_password" value=""></div>
		</div>
		<div class="profily__label">
			<div class="profily__key">Подтвердите пароль</div>
			<div class="profily__value"><input type="password" name="rep_password" value=""></div>
		</div>
		<?php if (!empty($erroMessagePass)) : ?>
			<div class="err"><?= $erroMessagePass; ?></div>
		<?php endif ?>
		<?php if (!empty($successMessPass)) : ?>
			<div class="success"><?= $successMessPass; ?></div>
		<?php endif ?>
		<button type="submit" name="change_password">Изменить пароль</button>
	</div>
</form>