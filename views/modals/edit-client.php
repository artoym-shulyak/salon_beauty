<div class="modal _edit-client" id="modal-edit-client">
	<div class="modal__body">
		<div class="modal__close" data-close><img src="assets/img/icon-close.png" alt=""></div>
		<div class="modal__title">Редактирование клиента</div>
		<form action="" method="post">
			<div class="modal__items">
				<input type="hidden" name="id_client" value="<?= $_SESSION['id_client']; ?>">
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
					<input type="text" name="password_client" placeholder="Введите пароль клиента">
				</div> -->
			</div>
			<?php if (!empty($fieldsEditClient['fields'])) : ?>
				<div class="err"><?= $fieldsEditClient['fields']; ?></div>
				<input type="hidden" id="formErrorEditClient" value="true">
			<?php endif ?>
			<button type="submit" name="edit_client">Сохранить</button>
		</form>
	</div>
</div>