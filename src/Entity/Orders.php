<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?products $product = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $invoice_num = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $total = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?users $user = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?addresses $address = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?mobiles $mobile = null;

    #[ORM\OneToMany(mappedBy: 'orders', targetEntity: OrdersProducts::class)]
    private Collection $productOrdersProducts;

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

    public function getInvoiceNum(): ?string
    {
        return $this->invoice_num;
    }

    public function setInvoiceNum(?string $invoice_num): self
    {
        $this->invoice_num = $invoice_num;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getUser(): ?users
    {
        return $this->user;
    }

    public function setUser(?users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAddress(): ?addresses
    {
        return $this->address;
    }

    public function setAddress(?addresses $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getMobile(): ?mobiles
    {
        return $this->mobile;
    }

    public function setMobile(?mobiles $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }
}
