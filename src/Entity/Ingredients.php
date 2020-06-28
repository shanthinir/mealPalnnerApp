<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientsRepository")
 */
class Ingredients
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $energy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $protein;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $netCarb;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sugar;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="ingredients")
     * @ORM\JoinColumn(name="recipeId", referencedColumnName="id")
     */
    private $recipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEnergy(): ?int
    {
        return $this->enery;
    }

    public function setEnergy(?int $enery): self
    {
        $this->enery = $enery;

        return $this;
    }

    public function getProtein(): ?int
    {
        return $this->protein;
    }

    public function setProtein(?int $protein): self
    {
        $this->protein = $protein;

        return $this;
    }

    public function getNetCarb(): ?int
    {
        return $this->netCarb;
    }

    public function setNetCarb(?int $netCarb): self
    {
        $this->netCarb = $netCarb;

        return $this;
    }

    public function getSugar(): ?int
    {
        return $this->sugar;
    }

    public function setSugar(?int $sugar): self
    {
        $this->sugar = $sugar;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getRecipe(): ?int
    {
        return $this->recipeId;
    }

    public function setRecipe(?int $recipeId): self
    {
        $this->recipeId = $recipeId;

        return $this;
    }
}
