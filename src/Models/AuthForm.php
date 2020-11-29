<?php


namespace App\Models;


use App\Services\ServiceContainer;

/**
 * Class AuthForm
 * @package App\Models
 */
class AuthForm extends AbstractModel
{
    /**
     * @var string|null
     */
    private ?string $login = null;

    /**
     * @var string|null
     */
    private ?string $password = null;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        if (empty($this->login))
            $this->addError('Необходимо заполнить поле "Логин"');

        if (empty($this->password))
            $this->addError('Необходимо заполнить поле "Пароль"');

        $authConfig = ServiceContainer::getInstance()->getConfig()->getConfig()['auth'];

        if (
            !$this->hasErrors()
            && ($this->login != $authConfig['login'] || $this->password != $authConfig['password'])
        ) {
            $this->addError('Неверный логин или пароль');
        }

        return !$this->hasErrors();
    }

    /**
     * @param string|null $login
     * @return AuthForm
     */
    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param string|null $password
     * @return AuthForm
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
