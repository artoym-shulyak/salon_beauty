<?php if ($_GET['SELECTED'] === 'EMPLOYEES') : ?>
	<div class="booking__employees">
		<a href="<?= BASE_URL . 'online-booking.php?SELECTED=' ?>" class="booking__e-title">
    <img src="assets/img/icon-p.png" alt="">
    <span>Выбрать специалиста</span>
  </a>
		<div class="booking__e-employees">
			<?php foreach ($brendEmployees as $employee) : ?>
        <?php if($employee['position_id'] != 4): ?>
          <div class="booking__e-employee">
            <div class="booking__athor"><img src="assets/img/photo.png" alt=""></div>
            <div class="booking__e-info">
              <h3 class="booking__e-name"><?= $employee['name'] ?></h3>
              <div class="booking__e-position"><?= $employee['position_name'] ?></div>
            </div>
            <a href="<?= BASE_URL . 'online-booking.php?SELECTED=PAGE&ID=' . $employee['id'] ?>" class="booking__e-page"><img src="assets/img/icon-help.png" alt=""></a>
            <a href="<?= BASE_URL . 'online-booking.php?SELECTED=SERVICES&ID_EMPLOYEE=' . $employee['id']?>" class="booking__btn">Выбрать</a>
          </div>
        <?php endif ?>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif ?>
