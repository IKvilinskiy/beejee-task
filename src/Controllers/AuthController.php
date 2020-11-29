<?php


namespace App\Controllers;


use App\Models\AuthForm;
use App\Services\ServiceContainer;

class AuthController extends AbstractController
{
    public function actionIndex()
    {
        if (!$this->userIsGuest()) {
            $this->goHome();
            return;
        }

        $this->title = 'Авторизация';
        $alerts = [];
        $model = new AuthForm();

        if (!empty($_POST)) {
            $formData = $this->escapeRequestData($_POST);

            $model
                ->setLogin(trim($formData['login']) ?? null)
                ->setPassword($formData['password'] ?? null)
            ;

            if (!$model->validate()) {
                foreach ($model->getErrors() as $error) {
                    $alerts[] = [
                        'type' => 'danger',
                        'message' => $error,
                    ];
                }
            } else {
                $_SESSION[self::SESSION_AUTH_NAME] = true;

                $this->goHome();
                return;
            }
        }

        $this->render('auth/login.php', [
            'model' => $model,
            'alerts' => $alerts,
        ]);
    }

    public function actionLogout()
    {
        unset($_SESSION[self::SESSION_AUTH_NAME]);
        $this->goHome();
        return;
    }

    private function goHome()
    {
        $homeLink = ServiceContainer::getInstance()
            ->getUrlBuilder()
            ->getUrl();

        header('Location: ' . $homeLink);
        return;
    }
}
