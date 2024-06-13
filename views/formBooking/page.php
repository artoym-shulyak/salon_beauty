			<?php if ($_GET['SELECTED'] === 'PAGE') : ?>
				<div class="booking__master master-personal">
					<a href="<?= BASE_URL . 'online-booking.php?SELECTED=EMPLOYEES'?>" class="master-personal__back"><img src="assets/img/icon-p.png" alt="">Назад</a>
					<div class="master-personal__head">
						<div class="master-personal__avatar"><img src="assets/img/photo.png" alt=""></div>
						<h3 class="master-personal__name"><?= $employee['name']; ?></h3>
						<div class="master-personal__position"><?= $employee['position'] ?></div>
					</div>
					<div class="master-personal__footer">
						<div class="master-personal__title">Отзывы</div>
						<div class="master-personal__comments">
							<?php if (!empty($commentsEmployee)) : ?>
								<?php foreach ($commentsEmployee as $comment) : ?>
									<div class="master-personal__comment">
										<div class="master-personal__c-name"><?= $comment['guest_name']; ?></div>
										<div class="master-personal__c-text"><?= $comment['comment']; ?></div>
									</div>
								<?php endforeach; ?>
							<?php else : ?>
								<div class="master-personal__comment">На данный момент нету отзывов</div>
							<?php endif; ?>
						</div>
						<?php if (!empty($successSendEmp)) : ?>
							<div class="success _block"><?= $successSendEmp; ?></div>
						<?php endif; ?>
						<form action="#" method="post" class="bookin__f-comment">
							<input type="hidden" name="employee_id" value="<?= $employee['id'] ?>">
							<div class="booking__label">
								<input type="text" name="name" placeholder="Имя" required>
							</div>
							<div class="booking__label">
								<input type="email" name="email" placeholder="Email" required>
							</div>
							<div class="booking__label">
								<textarea name="message" placeholder="Комментарий" required></textarea>
							</div>
							<button type="submit" name="send_comment_emp">Оставить отзыв</button>
						</form>

					</div>
				</div>
			<? endif ?>