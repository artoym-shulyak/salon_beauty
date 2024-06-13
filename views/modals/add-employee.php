
<div class="modal _add-employee" id="modal-add-employee">
	<div class="modal__body">
		<div class="modal__close" data-close><img src="assets/img/icon-close.png" alt=""></div>
		<div class="modal__title">Добавление сотрудника</div>
		<form action="" method="post">
			<div class="modal__items">
				<div class="modal__item">
					<input type="text" name="name_employee" placeholder="Введите имя сотрудника" value="<?= $_SESSION['name_employee']; ?>">
				</div>
				<div class="modal__item">
          <?php $brendPositions = getBrandPositions($user['brend_id']); ?>
					<select class="modal__select" name="position_employee" style="margin-bottom: 0px;">
            <?php foreach ($brendPositions as $brendPosition) : ?>
                <option value="<?= $brendPosition['id'] ?>"><?= $brendPosition['name'] ?></option>
            <?php endforeach; ?>
					</select>
				</div>
				<div class="modal__item">
					<input type="text" name="email_employee" placeholder="Введите почту сотрудника" value="<?= $_SESSION['email_employee']; ?>">
				</div>
				<div class="modal__item">
					<input type="text" name="phone_employee" placeholder="Введите телефон сотрудника" value="<?= $_SESSION['phone_employee']; ?>">
				</div>
				<div class="modal__item">
					<input type="text" name="password_employee" placeholder="Пароль сотрудника" value="<?= $_SESSION['password_employee']; ?>">
				</div>
				<div class="modal__item">
					<textarea name="description_employee" placeholder="Информация сотрудника"><?= $_SESSION['description_employee']; ?></textarea>
				</div>
			</div>
			<?php if (!empty($fieldsAddEmployees['fields'])) : ?>
				<div class="err"><?= $fieldsAddEmployees['fields']; ?></div>
				<input type="hidden" id="formError" value="true">
			<?php endif ?>
			<button type="submit" name="add_employee">Добавить</button>
		</form>
	</div>
</div>