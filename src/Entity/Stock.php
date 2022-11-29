<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    private ?products $product = null;

    #[ORM\Column]
    private ?float $item_price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reason = null;

    #[ORM\Column(nullable: true)]
    private ?float $qty = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $shipping_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $in_or_out = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?products
    {
        return $this->product;
    }

    public function setProduct(?products $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getItemPrice(): ?float
    {
        return $this->item_price;
    }

    public function setItemPrice(float $item_price): self
    {
        $this->item_price = $item_price;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getQty(): ?float
    {
        return $this->qty;
    }

    public function setQty(?float $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getShippingDate(): ?\DateTimeInterface
    {
        return $this->shipping_date;
    }

    public function setShippingDate(?\DateTimeInterface $shipping_date): self
    {
        $this->shipping_date = $shipping_date;

        return $this;
    }

    public function getInOrOut(): ?string
    {
        return $this->in_or_out;
    }

    public function setInOrOut(?string $in_or_out): self
    {
        $this->in_or_out = $in_or_out;

        return $this;
    }
}
