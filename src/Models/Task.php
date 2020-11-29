<?php


namespace App\Models;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Task
 * @package App\Models
 *
 * @ORM\Entity
 * @ORM\Table(name="tasks")
 */
class Task extends AbstractModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $email = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $text = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isDone = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isEdited = false;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        if (empty($this->name))
            $this->addError('Необходимо заполнить "Имя".');

        if (empty($this->email))
            $this->addError('Необходимо заполнить "E-Mail"');
        elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            $this->addError('Некоррекнтное поле "E-Mail"');

        if (empty($this->text))
            $this->addError('Необходимо заполнить "Текст"');

        return !$this->hasErrors();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Task
     */
    public function setName(?string $name): self
    {
        if (!$this->isNew() && $this->name !== $name)
            $this->setIsEdited(true);

        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Task
     */
    public function setEmail(string $email): self
    {
        if (!$this->isNew() && $this->email !== $email)
            $this->setIsEdited(true);

        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Task
     */
    public function setText(string $text): self
    {
        if (!$this->isNew() && $this->text !== $text)
            $this->setIsEdited(true);

        $this->text = $text;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsDone(): ?bool
    {
        return $this->isDone;
    }

    /**
     * @param bool|null $isDone
     * @return Task
     */
    public function setIsDone(?bool $isDone): self
    {
        $this->isDone = $isDone;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsEdited(): ?bool
    {
        return $this->isEdited;
    }

    /**
     * @param bool|null $isEdited
     * @return Task
     */
    public function setIsEdited(?bool $isEdited): self
    {
        $this->isEdited = $isEdited;

        return $this;
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->getId() === null;
    }
}
