<form action="" method="post" class="profily__item">
	<input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
	<input type="hidden" name="position" value="<?= $user['position'] ?>">
	<h2 class="profily__title">Изменить Email</h2>
	<div class="profily__wrap">
		<div class="profily__label">
			<div class="profily__key">Текущий Email</div>
			<div class="profily__value" style="pointer-events: none;"><input type="text" name="old_email" value="<?= $user['email'] ?>"></div>
		</div>
		<div class="profily__label">
			<div class="profily__key">Новый Email</div>
			<div class="profily__value"><input type="text" name="new_email" value=""></div>
		</div>
		<?php if (!empty($erroMessageEmail)) : ?>
			<div class="err"><?= $erroMessageEmail; ?></div>
		<?php endif ?>
		<?php if (!empty($successMessEmail)) : ?>
			<div class="success"><?= $successMessEmail; ?></div>
		<?php endif ?>
		<button type="submit" name="change_email">Изменить Email</button>
	</div>
</form>