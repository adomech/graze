<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BoxRepository")
 */
class Box
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Account")
     */
    private $account_id;

    /**
     * @ORM\Column(type="date")
     */
    private $delivery_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccountId(): ?Account
    {
        return $this->account_id;
    }

    public function setAccountId(?Account $account_id): self
    {
        $this->account_id = $account_id;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->delivery_date;
    }

    public function setDeliveryDate(\DateTimeInterface $delivery_date): self
    {
        $this->delivery_date = $delivery_date;

        return $this;
    }
}
