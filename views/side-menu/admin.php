
<div class="panel__sidebar">
  <?php if (!empty($user['brend_name'])): ?>
	<h2 class="panel__topic"><?= $user['brend_name'] ?></h2>
  <?php endif ?>
	<ul class="panel__list">
		<li>
			<a href="<?= BASE_URL . 'admin-employees.php' ?>">
				<img src="assets/img/icon-employees.png" alt="">
				Сотрудники
			</a>
		</li>
		<!-- <li>
			<a href="<?= BASE_URL . 'admin-clients.php' ?>">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12 15C15.3137 15 18 12.3137 18 9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9C6 12.3137 8.68629 15 12 15Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M2.9043 20.2491C3.82638 18.6531 5.15225 17.3278 6.74869 16.4064C8.34513 15.485 10.1559 15 11.9992 15C13.8424 15 15.6532 15.4851 17.2497 16.4065C18.8461 17.3279 20.1719 18.6533 21.094 20.2493" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
				Клиенты
			</a>
		</li> -->
		<!-- <li>
			<a href="<?= BASE_URL . 'admin-online.php' ?>">
				<img src="assets/img/icon-recording.png" alt="">
				Онлайн-записи
			</a>
		</li> -->
		<li>
			<a href="<?= BASE_URL . 'admin-services.php' ?>">
				<img src="assets/img/icon-services.png" alt="">
				Услуги
			</a>
		</li>
		<li>
			<a href="<?= BASE_URL . 'admin-comments.php' ?>">
				<img src="assets/img/icon-comments.png" alt="">
				Отзывы
			</a>
		</li>
    <li>
      <a href="<?= BASE_URL . 'admin-brend.php' ?>">
        <img src="assets/img/icon-recording.png" alt="">
        Бренд
      </a>
    </li>
		<li>
			<a href="<?= BASE_URL . 'personal-account.php' ?>">
				<img src="assets/img/icon-personal.png" alt="">
				Личный кабинет
			</a>
		</li>
		<li>
			<a href="<?= BASE_URL ?>">
				<img src="assets/img/icon-home.gif" alt="">
				САЙТ
			</a>
		</li>
	</ul>
</div>