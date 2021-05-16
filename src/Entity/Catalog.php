<?php

namespace App\Entity;

use App\Repository\CatalogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CatalogRepository::class)
 */
class Catalog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="catalog")
     */
    private $product_id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $state;



    public function __construct()
    {
        $this->product_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Products[]
     */
    public function getProductId(): Collection
    {
        return $this->product_id;
    }

    public function addProductId(Products $productId): self
    {
        if (!$this->product_id->contains($productId)) {
            $this->product_id[] = $productId;
            $productId->setCatalog($this);
        }

        return $this;
    }

    public function removeProductId(Products $productId): self
    {
        if ($this->product_id->removeElement($productId)) {
            // set the owning side to null (unless already changed)
            if ($productId->getCatalog() === $this) {
                $productId->setCatalog(null);
            }
        }

        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state): self
    {
        $this->state = $state;

        return $this;
    }
}
