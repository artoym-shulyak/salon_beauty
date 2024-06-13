<div class="panel__body">
  <div class="panel__head">
    <h2 class="panel__title">Бренд</h2>
    <a href="<?= BASE_URL . 'controllers/forms/logout.php'; ?>" class="panel__logout">Выйти</a>
  </div>
  <div class="panel__profily profily">
    <div class="profily__settings">
      <?php include_once 'views/forms/edit-brend.php'; ?>
      <?php include_once 'views/forms/add_position.php'; ?>
      <?php include_once 'views/forms/edit_position.php'; ?>
    </div>
  </div>
</div>
</div>