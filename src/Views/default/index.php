<?php
/**
 * @var \App\Models\Task[] $models
 * @var int $pagesCount
 * @var int $page
 * @var bool $isGuest
 * @var array $sortFields
 * @var array $sortTypes
 * @var string $currentSortField
 * @var string $currentSortOrder
 */
?>

<form method="get" class="mb-4">
    <div class="form-group">
        <label for="sortBy">Сортировать по</label>
        <select class="form-control" id="sortBy" name="sortBy">
            <option></option>
            <?php foreach ($sortFields as $key => $value): ?>
                <option value="<?= $key ?>" <?= $key == $currentSortField ? 'selected' : ''?>><?= $value ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="sortBy">Порядок</label>
        <select class="form-control" id="sortOrder" name="sortOrder">
            <?php foreach ($sortTypes as $key => $value): ?>
                <option value="<?= $key ?>" <?= $key == $currentSortOrder ? 'selected' : '' ?>><?= $value ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button class="btn btn-secondary btn-block">Сортировать</button>
</form>

<?php foreach ($models as $model): ?>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <h6 class="mb-0"># <?= $model->getId() ?></h6>
            <div>
                <?php if ($model->getIsDone()): ?>
                    <span class="badge badge-success">Завершена</span>
                <?php else: ?>
                    <span class="badge badge-secondary">Не завершена</span>
                <?php endif; ?>

                <?php if ($model->getIsEdited()): ?>
                    <span class="badge badge-secondary">Редактирована</span>
                <?php endif; ?>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Имя: <strong><?= $model->getName() ?></strong></li>
            <li class="list-group-item">E-Mail: <strong><?= $model->getEmail() ?></strong></li>
        </ul>
        <div class="card-body">
            <?= $model->getText() ?>

            <?php if (!$isGuest): ?>
                <?php $editLink = \App\Services\ServiceContainer::getInstance()->getUrlBuilder()
                    ->setAction('update')
                    ->setParams(['id' => $model->getId()])
                    ->getUrl();
                ?>

                <a href="<?= $editLink ?>" class="btn btn-block mt-3 btn-secondary">Редактировать</a>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>

<?php if($pagesCount > 1): ?>
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $pagesCount; $i++): ?>
                <li class="page-item<?= $i == $page ? ' active' : '' ?>">
                    <?php $pageLink = \App\Services\ServiceContainer::getInstance()->getUrlBuilder()
                        ->setController('default')
                        ->setAction('index')
                        ->setParams(array_merge($_GET, ['page' => $i]))
                        ->getUrl()
                    ?>

                    <a class="page-link" href="<?= $pageLink ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>


