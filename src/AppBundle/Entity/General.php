<?php

namespace AppBundle\Entity;

/**
 * General
 */
class General
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $nbFilms = 0;


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
     * Set nbFilms
     *
     * @param integer $nbFilms
     *
     * @return General
     */
    public function setNbFilms($nbFilms)
    {
        $this->nbFilms = $nbFilms;

        return $this;
    }

    /**
     * Get nbFilms
     *
     * @return int
     */
    public function getNbFilms()
    {
        return $this->nbFilms;
    }
}

