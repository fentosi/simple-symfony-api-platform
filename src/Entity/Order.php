<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @Table("`order`")
 */

class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $OrderTotal;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedDateTime;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderItem", mappedBy="OrderID", orphanRemoval=true)
     */
    private $orderItems;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderTotal()
    {
        return $this->OrderTotal;
    }

    public function setOrderTotal($OrderTotal): self
    {
        $this->OrderTotal = $OrderTotal;

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

    /**
     * @return Collection|OrderItem[]
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems[] = $orderItem;
            $orderItem->setOrder($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItems->contains($orderItem)) {
            $this->orderItems->removeElement($orderItem);
            // set the owning side to null (unless already changed)
            if ($orderItem->getOrder() === $this) {
                $orderItem->setOrder(null);
            }
        }

        return $this;
    }
}
