<div class="booking__head">
  <?php if (empty($_SESSION['ID_BREND'])): ?>
    <div href="#" class="booking__b-title">Выбрать бренд</div>
    <?php if (isset($_SESSION['id'])) : ?>
      <?php $user = findUserById($_SESSION['id']) ?>
      <a href="<?= BASE_URL . 'personal-account.php' ?>" class="booking__login"><?= $user['name'] ?><img src="assets/img/icon-gif.gif" alt=""></a>
    <?php else : ?>
      <a href="<?= BASE_URL . 'login.php' ?>" class="booking__login">Вход<img src="assets/img/icon-gif.gif" alt=""></a>
    <?php endif ?>
  <?php endif ?>

  <?php if (!empty($_SESSION['ID_BREND'])): ?>
    <div class="booking__h-item">
      <?= $brend['name']; ?> <img src="assets/img/icon-help.png" alt="">
    </div>
    <?php if (isset($_SESSION['id'])) : ?>
      <?php $user = findUserById($_SESSION['id']) ?>
      <a href="<?= BASE_URL . 'personal-account.php' ?>" class="booking__login"><?= $user['name'] ?><img src="assets/img/icon-gif.gif" alt=""></a>
    <?php else : ?>
      <a href="<?= BASE_URL . 'login.php' ?>" class="booking__login">Вход<img src="assets/img/icon-gif.gif" alt=""></a>
    <?php endif ?>
    <div class="booking__f-item">
      <ul class="booking__c-list">
        <li>Телефон: <span><?= $brend['phone'] ?></span></li>
        <li>Адресс: <span><?= $brend['adress'] ?></span></li>
      </ul>
      <div class="booking__c-title">Отзывы</div>
      <div class="booking__comments">
        <?php foreach($commentsBrend as $comment): ?>
          <div class="bookin__f-comment">
              <div class="booking__b-name"><?= $comment['guest_name'] ?></div>
              <div class="booking__b-text"><?= $comment['comment'] ?></div>
            </div>
        <?php endforeach ?>
      </div>
    <?php if(!empty($user['id'])): ?>
      <form action="#" method="post" class="bookin__f-comment">
        <input type="hidden" name="brend_id" value="<?= $brend['id'] ?>">
        <input type="hidden" name="brend_name" value="<?= $brend['name'] ?>">
        <div class="booking__label">
          <input type="text" name="name" placeholder="Имя" value="<?= $user['name']; ?>">
        </div>
        <div class="booking__label">
          <input type="email" name="email" placeholder="Email" value="<?= $user['email']; ?>">
        </div>
        <div class="booking__label">
          <textarea name="message" placeholder="Комментарий" required></textarea>
        </div>
        <button type="submit" name="send_comment_brend">Оставить отзыв</button>
      </form>
    <?php else : ?>
      <form action="#" method="post" class="bookin__f-comment">
        <input type="hidden" name="brend_id" value="<?= $brend['id'] ?>">
        <input type="hidden" name="brend_name" value="<?= $brend['name'] ?>">
        <div class="booking__label">
          <input type="text" name="name" placeholder="Имя" required>
        </div>
        <div class="booking__label">
          <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="booking__label">
          <textarea name="message" placeholder="Комментарий" required></textarea>
        </div>
        <button type="submit" name="send_comment_brend">Оставить отзыв</button>
      </form>
   <?php endif ?>
    </div>
  <?php endif ?>
</div>