<div class="panel__body">
	<div class="panel__head">
		<h2 class="panel__title">Личный кабинет</h2>
		<a href="<?= BASE_URL . 'controllers/forms/logout.php'; ?>" class="panel__logout">Выйти</a>
	</div>
	<div class="panel__profily profily">
		<div class="profily__data">
			<h2 class="profily__title">Личные данные</h2>
			<div class="profily__wrap">
				<div class="profily__photo"><img src="assets/img/photo.png" alt=""></div>
				<div class="profily__info">
					<h3 class="profily__name"><?= $user['name'] ?></h3>

          <?php if($user['position_id'] != 5): ?>
						<h3 class="profily__name">Специальность: <?= $user['position_name'] ?></h3>
						<h3 class="profily__name">Филиал: <?= $user['brend_name'] ?></h3>
          <?php endif ?>
					<div class="profily__phone"><img src="assets/img/icon-phone.png" alt=""><?= $user['phone'] ?></div>
					<div class="profily__mail"><img src="assets/img/icon-mail.svg" alt=""><?= $user['email'] ?></div>
				</div>
			</div>
		</div>
		<div class="profily__settings">
			<?php include_once 'views/forms/save-settings.php'; ?>
			<?php include_once 'views/forms/change-password.php'; ?>
			<?php include_once 'views/forms/change-phone.php'; ?>
			<?php include_once 'views/forms/change-email.php'; ?>
			<?php include_once 'views/forms/delete-account.php'; ?>
		</div>
	</div>
</div>
</div>