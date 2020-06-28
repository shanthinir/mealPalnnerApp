<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 */
class Comments
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
    private $userId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentText;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commentTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="integer")
     */
    private $recipeId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getCommentText(): ?string
    {
        return $this->commentText;
    }

    public function setCommentText(?string $commentText): self
    {
        $this->commentText = $commentText;

        return $this;
    }

    public function getCommentTitle(): ?string
    {
        return $this->commentTitle;
    }

    public function setCommentTitle(string $commentTitle): self
    {
        $this->commentTitle = $commentTitle;

        return $this;
    }

    public function getDateCreated(): ?string
    {
        return $this->dateCreated;
    }

    public function setDateCreated(string $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getRecipeId(): ?int
    {
        return $this->recipeId;
    }

    public function setRecipeId(int $recipeId): self
    {
        $this->recipeId = $recipeId;

        return $this;
    }
}
