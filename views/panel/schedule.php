<div class="panel__body">
	<div class="panel__head">
		<h2 class="panel__title">Расписание</h2>
		<div class="panel__arrows">
			<a href="<?= BASE_URL . 'admin-schedule.php?date=' . $currentDate . ' -7 days' . '&employee_id=' . $employee['id'] . '' ?>" class="panel__prev">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12.5 16.25L6.25 10L12.5 3.75" stroke="black" stroke-width="1.5" stroke-linecap="square" />
				</svg>
			</a>
			<div class="panel__date">
				<span style="font-size: 0;"><?= $currentDate ?></span>
				<?= strftime('%d.%m', strtotime($currentDate)); ?> -
				<?= strftime('%d.%m', strtotime($end_date)); ?>
			</div>
			<a href="<?= BASE_URL . 'admin-schedule.php?date=' . $currentDate . ' +7 days' . '&employee_id=' . $employee['id'] . '' ?>" class="panel__next">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M7.5 3.75L13.75 10L7.5 16.25" stroke="black" stroke-width="1.5" stroke-linecap="square" />
				</svg>
			</a>
		</div>
	</div>
	<div class="panel__workList">
		<div class="panel__workHead">
			<span>Дата</span>
			<span>Рабочее время</span>
			<span>Записи</span>
		</div>
		<div class="panel__workItem">
			<?php foreach ($schedules as $index => $entry) : ?>
				<?php if ($index === 0 || $entry['work_date'] !== $schedules[$index - 1]['work_date']) : ?>
					<div class="panel__view">
						<div class="panel__workDay"><?= date('d.m.Y', strtotime($entry['work_date'])); ?></div>
						<div class="panel__workDate">
							<span work-time><?= date('H:i', strtotime($entry['start_time'])); ?></span> -
							<span work-time><?= date('H:i', strtotime($entry['end_time'])); ?></span>
						</div>
						<div class="panel__workDates">
							<?php $appointments = getAppointments($employee['id'], $entry['work_date']); ?>
							<?php foreach ($appointments as $appointment) : ?>
								<div class="panel__work-i-date">
									<span work-time><?= date('H:i', strtotime($appointment['appointment_time'])); ?></span>
								</div>
							<?php endforeach; ?>
						</div>
            <?php if ($user['position_id'] == 4): ?>
						<a href="<?= BASE_URL . 'admin-employees.php?del_schedule=' . $employee['id'] . '&del_date=' .  $entry['work_date'] . '&start_date=' . $currentDate . '&end_date=' . $end_date ?>" class="panel__delete" style="margin-left: auto;"><img src="assets/img/trash.png" alt=""></a>
            <?php endif; ?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>