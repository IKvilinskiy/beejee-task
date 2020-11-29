<?php
/**
 * @var array $alerts
 * @var \App\Models\AuthForm $model
 * @var \App\Services\Renderer\RendererInterface $renderer
 */
?>

<?php foreach ($alerts as $alert): ?>
    <?php $renderer->render('_components/alert.php', $alert) ?>
<?php endforeach; ?>

<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="form-group">
                <div class="form-group">
                    <label for="login">Логин</label>
                    <input type="text" class="form-control" id="login" value="<?= $model->getLogin() ?>" name="login">
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-block">Войти</button>
        </form>
    </div>
</div>
