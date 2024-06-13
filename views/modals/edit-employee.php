

<div class="modal _edit-employee" id="modal-edit-employee">
	<div class="modal__body">
		<div class="modal__close" data-close><img src="assets/img/icon-close.png" alt=""></div>
		<div class="modal__title">Редактирование сотрудника</div>
		<form action="" method="post">
			<div class="modal__items">
				<input type="hidden" name="id_employee" value="<?= $_SESSION['id_employee']; ?>">
				<div class="modal__item">
					<input type="text" name="name_employee" placeholder="Имя сотрудника" value="<?= $_SESSION['name_employee']; ?>">
				</div>
<!--         <div class="modal__item">
          <?php $brendPositions = getBrandPositions($user['brend_id']); ?>
          <select class="modal__select" name="position_employee" style="margin-bottom: 0px;">
            <?php foreach ($brendPositions as $brendPosition) : ?>
              <option value="<?= $brendPosition['id'] ?>"><?= $brendPosition['name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div> -->
				<div class="modal__item">
					<input type="text" name="email_employee" placeholder="Почта сотрудника" value="<?= $_SESSION['email_employee']; ?>">
				</div>
				<div class="modal__item">
					<input type="text" name="phone_employee" placeholder="Телефон сотрудника" value="<?= $_SESSION['phone_employee']; ?>">
				</div>
				<div class="modal__item">
					<textarea name="description_employee"><?= $_SESSION['description_employee']; ?></textarea>
				</div>
			</div>
			<?php if (!empty($fieldsEditEmployee['fields'])) : ?>
				<div class="err"><?= $fieldsEditEmployee['fields']; ?></div>
				<input type="hidden" id="formErrorEditEmployee" value="true">
			<?php endif ?>
			<button type="submit" name="edit_employee">Сохранить</button>
		</form>
	</div>
</div>