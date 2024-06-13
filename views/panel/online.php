<div class="panel__body">
	<div class="panel__head">
		<h2 class="panel__title">Онлайн-записи</h2>
    <?php if ($user['position_id'] == 5) :?>
      <div class="panel__arrows">
        <a href="<?= BASE_URL . 'admin-online.php?date=' . $currentDate . ' -7 days' . '&employee_id=' . $_SESSION['id'] ?>" class="panel__prev">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.5 16.25L6.25 10L12.5 3.75" stroke="black" stroke-width="1.5" stroke-linecap="square" />
          </svg>
        </a>
        <div class="panel__date">
          <?= strftime('%d.%m', strtotime($currentDate)); ?>
          <span>-</span>
          <?= strftime('%d.%m', strtotime($end_date)); ?>
        </div>
        <a href="<?= BASE_URL . 'admin-online.php?date=' . $currentDate . ' +7 days' . '&employee_id=' . $_SESSION['id'] ?>" class="panel__next">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.5 3.75L13.75 10L7.5 16.25" stroke="black" stroke-width="1.5" stroke-linecap="square" />
          </svg>
        </a>
      </div>
    <?php else: ?>
      <div class="panel__arrows">
        <a href="<?= BASE_URL . 'admin-online.php?date=' . $currentDate . ' -1 days' . '&employee_id=' . $_SESSION['id'] ?>" class="panel__prev">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.5 16.25L6.25 10L12.5 3.75" stroke="black" stroke-width="1.5" stroke-linecap="square" />
          </svg>
        </a>
        <div class="panel__date">
          <?= strftime('%d.%m', strtotime($currentDate)); ?>
        </div>
        <a href="<?= BASE_URL . 'admin-online.php?date=' . $currentDate . ' +1 days' . '&employee_id=' . $_SESSION['id'] ?>" class="panel__next">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.5 3.75L13.75 10L7.5 16.25" stroke="black" stroke-width="1.5" stroke-linecap="square" />
          </svg>
        </a>
      </div>
    <?php endif ?>

	</div>
	<div class="panel__emplyees">
		<?php
		if ($user['position_id'] == 5) {
			$bookings = getOnlineBookingsClients($_SESSION['id'], $start_date, $end_date, $order_by, $order_dir);
		} else {
			$bookings = getOnlineBookingsForDay($_SESSION['id'], $currentDate);
		}
		?>
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
                  <?php if ($user['position_id'] == 5) : ?>
                      <?= htmlspecialchars($booking['employee_name']); ?>
                  <?php else : ?>
                      <?= htmlspecialchars($booking['client_name']); ?>
                  <?php endif ?>
                  <span>|</span>
                  <?= htmlspecialchars($booking['service_name']); ?>
                  <span>|</span>
                  <div class="panel__online-i-time"><?= date('d.m.Y', strtotime($booking['booking_date'])); ?></div>
                  <span>|</span>
                  <div class="panel__online-i-time"><?= $booking['service_duration'] ?>м.</div>
                  <span>|</span>
                  <div class="panel__online-i-time"><?= $booking['service_price'] . ' ' . 'BYN' ?></div>
                  <span>|</span>
                  <div class="panel__online-i-time"><span><?= date('H:i', strtotime($booking['booking_time'])); ?></span></div>
                  <span>|</span>
                  <?php if ($user['position_id'] == 5) : ?>
                      <?php if ($booking['status'] === 'pending') : ?>
                          <div class="panel__wait" style="opacity: 1;">В ОЖИДАНИИ</div>
                      <?php else : ?>
                          <?php if ($booking['status'] === 'confirmed') : ?>
                              <div class="panel__take" style="opacity: 1;">ПРИНЯТО</div>
                          <?php endif; ?>
                          <?php if ($booking['status'] === 'cancelled') : ?>
                              <div class="panel__deny" style="opacity: 1;">ОТКЛОНЕНО</div>
                          <?php endif; ?>
                      <?php endif; ?>
                  <?php else : ?>
                      <?php if ($booking['status'] === 'pending') : ?>
                          <a href="<?= BASE_URL . 'admin-online.php?take_online=' . $booking['booking_id'] . '&date=' . $currentDate?>" class="panel__take">ПРИНЯТЬ</a>
                          <a href="<?= BASE_URL . 'admin-online.php?deny_online=' . $booking['booking_id'] . '&date=' . $currentDate?>" class="panel__deny">ОТМЕНИТЬ</a>
                      <?php else : ?>
                          <?php if ($booking['status'] === 'confirmed') : ?>
                              <div class="panel__take" style="opacity: 1;">ПРИНЯТО</div>
                          <?php endif; ?>
                          <?php if ($booking['status'] === 'cancelled') : ?>
                              <div class="panel__deny" style="opacity: 1;">ОТКАЗАНО</div>
                          <?php endif; ?>
                      <?php endif; ?>
                  <?php endif; ?>
              </div>
          <?php endif; ?>
      <?php endforeach; ?>
		<?php else : ?>
			<span style="color: red;">На данный момент нет записей.</span>
		<?php endif; ?>
	</div>
</div>