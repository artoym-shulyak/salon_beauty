<div class="panel__body">
	<div class="panel__head">
		<h2 class="panel__title">Отзывы</h2>
		<?php if ($user['position_id'] == 4) : ?>
			<div class="panel__box">
				<div class="panel__value">
					<span><?php
						if (!empty($_GET['sort'])) {
							echo $_GET['sort'];
						} else {
							echo 'Все';
						}
						?></span>
				</div>
				<div class="panel__lead">
					<ul>
						<a href="<?= BASE_URL . 'admin-comments.php?sort=' ?>" <?php if ($_GET['sort'] === '') : ?>class="active" <?php endif; ?>>Все</a>
						<a href="<?= BASE_URL . 'admin-comments.php?sort=Сотрудники' ?>" <?php if ($_GET['sort'] === 'Сотрудники') : ?>class="active" <?php endif; ?>>Сотрудники</a>
						<a href="<?= BASE_URL . 'admin-comments.php?sort=Бренды' ?>" <?php if ($_GET['sort'] === 'Бренды') : ?>class="active" <?php endif; ?>>Бренды</a>
					</ul>
				</div>
			</div>
		<?php endif ?>
	</div>
	<div class="panel__emplyees">
		<?php if ($user['position_id'] == 4) : ?>
			<?php if (!empty($comments)) : ?>
				<div class="panel__comments comm">
					<?php foreach ($comments as $comment) : ?>
						<div class="comm__item">
							<div class="comm_info">
								<div class="comm__name"><?= $comment['name']; ?></div>
								<div class="comm__text"><?= $comment['comment']; ?></div>
							</div>
							<?php if ($comment['status'] === 'pending') : ?>
								<a href="<?= BASE_URL . 'admin-comments.php?sort=' . $_GET['sort'] . '&agree=' . $comment['comment_id'] ?>" class="comm__take"><img src="assets/img/icon-agree.png" alt=""></a>
								<a href="<?= BASE_URL . 'admin-comments.php?sort=' . $_GET['sort'] . '&disagree=' . $comment['comment_id'] ?>" class="comm__deny"><img src="assets/img/icon-disagree.png" alt=""></a>
							<?php else : ?>
								<?php if ($comment['status'] === 'confirmed') : ?>
									<a href="<?= BASE_URL . 'admin-comments.php?agree=' . $comment['comment_id'] ?>" class="comm__success">ОДОБРЕНО</a>
								<?php elseif ($comment['status'] === 'calcelled') : ?>
									<a href="<?= BASE_URL . 'admin-comments.php?disagree=' . $comment['comment_id'] ?>" class="comm__error">НЕ ОДОБРЕНО</a>
								<?php else : ?>
								<?php endif ?>
							<?php endif ?>
							<a href="<?= BASE_URL . 'admin-comments.php?sort=' . $_GET['sort'] . '&delete=' . $comment['comment_id'] ?>" class="comm__delete"><img src="assets/img/trash.png" alt=""></a>
						</div>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="master-personal__comment">На данный момент нету отзывов</div>
			<?php endif; ?>
		<?php elseif ($user['position_id'] == 5) : ?>
			<?php $comments = getClientComments($_SESSION['id']); ?>
			<?php if (!empty($comments)) : ?>
				<div class="panel__comments comm">
					<?php foreach ($comments as $comment) : ?>
						<div class="comm__item">
							<div class="comm_info">
								<div class="comm__name"><?= $comment['name']; ?></div>
								<div class="comm__text"><?= $comment['comment']; ?></div>
							</div>
							<?php if ($comment['status'] === 'pending') : ?>
								<a href="<?= BASE_URL . 'admin-comments.php?sort=' . $_GET['sort'] . '&agree=' . $comment['comment_id'] ?>" class="comm__wait">НА РАСМОТРЕНИЕ</a>
							<?php else : ?>
								<?php if ($comment['status'] === 'confirmed') : ?>
									<a href="<?= BASE_URL . 'admin-comments.php?agree=' . $comment['comment_id'] ?>" class="comm__success">ОДОБРЕНО</a>
								<?php elseif ($comment['status'] === 'calcelled') : ?>
									<a href="<?= BASE_URL . 'admin-comments.php?disagree=' . $comment['comment_id'] ?>" class="comm__error">НЕ ОДОБРЕНО</a>
								<?php else : ?>
								<?php endif ?>
							<?php endif ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="master-personal__comment">На данный момент нету отзывов</div>
			<?php endif; ?>
		<?php else : ?>
			<?php $comments = getEmployeeComments($_SESSION['id']); ?>
			<?php if (!empty($comments)) : ?>
				<div class="panel__comments comm">
					<?php foreach ($comments as $comment) : ?>
						<div class="comm__item">
							<div class="comm_info">
								<div class="comm__name"><?= $comment['name']; ?></div>
								<div class="comm__text"><?= $comment['comment']; ?></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="master-personal__comment">На данный момент нету отзывов</div>
			<?php endif; ?>
		<?php endif ?>
	</div>
</div>
</div>