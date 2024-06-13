<?php if (empty($_GET['SELECTED'])): ?>
  <div class="booking__employees">
    <div class="booking__e-employees">
      <?php foreach ($brends as $brend) : ?>
        <div class="booking__b-brend">
          <div class="booking__e-info">
            <div class="booking__b-name"><?= $brend['name'] ?></div>
            <div class="booking__b-adress"><?= $brend['adress'] ?></div>
          </div>
          <a href="<?= BASE_URL . 'online-booking.php?SELECTED=EMPLOYEES&ID_BREND=' . $brend['id'] ?>" class="booking__btn">Выбрать</a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif ?> 


