<?php
/**
 * @var \App\Services\Renderer\RendererInterface $renderer
 * @var string $_viewPath
 * @var array $_vars
 * @var string $_title
 * @var bool $_isGuest
 */

$homeLink = \App\Services\ServiceContainer::getInstance()->getUrlBuilder()
    ->getUrl();

$createLink = \App\Services\ServiceContainer::getInstance()->getUrlBuilder()
    ->setController('default')
    ->setAction('create')
    ->getUrl();

$authLink = \App\Services\ServiceContainer::getInstance()->getUrlBuilder()
    ->setController('auth')
    ->getUrl();

$logoutLink = \App\Services\ServiceContainer::getInstance()->getUrlBuilder()
    ->setController('auth')
    ->setAction('logout')
    ->getUrl();
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks service<?= $_title ? ' - ' . $_title : '' ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="mb-4 mt-4">
                <h1 class="h2">Tasks service</h1>
                <div>
                    <a href="<?= $homeLink ?>" class="btn btn-outline-primary btn-sm mr-1">Главная</a>
                    <a href="<?= $createLink ?>" class="btn btn-outline-primary btn-sm mr-1">Создать</a>
                    <?php if ($_isGuest): ?>
                        <a href="<?= $authLink ?>" class="btn btn-outline-primary btn-sm">Войти</a>
                    <?php else: ?>
                        <a href="<?= $logoutLink ?>" class="btn btn-outline-primary btn-sm">Выйти</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($_title !== null): ?>
                <h3 class="mb-4 h5"><?= $_title ?></h3>
            <?php endif; ?>

            <?php $renderer->render($_viewPath, $_vars ?? []); ?>
        </div>
    </div>
</div>
</body>
</html>
