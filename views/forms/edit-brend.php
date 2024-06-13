<?php $brend = selectOne('brends', ['id' => $user['brend_id']]) ?>

<form action="" method="post" class="profily__item">
	<input type="hidden" name="id" value="<?= $brend['id'] ?>">
	<h2 class="profily__title">Данные бренда</h2>
	<div class="profily__wrap">
		<div class="profily__label">
			<div class="profily__key">Наименование</div>
			<div class="profily__value"><input type="text" name="name" value="<?= $brend['name'] ?>"></div>
		</div>
		<div class="profily__label">
			<div class="profily__key">Адресс</div>
			<div class="profily__value"><input type="text" name="adress" value="<?= $brend['adress'] ?>"></div>
		</div>
		<div class="profily__label">
			<div class="profily__key">Телефон</div>
			<div class="profily__value"><input type="text" name="phone" value="<?= $brend['phone'] ?>"></div>
		</div>
    <div class="profily__label">
      <div class="profily__key">Онлайн-запись:</div>
      <div class="profily__value"><input disabled value="<?= BASE_URL . 'online-booking.php?SELECTED=EMPLOYEES&ID_BREND=' .  $brend['id'] ?>"></div>
    </div>
		<?php if (!empty($erroMessageBrend)) : ?>
			<div class="err"><?= $erroMessageBrend; ?></div>
		<?php endif ?>
		<?php if (!empty($successMessBrend)) : ?>
			<div class="success"><?= $successMessBrend; ?></div>
		<?php endif ?>
		<button type="submit" name="edit_brend">Сохранить</button>
	</div>
</form>