<?php if ($_GET['SELECTED'] === 'RESULT') : ?>
	<?php
	// Получение данных сотрудника по ID
	function getEmployeeById($employee_id)
	{
		global $pdo;

		$sql = "SELECT * FROM employees WHERE id = :employee_id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// Получение данных услуги по ID
	function getServiceById($service_id)
	{
		global $pdo;

		$sql = "SELECT * FROM services WHERE id = :service_id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// Получение данных записи по ID
	function getAppointmentById($appointment_id)
	{
		global $pdo;

		$sql = "SELECT * FROM appointments WHERE id = :appointment_id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':appointment_id', $appointment_id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}



	// Получение данных
	$id_employee = $_SESSION['ID_EMPLOYEE'];
	$id_service = $_SESSION['ID_SERVICE'];
	$id_appointment = $_GET['id_appointment'];

	$employee = getEmployeeById($id_employee);
	$service = getServiceById($id_service);
	$appointment = getAppointmentById($id_appointment);
	?>
	<div class="booking__result result">
		<?php if (!empty($successBooking)) : ?>
			<a href="<?= BASE_URL . 'online-booking.php?SELECTED='?>" class="result__back"><img src="assets/img/icon-p.png" alt="">Главная</a>
		<?php else : ?>
			<a href="<?= BASE_URL . 'online-booking.php?SELECTED=TIME' ?>" class="result__back"><img src="assets/img/icon-p.png" alt="">Назад</a>
		<?php endif; ?>

		<div class="result__body">
			<h2 class="result__title">Детали записи</h2>
			<div class="result__employee">
				<div class="result__author"><img src="assets/img/photo.png" alt=""></div>
				<div class="result__info">
					<div class="result__name">
						<?= $employee['name'] ?>
					</div>
				</div>

			</div>
			<div class="result__mode">
				<div class="result__author"><img style="padding: 5px;" src="assets/img/icon-calendar.png" alt=""></div>
				<div class="result__info" style="flex-direction: column;">
					<div class="result__date">
						<?php
						$months = [
							'01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля',
							'05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
							'09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'
						];
						$day = date('d', strtotime($appointment['appointment_date']));
						$month = date('m', strtotime($appointment['appointment_date']));

						echo $day . ' ' . $months[$month];
						?> </div>
					<div class="result__time"><?= date('H:i', strtotime($appointment['appointment_time'])); ?></div>
				</div>
			</div>
			<h2 class="result__title">Услуги</h2>
			<div class="result__services">
				<div class="result__services">
          <div class="result__service">
            <div class="result__name"><?= $resultService['name'] ?></div>
            <div class="result__term"><?= $resultService['duration'] ?>м.</div>
          </div>
				</div>
				<div class="result__footer">
					<div class="result__text">Итого</div>
					<div class="result__price"><?= $resultService['price'] ?> BYN</div>
				</div>
			</div>
			<?php if (!empty($successBooking)) : ?>
				<div class="success _block"><?= $successBooking; ?></div>
			<?php else : ?>
				<form action="#" method="post" class="result__form">
					<div class="result__title">Ваши данные</div>
					<div class="result__item">
						<input type="text" placeholder="Введите имя" name="client_name" <?= isset($user['name']) ? 'style="pointer-events: none;"' : ''; ?> value="<?= isset($user['name']) ? $user['name'] : ''; ?>" required>
					</div>
					<div class="result__item">
						<input type="text" placeholder="Введите телефон" name="client_phone" <?= isset($user['phone']) ? 'style="pointer-events: none;"' : ''; ?> value="<?= isset($user['phone']) ? $user['phone'] : ''; ?>" required>
					</div>
					<div class=" result__item">
						<input type="text" placeholder="Введите email" name="client_email" <?= isset($user['email']) ? 'style="pointer-events: none;"' : ''; ?> value="<?= isset($user['email']) ? $user['email'] : ''; ?>" required>
					</div>
					<input type="hidden" name="employee_id" value="<?= $employee['id']; ?>">
					<input type="hidden" name="id_client" value="<?= $client['id'] ? $client['id'] : 1 ?>">
					<input type="hidden" name="id_service" value="<?= $service['id']; ?>">
					<input type="hidden" name="booking_date" value="<?= $appointment['appointment_date']; ?>">
					<input type="hidden" name="booking_time" value="<?= $appointment['appointment_time']; ?>">
					<input type="hidden" name="appointment_id" value="<?= $appointment['id']; ?>">
					<button class="result__online" name="booking">Записаться</button>
				</form>
			<?php endif; ?>
		</div>
	<?php endif ?>