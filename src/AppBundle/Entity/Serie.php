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
    private $name;

     /**
     * @ORM\OneToMany(
     *      targetEntity="Sketch",
     *      mappedBy="collection",
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
            $sketch->setCollection($this);
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
     * Set name
     *
     * @param string $name
     *
     * @return Serie
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

