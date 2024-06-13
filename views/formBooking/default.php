<?php if (empty($window)) : ?>
	<div class="booking__body">
		<a href="<?= BASE_URL . 'online-booking.php?window=employees&brend=' . $brend['name'] ?>" class="booking__item"><img src="assets/img/icon-employees.png" alt=""> <span>Выбрать специалиста</span><img class="booking__icon" src="assets/img/icon-next.svg" alt=""></a>
	</div>
<?php endif ?>