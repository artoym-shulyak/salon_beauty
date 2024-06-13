<form action="" method="post" class="profily__item">
    <h2 class="profily__title">Добавление должности</h2>
    <input type="hidden" name="brend_id" value="<?= $user['brend_id'] ?>">
    <div class="profily__wrap">
        <div class="form__item _choise_2">
            <select class="profily__select" name="position" required>
                <option selected disabled>Выберите должность</option>
                <?php foreach ($positions as $position) : ?>
                    <option value="<?= htmlspecialchars($position['id']) ?>"><?= htmlspecialchars($position['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if (!empty($erroMessagePosotions)) : ?>
            <div class="err"><?= htmlspecialchars($erroMessagePosotions); ?></div>
        <?php endif ?>
        <?php if (!empty($successMessPosotions)) : ?>
            <div class="success"><?= htmlspecialchars($successMessPosotions); ?></div>
        <?php endif ?>
        <button type="submit" name="add_position">Добавить</button>
    </div>
</form>