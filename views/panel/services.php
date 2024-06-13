<div class="panel__body">
	<div class="panel__head">
		<h2 class="panel__title">Услуги</h2>
		<?php if ($user['position_id'] == 4) : ?>
			<div class="panel__add-schedule" id="btn-add-service"><img src="assets/img/icon-services.png" alt="">Добавить услугу</div>
			<div class="panel__box">
				<div class="panel__value">
					<span>
						<?php
						if (!empty($_GET['sort'])) {
							echo $_GET['sort'];
						} else {
							echo 'Все услуги';
						}
						?>

					</span>
				</div>
				<div class="panel__lead">
					<ul>
            <a href="<?= BASE_URL . 'admin-services.php?sort='?>" <?php if ($_GET['sort'] === '') : ?>class="active" <?php endif; ?>>Все</a>
            <?php foreach ($allServices as $service) : ?>
              <a href="<?= BASE_URL . 'admin-services.php?sort=' . $service['type'] ?>" <?php if ($_GET['sort'] === $service['type']) : ?>class="active" <?php endif; ?>><?= $service['type'] ?></a>
            <?php endforeach; ?>
					</ul>
				</div>
			</div>
		<?php endif ?>
	</div>
	<div class="panel__emplyees">
    <?php if ($user['position_id'] == 4) : ?>
  		<?php foreach ($servicesBrends as $service) : ?>
  			<li>
  				<div class="panel__header">
  					<div class="panel__author">
  						<img style="height: 20px; weight: 20px;" src="assets/img/icon-services.png" alt="">
  						<span><?= $service['name'] ?></span>
  						<span><?= $service['price'] ?> BYN</span>
  						<span><?= $service['duration'] ?>м.</span>
  						<div class="panel__post">( <?= $service['type'] ?>) </div>
  					</div>
  						<a href="#" class="panel__empls" style="margin-left: auto;"><img src="assets/img/icon-employees.png" alt=""></a>
  						<a href="#" id="btn-edit-service" class="panel__edit edit-btn" data-id="<?= $service['id'] ?>" data-duration="<?= htmlspecialchars($service['duration']); ?>" data-price="<?= htmlspecialchars($service['price']); ?>"><img src=" assets/img/icon-edit.png" alt=""></a>
  						<a href="<?= BASE_URL . 'admin-services.php?del_service_id=' . $service['id'] . '&brend_id=' . $user['brend_id'] . '&sort=' . $_GET['sort'] ?>" class="panel__delete"><img src="assets/img/trash.png" alt=""></a>
  				</div>
  				<div class="panel__list">
  					<div class="panel__l-title">
  						<img src="assets/img/icon-employees.png" alt="">
  						<span>Сотрудники</span>
  						<a href="#" data-id="<?= $service['id'] ?>" class="panel__ser-emp-add add-btn"><img src="assets/img/icon-add.png" alt=""></a>
  					</div>
  						<?php $employees = getEmployeesByService($service['id']); ?>
  						<?php if (!empty($employees)) : ?>
  							<?php foreach ($employees as $employee) : ?>
  								<div class="panel__l-item">
  									<?= $employee['employee_name'] ?> | <?= $employee['name'] ?>
  									<a href="<?= BASE_URL . 'admin-services.php?del_service_from_emp=' . $employee['service_id'] . '&sort=' . $service['type'] ?>" class="panel__delete"><img src="assets/img/trash.png" alt=""></a>
  								</div>
  							<?php endforeach; ?>
  						<?php else : ?>
  							<span style="color: red;">На данный момент нет сотрудников.</span>
  						<?php endif ?>
  				</div>
  			</li>
        <?php endforeach; ?>
     <?php else: ?>
      <?php $servicesEmployee = getServicesByEmployee($_SESSION['id']); ?>
        <?php foreach ($servicesEmployee as $service) : ?>
          <div class="panel__l-item">
            <?= $service['name'] ?>
            <span>|</span>
            (<?= $service['type'] ?>)
             <span>|</span>
            <?= $service['duration'] . 'м.'?>
             <span>|</span>
            <?= $service['price'] . ' ' . 'BYN' ?> BYN
          </div>
        <?php endforeach; ?>
    <?php endif ?>
	</div>
</div>
</div>