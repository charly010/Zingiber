<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Serie;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Sketch
 *
 * @ORM\Table(name="sketch")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SketchRepository")
 */
class Sketch
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
     * @var integer
     */
    private $page;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @var File
     */
    private $imageFile;

     /**
     * @ORM\ManyToOne(
     *    targetEntity="Serie",
     *    inversedBy="sketchs",
     *    fetch="EAGER"
     * )
     * @ORM\JoinColumn(
     *    referencedColumnName="id",
     *    onDelete="CASCADE",
     *    nullable=false
     * )
     */
    private $serie;

    public function getSerie()
    {
        return $this->serie;
    }

    public function setSerie(Serie $serie = null)
    {
        $this->serie = $serie;
        if ($serie !== null) {
            $serie->addSketch($this);
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
     * @return Image
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
     * Set page
     *
     * @param integer $page
     *
     * @return Image
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return integer
     */
    public function getPage()
    {
        return $this->page;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }
}

