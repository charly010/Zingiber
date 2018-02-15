<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Categorie;
use Doctrine\ORM\Mapping as ORM;

/**
 * Film
 */
class Film
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
     * @var string
     */
    private $description;

         /**
     * @ORM\ManyToOne(
     *    targetEntity="Categorie",
     *    inversedBy="films",
     *    fetch="EAGER"
     * )
     * @ORM\JoinColumn(
     *    referencedColumnName="id",
     *    onDelete="CASCADE",
     *    nullable=false
     * )
     */
    private $categorie;

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie(Categorie $categorie = null)
    {
        $this->categorie = $categorie;
        if ($categorie !== null) {
            $categorie->addFilm($this);
        }
        return $this;
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
     * @return Film
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
     * @return Film
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
}
