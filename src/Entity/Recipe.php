<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="array")
     */
    private $recipeIngredient = [];

    /**
     * @ORM\Column (type="string", length=200)
     */
    private $image;

    /**
     * @ORM\Column(type="array")
     */
    private $direction = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getRecipeIngredient(): array
    {
        return $this->recipeIngredient;
    }

    /**
     * @param array $recipeIngredient
     */
    public function setRecipeIngredient(array $recipeIngredient): void
    {
        $this->recipeIngredient = $recipeIngredient;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return array
     */
    public function getDirection(): array
    {
        return $this->direction;
    }

    /**
     * @param array $direction
     */
    public function setDirection(array $direction): void
    {
        $this->direction = $direction;
    }
}



