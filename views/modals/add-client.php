<div class="modal _add-client" id="modal-add-client">
	<div class="modal__body">
		<div class="modal__close" data-close><img src="assets/img/icon-close.png" alt=""></div>
		<div class="modal__title">Добавление сотрудника</div>
		<form action="" method="post">
			<div class="modal__items">
				<div class="modal__item">
					<input type="text" name="name_client" placeholder="Введите имя клиента" value="<?= $_SESSION['name_client']; ?>">
				</div>
				<div class="modal__item">
					<input type="text" name="email_client" placeholder="Введите почту клиента" value="<?= $_SESSION['email_client']; ?>">
				</div>
				<div class="modal__item">
					<input type="text" name="phone_client" placeholder="Введите телефон клиента" value="<?= $_SESSION['phone_client']; ?>">
				</div>
				<!-- <div class="modal__item">
					<input type="text" name="password_client" placeholder="Введите пароль сотрудника">
				</div> -->
			</div>
			<?php if (!empty($fieldsAddClient['fields'])) : ?>
				<div class="err"><?= $fieldsAddClient['fields']; ?></div>
				<input type="hidden" id="formErrorAddClient" value="true">
			<?php endif ?>
			<button type="submit" name="add_client">Добавить</button>
		</form>
	</div>
</div>