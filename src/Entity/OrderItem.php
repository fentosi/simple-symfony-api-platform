<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\OrderItemRepository")
 */
class OrderItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="orderItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Order;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="orderItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Item;

    /**
     * @ORM\Column(type="integer")
     */
    private $Amount;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $Price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedDateTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrder(): ?Order
    {
        return $this->Order;
    }

    public function setOrder(?Order $Order): self
    {
        $this->Order = $Order;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->Item;
    }

    public function setItem(?Item $Item): self
    {
        $this->Item = $Item;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->Amount;
    }

    public function setAmount(int $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getPrice()
    {
        return $this->Price;
    }

    public function setPrice($Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getCreatedDateTime(): ?DateTimeInterface
    {
        return $this->CreatedDateTime;
    }

    public function setCreatedDateTime(DateTimeInterface $CreatedDateTime): self
    {
        $this->CreatedDateTime = $CreatedDateTime;

        return $this;
    }
}
