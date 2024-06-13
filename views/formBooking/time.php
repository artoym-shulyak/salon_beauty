<?php if ($_GET['SELECTED'] === 'TIME') : ?>
	<div class="booking__time">
    <a href="<?= BASE_URL . 'online-booking.php?SELECTED=SERVICES' ?> " class="booking__e-title"><img src="assets/img/icon-p.png" alt="">Выбрать дату</a>
		<div class="panel__arrows">
			<a href="<?= BASE_URL . 'online-booking.php?SELECTED=TIME&date=' . $currentDate . ' -7 days' . '&employee_id=' . $_SESSION['ID_EMPLOYEE']?>" class="panel__prev">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12.5 16.25L6.25 10L12.5 3.75" stroke="black" stroke-width="1.5" stroke-linecap="square" />
				</svg>
			</a>
			<div class="panel__date">
				<span style="font-size: 0;"><?= $currentDate ?></span>
				<?= strftime('%d.%m', strtotime($currentDate)); ?> -
				<?= strftime('%d.%m', strtotime($end_date)); ?>
			</div>
			<a href="<?= BASE_URL . 'online-booking.php?SELECTED=TIME&date=' . $currentDate . ' +7 days' . '&employee_id=' . $_SESSION['ID_EMPLOYEE'] . '&brend=' . $brend['name'] ?>" class="panel__next">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M7.5 3.75L13.75 10L7.5 16.25" stroke="black" stroke-width="1.5" stroke-linecap="square" />
				</svg>
			</a>
		</div>
    <?php foreach ($schedules as $index => $entry) : ?>
        <?php if ($index === 0 || $entry['work_date'] !== $schedules[$index - 1]['work_date']) : ?>
            <div class="panel__view">
                <div class="panel__workDay">
                    <?php
                    $months = [
                        '01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля',
                        '05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
                        '09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'
                    ];
                    $day = date('d', strtotime($entry['work_date']));
                    $month = date('m', strtotime($entry['work_date']));

                    echo $day . ' ' . $months[$month];
                    ?>
                </div>
                <div class="panel__workDates">
                    <?php $appointments = getAppointments($_SESSION['ID_EMPLOYEE'], $entry['work_date']); ?>
                    <?php foreach ($appointments as $appointment) : ?>
                        <?php
                        $appointmentDateTime = strtotime($appointment['appointment_time']);
                        $currentDateTime = strtotime('now');

                        if ($appointmentDateTime > $currentDateTime) :
                        ?>
                            <a href="<?= BASE_URL . 'online-booking.php?SELECTED=RESULT&id_appointment=' . $appointment['id'] ?>" class="panel__work-i-date">
                                <span work-time><?= date('H:i', strtotime($appointment['appointment_time'])); ?></span>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
	</div>
<?php endif ?>