<div class="modal _add-service" id="modal-add-service">
  <div class="modal__body">
    <div class="modal__close" data-close><img src="assets/img/icon-close.png" alt=""></div>
    <div class="modal__title">Добавление услуги</div>
    <form action="" method="post">
      <div class="modal__items">
        <div class="modal__item">
          <select class="modal__select" name="service_id" style="margin-bottom: 0px;">
            <?php foreach ($allServices as $service) : ?>
              <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="modal__item">
          <input type="text" name="price" placeholder="Введите цену услуги">
        </div>
        <div class="modal__item">
          <input type="text" name="duration" placeholder="Введите длительность услгуи">
        </div>
      </div>
      <?php if (!empty($fieldsAddService['fields'])) : ?>
        <div class="err"><?= $fieldsAddService['fields']; ?></div>
        <input type="hidden" id="formErrorAddService" value="true">
      <?php endif ?>
      <button type="submit" name="add_service">Добавить</button>
    </form>
  </div>
</div>