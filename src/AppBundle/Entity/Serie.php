<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Sketch;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Serie
 *
 * @ORM\Table(name="serie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SerieRepository")
 */
class Serie
{
    public function __construct()
    {
        $this->sketchs = new ArrayCollection();
    }

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
     *      targetEntity="Sketch",
     *      mappedBy="serie",
     *      cascade={"persist", "remove", "merge"},
     *      orphanRemoval=true,
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private $sketchs;

    public function addSketch(Sketch $sketch)
    {
        if ($this->sketchs->contains($sketch) === false) {
            $this->sketchs->add($sketch);
            $sketch->setSerie($this);
        }

        return $this;
    }

    public function removeSketch(Sketch $sketch)
    {
        $this->sketchs->removeElement($sketch);
        $sketch->setCollection(null);
        return $this;
    }

    public function getSketchs()
    {
        return $this->sketchs;
    }

    public function __toString()
    {
        return (string)$this->getName();
    }

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
     * @return Serie
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

