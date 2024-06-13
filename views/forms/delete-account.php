<form action="" method="post" class="profily__item">
	<input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
	<input type="hidden" name="position" value="<?= $user['position'] ?>">
	<h2 class="profily__title">Управление аккаунтом</h2>
	<div class="profily__wrap">
		<div class="profily__label">
			<div class="profily__key">Удаление аккаунта</div>
			<button type="submit" name="delete_account">Удалить аккаунт</button>
		</div>
	</div>
</form>