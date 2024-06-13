<form action="" method="post" class="profily__item">
	<input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
	<input type="hidden" name="position" value="<?= $user['position'] ?>">
	<h2 class="profily__title">Изменить номер мобильного</h2>
	<div class="profily__wrap">
		<div class="profily__label">
			<div class="profily__key">Текущий номер</div>
			<div class="profily__value" style="pointer-events: none;"><input type="text" name="old_phone" value="<?= $user['phone'] ?>"></div>
		</div>
		<div class="profily__label">
			<div class="profily__key">Новый пароль</div>
			<div class="profily__value"><input type="text" name="new_phone" value=""></div>
		</div>
		<?php if (!empty($erroMessagePhone)) : ?>
			<div class="err"><?= $erroMessagePhone; ?></div>
		<?php endif ?>
		<?php if (!empty($successMessPhone)) : ?>
			<div class="success"><?= $successMessPhone; ?></div>
		<?php endif ?>
		<button type="submit" name="change_phone">Изменить номер</button>
	</div>
</form>