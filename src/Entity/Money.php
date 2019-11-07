<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MoneyRepository")
 */
class Money
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAvaliable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getIsAvaliable(): ?bool
    {
        return $this->isAvaliable;
    }

    public function setIsAvaliable(bool $isAvaliable): self
    {
        $this->isAvaliable = $isAvaliable;

        return $this;
    }
}
