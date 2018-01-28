<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Sketch
 *
 * @ORM\Table(name="sktech")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SketchRepository")
 * @Vich\Uploadable
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
    private $name;

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
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

     /**
     * @ORM\ManyToOne(
     *    targetEntity="Collection",
     *    inversedBy="sketchs",
     *    fetch="EAGER"
     * )
     * @ORM\JoinColumn(
     *    referencedColumnName="id",
     *    onDelete="CASCADE",
     *    nullable=false
     * )
     */
    private $collection;

    public function getCollection()
    {
        return $this->collection;
    }

    public function setCollection(Collection $collection = null)
    {
        $this->collection = $collection;
        if ($collection !== null) {
            $collection->addSketch($this);
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
     * Set name
     *
     * @param string $name
     *
     * @return Image
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

