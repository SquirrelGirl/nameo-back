<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attempt
 *
 * @ORM\Table(name="attempt")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AttemptRepository")
 */
class Attempt
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="guessed", type="boolean", nullable=true)
     */
    private $guessed;

    /**
     * @var int
     *
     * @ORM\Column(name="step", type="integer")
     */
    private $step;


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
     * Set guessed
     *
     * @param boolean $guessed
     *
     * @return Try
     */
    public function setGuessed($guessed)
    {
        $this->guessed = $guessed;

        return $this;
    }

    /**
     * Get guessed
     *
     * @return bool
     */
    public function getGuessed()
    {
        return $this->guessed;
    }

    /**
     * Set step
     *
     * @param integer $step
     *
     * @return Try
     */
    public function setStep($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return int
     */
    public function getStep()
    {
        return $this->step;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id")
     */
    private $card;


    /**
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $game;


    /**
     * Set card
     *
     * @param \AppBundle\Entity\Card $card
     *
     * @return Attempt
     */
    public function setCard(\AppBundle\Entity\Card $card = null)
    {
        $this->card = $card;

        return $this;
    }

    /**
     * Get card
     *
     * @return \AppBundle\Entity\Card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * Set game
     *
     * @param \AppBundle\Entity\Game $game
     *
     * @return Attempt
     */
    public function setGame(\AppBundle\Entity\Game $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \AppBundle\Entity\Game
     */
    public function getGame()
    {
        return $this->game;
    }
}
