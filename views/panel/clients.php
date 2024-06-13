<div class="panel__body">
	<div class="panel__head">
		<?php if ($client['name']) : ?>
			<h2 class="panel__title">Расписание | <?= $client['name'] ?></h2>
			<div class="panel__arrows">
				<a href="<?= BASE_URL . 'admin-eclients.php?date=' . $currentDate . ' -7 days' . '&client_id=' . $client['id'] . '&page=admin-clients' ?>" class="panel__prev">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12.5 16.25L6.25 10L12.5 3.75" stroke="black" stroke-width="1.5" stroke-linecap="square" />
					</svg>
				</a>
				<div class="panel__date">
					<span style="font-size: 0;"><?= $currentDate ?></span>
					<?= strftime('%d.%m', strtotime($currentDate)); ?> -
					<?= strftime('%d.%m', strtotime($endDate)); ?>
				</div>
				<a href="<?= BASE_URL . 'admin-eclients.php?date=' . $currentDate . ' +7 days' . '&client_id=' . $client['id'] . '&page=admin-clients' ?>" class="panel__next">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M7.5 3.75L13.75 10L7.5 16.25" stroke="black" stroke-width="1.5" stroke-linecap="square" />
					</svg>
				</a>
			</div>
		<?php else : ?>
			<h2 class="panel__title">Клиенты</h2>
			<div class="panel__add-schedule" id="btn-add-client"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12 15C15.3137 15 18 12.3137 18 9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9C6 12.3137 8.68629 15 12 15Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M2.9043 20.2491C3.82638 18.6531 5.15225 17.3278 6.74869 16.4064C8.34513 15.485 10.1559 15 11.9992 15C13.8424 15 15.6532 15.4851 17.2497 16.4065C18.8461 17.3279 20.1719 18.6533 21.094 20.2493" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				</svg>Добавить клиента</div>
		<?php endif ?>
		<div class="panel__box">
			<div class="panel__value">
				<span>Сортировка</span>
			</div>
			<div class="panel__lead">
				<ul>
					<a href="<?= BASE_URL . 'admin-clients.php?sort=desc' ?>" <?php if ($sortOrder === 'desc') : ?>class="active" <?php endif; ?>>По убыванию(по дате)</a>
					<a href="<?= BASE_URL . 'admin-clients.php?sort=asc' ?>" <?php if ($sortOrder === 'asc') : ?>class="active" <?php endif; ?>>По возрастанию(по дате)</a>
					<a href="<?= BASE_URL . 'admin-clients.php?sort=default' ?>" <?php if ($sortOrder === 'default') : ?>class="active" <?php endif; ?>>По умолчанию</a>
				</ul>
			</div>
		</div>
	</div>
	<div class="panel__emplyees">
		<?php foreach ($clients as $client) : ?>
			<li>
				<div class="panel__header">
					<div class="panel__author">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12 15C15.3137 15 18 12.3137 18 9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9C6 12.3137 8.68629 15 12 15Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
							<path d="M2.9043 20.2491C3.82638 18.6531 5.15225 17.3278 6.74869 16.4064C8.34513 15.485 10.1559 15 11.9992 15C13.8424 15 15.6532 15.4851 17.2497 16.4065C18.8461 17.3279 20.1719 18.6533 21.094 20.2493" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
						<span><?= $client['name'] ?></span>
						<div class="panel__post">(
							<?php
							$date = new DateTime($client['created_at']);
							$formattedDate = $date->format('d.m.Y');
							echo $formattedDate;
							?>
							)</div>
					</div>
					<a target="_blank" href="<?= BASE_URL . 'master-simple.php?category_id=' . $client['id'] ?>" class="panel__page">ПРОФИЛЬ</a>
					<a href="#" class="panel__empls"><img src="assets/img/icon-recording.png" alt=""></a>
					<a href="#" id="btn-edit-client" class="panel__edit edit-btn" data-id="<?= $client['id'] ?>" data-name="<?= htmlspecialchars($client['name']); ?>" data-email="<?= htmlspecialchars($client['email']); ?>" data-phone="<?= htmlspecialchars($client['phone']); ?> "><img src="assets/img/icon-edit.png" alt=""></a>
					<a href="<?= BASE_URL . 'admin-clients.php?del_client_id=' . $client['id'] ?>" class="panel__delete"><img src="assets/img/trash.png" alt=""></a>
				</div>
				<div class="panel__list">
					<div class="panel__l-title">
						<img src="assets/img/icon-recording.png" alt="">
						<span>Онлайн-записи</span>
					</div>
					<?php
					$bookings = getClientOnlineBookings($client['id']);
					?>
					<?php if (!empty($bookings)) : ?>
						<?php foreach ($bookings as $booking) : ?>
							<div class="panel__l-item">
								<?= htmlspecialchars($booking['employee_name']); ?>
								<span>|</span>
								<?= htmlspecialchars($booking['service_name']); ?>
								<span>|</span>
								<div class="panel__online-i-time"><?= date('d.m.Y', strtotime($booking['booking_date'])); ?></div>
								<span>|</span>
								<div class="panel__online-i-time"><span><?= date('H:i', strtotime($booking['booking_time'])); ?></span></div>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<span style="color: red;">На данный момент нет услуг.</span>
					<?php endif ?>
				</div>
			</li>
		<?php endforeach; ?>
	</div>
</div>