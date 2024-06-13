<div class="modal _add-schedule" id="modal-add-schedule">
	<div class="modal__body">
		<div class="modal__close" data-close><img src="assets/img/icon-close.png" alt=""></div>
		<div class="modal__title">Добавление расписание сотруднику</div>
		<form action="" method="post">
			<input type="hidden" name="id_employee" value="<?= $employee['id']; ?>">
			<input type="hidden" name="start" value="<?= $start_date; ?>">
			<input type="hidden" name="end" value="<?= $end_date; ?>">
			<div class="modal__items">
				<div class="modal__lead">Выберите дату:</div>
				<div class="modal__days">
					<div class="modal__item">
						<input type="date" name="date_start">
					</div>
					<span>-</span>
					<div class="modal__item">
						<input type="date" name="date_end">
					</div>
				</div>
				<div class="modal__lead">Выберите время:</div>
				<div class="modal__days">
					<div class="modal__item">
						<input type="time" name="time_start">
					</div>
					<span>-</span>
					<div class="modal__item">
						<input type="time" name="time_end">
					</div>
				</div>
				<div class="modal__lead">Выберите интервал:</div>
				<div class="modal__item" style=" width: 100px; margin-right: auto;">
					<input type="text" name="interval_time">
				</div>
				<?php if (!empty($fieldsAddSchedule)) : ?>
					<div style="margin-top: 20px;" class="err"><?= $fieldsAddSchedule; ?></div>
					<input type="hidden" id="formErrorAddSchedule" value="true">
				<?php endif ?>
				<button type="submit" name="add_schedule">Добавить</button>
		</form>
	</div>
</div>