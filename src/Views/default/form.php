<?php
/**
 * @var \App\Models\Task $model
 * @var array $alerts
 * @var \App\Services\Renderer\RendererInterface $renderer
 * @var bool $isGuest
 */

$isNewModel = $model->getId() === null;

?>

<?php foreach ($alerts as $alert): ?>
    <?php $renderer->render('_components/alert.php', $alert) ?>
<?php endforeach; ?>

<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="form-group">
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" id="name" value="<?= $model->getName() ?>" name="name"
                           placeholder="Иванов...">
                </div>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" id="email" value="<?= $model->getEmail() ?>" name="email"
                           placeholder="example@email.com">
                </div>
                <div class="form-group">
                    <label for="content">Текст</label>
                    <textarea class="form-control" id="text" name="text"
                              placeholder="Сделать..."><?= $model->getText() ?></textarea>
                </div>
                <?php if (!$isGuest && !$model->isNew()): ?>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="isDone"
                                   id="isDone" <?= $model->getIsDone() ? 'checked' : '' ?>>
                            <label class="form-check-label" for="isDone">
                                Выполнена
                            </label>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
            <button class="btn btn-success btn-block"
                    type="submit"><?= $model->isNew() ? 'Сохранить' : 'Обновить' ?></button>
        </form>
    </div>
</div>
