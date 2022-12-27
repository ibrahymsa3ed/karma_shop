<?php

namespace App\Entity;

use App\Repository\OrdersProductsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersProductsRepository::class)]
class OrdersProducts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $product_qty = null;

    #[ORM\ManyToOne(inversedBy: 'ordersProducts')]
    private ?prices $price = null;


    #[ORM\ManyToOne(targetEntity: Orders::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Orders $orders;

    #[ORM\ManyToOne(targetEntity: Products::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Products $products;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductQty(): ?int
    {
        return $this->product_qty;
    }

    public function setProductQty(int $product_qty): self
    {
        $this->product_qty = $product_qty;

        return $this;
    }

    public function getPrice(): ?prices
    {
        return $this->price;
    }

    public function setPrice(?prices $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrders(): mixed
    {
        return $this->orders;
    }

    /**
     * @param mixed $orders
     */
    public function setOrders(mixed $orders): void
    {
        $this->orders = $orders;
    }

    /**
     * @return mixed
     */
    public function getProducts(): mixed
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts(mixed $products): void
    {
        $this->products = $products;
    }


}
