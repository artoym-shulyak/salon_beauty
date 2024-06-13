<?php
$employees = selectAll('employees', ['brend_id' => $user['brend_id']])
?>

<div class="modal _employee_to_service" id="modal-emp-to-service">
	<div class="modal__body">
		<div class="modal__close" data-close><img src="assets/img/icon-close.png" alt=""></div>
		<div class="modal__title">Добавление сотрудника к услуге</div>
		<form action="" method="post">
			<input type="hidden" name="id_service" value="">
			<select class="modal__select" name="employee">
				<option disabled>Выберите сотрудника:</option>
				<?php foreach ($employees as $employee) : ?>
					<option value="<?= $employee['id'] ?>"><?= $employee['name'] ?></option>
				<?php endforeach; ?>
			</select>
			<button type="submit" name="emp_to_service">Добавить</button>
		</form>
	</div>
</div>