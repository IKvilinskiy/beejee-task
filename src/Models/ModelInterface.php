<?php


namespace App\Models;


/**
 * Interface ModelInterface
 * @package App\Models
 */
interface ModelInterface
{
    /**
     * @return bool
     */
    public function validate(): bool;

    /**
     * @return bool
     */
    public function hasErrors(): bool;

    /**
     * @return array|null
     */
    public function getErrors(): ?array;

    /**
     * @param string $errorText
     */
    public function addError(string $errorText): void;

    public function flushErrors(): void;
}
