<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 * A game session
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game
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
     * The language that was set on the navigator
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=10, nullable=true)
     */
    private $locale;

    /**
     * The difficulty quantile requested for the session
     * @var int
     *
     * @ORM\Column(name="difficulty", type="integer")
     */
    private $difficulty;

    /**
     * The number of players
     * @var int
     *
     * @ORM\Column(name="players", type="integer")
     */
    private $players;

    /**
     * The number of teams
     * @var int
     *
     * @ORM\Column(name="teams", type="integer")
     */
    private $teams;

    /**
     * The timestamp of the start of the game
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetimetz")
     */
    private $start;

    /**
     * If set, the phase at which the game was aborted
     * @var int
     *
     * @ORM\Column(name="aborted", type="integer", nullable=true)
     */
    private $aborted;


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
     * Set locale
     *
     * @param string $locale
     *
     * @return game
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set difficulty
     *
     * @param integer $difficulty
     *
     * @return game
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get difficulty
     *
     * @return int
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set players
     *
     * @param integer $players
     *
     * @return game
     */
    public function setPlayers($players)
    {
        $this->players = $players;

        return $this;
    }

    /**
     * Get players
     *
     * @return int
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Set teams
     *
     * @param integer $teams
     *
     * @return game
     */
    public function setTeams($teams)
    {
        $this->teams = $teams;

        return $this;
    }

    /**
     * Get teams
     *
     * @return int
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return game
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set aborted
     *
     * @param integer $aborted
     *
     * @return game
     */
    public function setAborted($aborted)
    {
        $this->aborted = $aborted;

        return $this;
    }

    /**
     * Get aborted
     *
     * @return int
     */
    public function getAborted()
    {
        return $this->aborted;
    }
}
