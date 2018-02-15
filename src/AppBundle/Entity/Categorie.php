<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Film;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 */
class Categorie
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @ORM\OneToMany(
     *      targetEntity="Film",
     *      mappedBy="collection",
     *      cascade={"persist", "remove", "merge"},
     *      orphanRemoval=true,
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private $films;

    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    public function addFilm(Film $film)
    {
        if ($this->films === null) {
            $this->films = new ArrayCollection();
        }

        if ($this->films->contains($film) === false) {
            $this->films->add($film);
            $film->setCategorie($this);
        }

        return $this;
    }

    public function removeFilm(Film $film)
    {
        $this->films->removeElement($film);
        $film->setCategorie(null);
        return $this;
    }

    public function getFilms()
    {
        return $this->films;
    }

    // public function __toString()
    // {
    //     return (string)$this->getName();
    // }

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
     * @return Categorie
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
}

