<?php if ($_GET['SELECTED'] === 'SERVICES') : ?>
  <div class="booking__employees">
    <a href="<?= BASE_URL . 'online-booking.php?SELECTED=EMPLOYEES'?>" class="booking__e-title"><img src="assets/img/icon-p.png" alt="">Выбрать услуги</a>
    <?php foreach ($servicesEmployee as $service) : ?>
      <div class="booking__e-employee">
        <div class="booking__e-info">
          <h3 class="booking__e-name"><?= $service['name'] ?></h3>
          <div class="booking__e-position"><?= $service['duration'] ?>м</div>
          <div class="booking__e-name"><?= $service['price'] . ' ' . 'BYN' ?></div>
        </div>
        <a href="<?= BASE_URL . 'online-booking.php?SELECTED=TIME&ID_SERVICE=' . $service['id']  ?>" class="booking__btn">Выбрать</a>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif ?>