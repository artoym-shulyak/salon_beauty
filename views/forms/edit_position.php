<?php
  $brendPositions = getBrandPositions($brend['id']);
?>


<div class="profily__item">
  <h2 class="profily__title">Должности</h2>
  <?php if (!empty($brendPositions)) : ?>
  <div class="profily__wrap">
    <?php foreach ($brendPositions as $brendPosition) : ?>
        <div class="profily__position">
          <?= htmlspecialchars($brendPosition['name']); ?>
          <a href="<?= BASE_URL . 'admin-brend.php?id_brenPos=' . $brendPosition['id'] . '&brend_id=' . $brend['id'] ?>" class="panel__delete" style="margin-left: auto;">
            <img src="assets/img/trash.png" alt="">
          </a>
        </div>
    <?php endforeach; ?>
  </div>
  <?php else : ?>
    <div class="profily__wrap">
      <p>У этого бренда пока нет должностей.</p>
    </div>
      
  <?php endif; ?>
</div>

