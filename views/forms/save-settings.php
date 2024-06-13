<form action="" method="post" class="profily__item">
	<input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
	<h2 class="profily__title">Изменить данные</h2>
	<div class="profily__wrap">
		<div class="profily__label">
			<div class="profily__key">Имя</div>
			<div class="profily__value"><input type="text" name="name" value="<?= $user['name'] ?>"></div>
		</div>
		<div class="profily__label">
			<div class="profily__key">Информация о себе</div>
			<div class="profily__value"><textarea name="description"><?= $user['description'] ?></textarea></div>
		</div>
		<?php if (!empty($erroMessageData)) : ?>
			<div class="err"><?= $erroMessageData; ?></div>
		<?php endif ?>
		<?php if (!empty($successMessDate)) : ?>
			<div class="success"><?= $successMessDate; ?></div>
		<?php endif ?>
		<button type="submit" name="change_data">Сохранить</button>
	</div>
</form>