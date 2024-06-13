<div class="panel__body">
	<div class="panel__head">

		<?php if ($employee['name']) : ?>
			<h2 class="panel__title">Расписание | <?= $employee['name'] ?></h2>
			<div class="panel__arrows">
				<a href="<?= BASE_URL . 'admin-employees.php?date=' . $currentDate . ' -7 days' . '&employee_id=' . $employee['id'] . '' ?>" class="panel__prev">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12.5 16.25L6.25 10L12.5 3.75" stroke="black" stroke-width="1.5" stroke-linecap="square" />
					</svg>
				</a>
				<div class="panel__date">
					<span style="font-size: 0;"><?= $currentDate ?></span>
					<?= strftime('%d.%m', strtotime($currentDate)); ?> -
					<?= strftime('%d.%m', strtotime($end_date)); ?>
				</div>
				<a href="<?= BASE_URL . 'admin-employees.php?date=' . $currentDate . ' +7 days' . '&employee_id=' . $employee['id'] . '' ?>" class="panel__next">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M7.5 3.75L13.75 10L7.5 16.25" stroke="black" stroke-width="1.5" stroke-linecap="square" />
					</svg>
				</a>
			</div>
			<div class="panel__add-schedule" id="btn-add-schedule"><img src="assets/img/icon-calendar.png" alt=""> Добавить расписание</div>
		<?php else : ?>
			<h2 class="panel__title">Сотрудники</h2>
			<div class="panel__add-schedule" id="btn-add-employee"><img src="assets/img/icon-employees.png" alt=""> Добавить сотрудника</div>
		<?php endif ?>
		<?= $_GET['position'] ?>
		<div class="panel__box">
			<div class="panel__value">
				<span>
					<?php
					if (!empty($_GET['position_id'])) {
						echo $_GET['position_name'];
					} else {
						echo 'Все должности';
					}
					?></span>
			</div>
			<div class="panel__lead">
				<ul>
					<a href="<?= BASE_URL . 'admin-employees.php?position=' ?>">Все должности</a>
          <?php $brendPositions = getBrandPositions($user['brend_id']); ?>
          <?php if (!empty($brendPositions)) : ?>
            <?php foreach ($brendPositions as $brendPosition) : ?>
              <a href="<?= BASE_URL . 'admin-employees.php?position_id=' . $brendPosition['id'] . '&position_name=' . $brendPosition['name'] ?>"><?= $brendPosition['name'] ?></a>
            <?php endforeach; ?>
          <?php else : ?>
            Отсутствуют должности
          <?php endif ?>
				</ul>
			</div>
		</div>
	</div>
	<?php if ($employee['name']) : ?>
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
							<a href="<?= BASE_URL . 'admin-employees.php?del_schedule=' . $employee['id'] . '&del_date=' .  $entry['work_date'] . '&start_date=' . $currentDate . '&end_date=' . $end_date ?>" class="panel__delete" style="margin-left: auto;"><img src="assets/img/trash.png" alt=""></a>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<div class="panel__emplyees">
				<?php foreach ($employees as $employee) : ?>
						<li>
							<div class="panel__header">
								<div class="panel__author">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M12 15C15.3137 15 18 12.3137 18 9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9C6 12.3137 8.68629 15 12 15Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M2.9043 20.2491C3.82638 18.6531 5.15225 17.3278 6.74869 16.4064C8.34513 15.485 10.1559 15 11.9992 15C13.8424 15 15.6532 15.4851 17.2497 16.4065C18.8461 17.3279 20.1719 18.6533 21.094 20.2493" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
									<span><?= $employee['name'] ?></span>
									<div class="panel__post">(<?= $employee['position_name'] ?>)</div>
								</div>
								<a href="#" class="panel__empls" style="margin-left: auto; display: block;"><img src="assets/img/icon-services.png" alt=""></a>
								<a href="#" class="panel__recds"><img src="assets/img/icon-recording.png" alt=""></a>
								<a href="<?= BASE_URL . 'admin-employees.php?employee_id=' . $employee['id'] ?>" class="panel__edit-schedule"><img src="assets/img/icon-calendar.png" alt=""></a>
								<a href="#" id="btn-edit-employee" class="panel__edit edit-btn" data-id="<?= $employee['id']; ?>" data-name="<?= htmlspecialchars($employee['name']); ?>" data-position="<?= htmlspecialchars($employee['position_id']); ?>" data-email="<?= htmlspecialchars($employee['email']); ?>" data-phone="<?= htmlspecialchars($employee['phone']); ?>"  data-description="<?= htmlspecialchars($employee['description']); ?>"><img src="assets/img/icon-edit.png" alt=""></a>
								<a href="<?= BASE_URL . 'admin-employees.php?del_emp_id=' . $employee['id'] ?>" class="panel__delete"><img src="assets/img/trash.png" alt=""></a>
							</div>
							 <?php $bookings = getOnlineBookingsEmployees($employee['id'], $start_date, $end_date, $order_by, $order_dir); ;?> 
							<div class="panel__list-recording">
								<div class="panel__l-title">
									<img src="assets/img/icon-recording.png" alt="">
									<span>Онлйн-записи</span>
								</div>
<?php if (!empty($bookings)) : ?>
    <?php foreach ($bookings as $booking) : ?>
        <?php
        // Получаем текущие дату и время
        $currentDateTime = strtotime('now');
        $bookingDateTime = strtotime($booking['booking_date'] . ' ' . $booking['booking_time']);

        // Проверяем, если время записи позже текущего времени
        if ($bookingDateTime > $currentDateTime) :
        ?>
            <div class="panel__l-item">
                <?= htmlspecialchars($booking['client_name']); ?>
                <span>|</span>
                <?= htmlspecialchars($booking['service_name']); ?>
                <span>|</span>
                <div class="panel__online-i-time"><?= $booking['service_duration'] ?>м.</div>
                <span>|</span>
                <div class="panel__online-i-time"><?= $booking['service_price'] . ' ' . 'BYN' ?></div>
                <div class="panel__online-i-time"><?= date('d.m.Y', strtotime($booking['booking_date'])); ?></div>
                <span>|</span>
                <div class="panel__online-i-time"><span><?= date('H:i', strtotime($booking['booking_time'])); ?></span></div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else : ?>
    <span style="color: red;">На данный момент нет клиентов на записи.</span>
<?php endif; ?>

							</div>
							<div class="panel__list">
								<div class="panel__l-title">
									<img src="assets/img/icon-services.png" alt="">
									<span>Услуги</span>
								</div>
								<?php
								$services = getServicesByEmployee($employee['id']);
								?>
								<?php if (!empty($services)) : ?>
									<?php foreach ($services as $service) : ?>
										<div class="panel__l-item">
											<?= $service['name'] ?>
											<a href="<?= BASE_URL . 'admin-employees.php?del_service_from_emp=' . $service['id'] ?>" class="panel__delete"><img src="assets/img/trash.png" alt=""></a>
										</div>
									<?php endforeach; ?>
								<?php else : ?>
									<span style="color: red;">На данный момент нет услуг.</span>
								<?php endif ?>
							</div>
						</li>
				<?php endforeach; ?>
			</div>
		<?php endif ?>
		</div>
</div>