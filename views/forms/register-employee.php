<?php 
  $positions = selectAll('positions'); 
  $brends = selectAll('brends');
 ?>

<div class="form">
  <div class="form__header">
    <a href="<?= BASE_URL . 'index.php' ?>" class="form__logo"><img src="assets/img/logo.png" alt=""></a>
    <a href="<?= BASE_URL . 'login.php' ?>" class="form__link-reg">Войти</a>
  </div>
  <div class="form__container">
    <form action="" method="POST" class="form__body">
      <h1 class="form__title">Регистрация специалиста</h1>
      <div class="form__tabs">
        <a href="register.php" class="form__link">Клиент</a>
        <div class="form__link i-active">Специалист</div>
      </div>
      <div class="form__label">Ваше имя</div>
      <div class="form__item">
        <input type="text" name="name" value="<?= htmlspecialchars($_SESSION['name']) ?>">
      </div>
      <div class="form__label">Должность</div>
      <div class="form__item _fr">
        <select class="profily__select" name="position" required>
            <option selected disabled>Выберите должность</option>
            <?php foreach ($positions as $position) : ?>
                <option value="<?= htmlspecialchars($position['id']) ?>"><?= htmlspecialchars($position['name']) ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <div class="form__label _br_t" style="display: none;">Наименование бренда</div>
      <div class="form__item _choise_1" style="display: none;">
        <input type="text" name="brend" value="<?= htmlspecialchars($_SESSION['brend']) ?>">
      </div>
      <div class="form__item _choise_2">
        <select class="form__select" name="brend">
          <option selected disabled>Выберите наименование бренда</option>
          <?php foreach ($brends as $brend) : ?>
            <option value="<?= htmlspecialchars($brend['id']) ?>"><?= htmlspecialchars($brend['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form__label">Мобильный телефон</div>
      <div class="form__item">
        <input type="text" name="phone" value="<?= htmlspecialchars($_SESSION['phone']) ?>">
      </div>
      <div class="form__label">Email</div>
      <div class="form__item">
        <input type="text" name="email" value="<?= htmlspecialchars($_SESSION['email']) ?>">
      </div>
      <div class="form__label">Пароль</div>
      <div class="form__item">
        <input type="password" name="password">
      </div>
      <div class="form__label">Повторите пароль</div>
      <div class="form__item">
        <input type="password" name="rep_pass">
      </div>
      <?php if (!empty($erroMessageRegisterEmployee)) : ?>
        <div class="err"><?= htmlspecialchars($erroMessageRegisterEmployee); ?></div>
      <?php endif ?>
      <button type="submit" name="register_employee">Зарегистрироваться</button>
    </form>
  </div>
</div>