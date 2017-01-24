<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Card
 * Represents 1 card in the game
 *
 * @ORM\Table(name="card")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CardRepository")
 */
class Card
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Groups({"rest"})
     */
    private $id;

    /**
     * Title of the card, what must be guessed
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     * 
     * @Groups({"rest"})
     */
    private $title;

    /**
     * Description of the card, to give more information
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * How many times this card has been attempted
     * @var int
     *
     * @ORM\Column(name="attempts", type="integer")
     */
    private $attempts;

    /**
     * How many times this card has been correctly guessed
     * @var int
     *
     * @ORM\Column(name="successes", type="integer")
     */
    private $successes;

    /**
     * Which difficulty quantile does this card belong to
     * @var int
     *
     * @ORM\Column(name="quantile", type="integer", nullable=true)
     */
    private $quantile;

    /**
     * Category of the card
     * @var Category
     * 
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Card
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Card
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set attempts
     *
     * @param integer $attempts
     *
     * @return Card
     */
    public function setAttempts($attempts)
    {
        $this->attempts = $attempts;

        return $this;
    }

    /**
     * Get attempts
     *
     * @return int
     */
    public function getAttempts()
    {
        return $this->attempts;
    }

    /**
     * Set successes
     *
     * @param integer $successes
     *
     * @return Card
     */
    public function setSuccesses($successes)
    {
        $this->successes = $successes;

        return $this;
    }

    /**
     * Get successes
     *
     * @return int
     */
    public function getSuccesses()
    {
        return $this->successes;
    }

    /**
     * Set quantile
     *
     * @param integer $quantile
     *
     * @return Card
     */
    public function setQuantile($quantile)
    {
        $this->quantile = $quantile;

        return $this;
    }

    /**
     * Get quantile
     *
     * @return int
     */
    public function getQuantile()
    {
        return $this->quantile;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Card
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
