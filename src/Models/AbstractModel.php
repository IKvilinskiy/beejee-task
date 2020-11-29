<?php


namespace App\Models;


/**
 * Class AbstractModel
 * @package App\Models
 */
abstract class AbstractModel implements ModelInterface
{
    /**
     * @var array
     */
    protected array $errors = [];

    /**
     * @return bool
     */
    public function validate(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * @return array|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * @param string $errorText
     */
    public function addError(string $errorText): void
    {
        $this->errors[] = $errorText;
    }

    public function flushErrors(): void
    {
        $this->errors = [];
    }

}
