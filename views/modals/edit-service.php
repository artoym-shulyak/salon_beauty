<div class="modal _edit-service" id="modal-edit-service">
	<div class="modal__body">
		<div class="modal__close" data-close><img src="assets/img/icon-close.png" alt=""></div>
		<div class="modal__title">Редактирование услуги</div>
		<form action="" method="post">
			<input type="hidden" name="id_service" value="">
      <input type="hidden" name="id_brend" value="<?= $user['brend_id'] ?>">
			<div class="modal__items">
				<div class="modal__item">
					<input type="text" name="duration_service" placeholder="Длительность услуги в минутах" value="">
				</div>
				<div class="modal__item">
					<input type="text" name="price_service" placeholder="Цену услуги" value="">
				</div>
			</div>
			<?php if (!empty($fieldsEditService['fields'])) : ?>
				<div class="err"><?= $fieldsEditService['fields']; ?></div>
				<input type="hidden" id="formErrorEditService" value="true">
			<?php endif ?>
			<button type="submit" name="edit_service">Сохранить</button>
		</form>
	</div>
</div>