<?php
namespace AppBundle\Service;

use AppBundle\Entity\Film;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManager;

/**
 * Class FilmListener
 */
class FilmCount
{
    private $em;
    private $container;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function count(Film $film, $add)
    {
        dump($film);
        dump($add); // = bool    

 
        $em    = $args->getObjectManager();
        $general = $em->getRepository('AppBundle:general')->findAll()[0];
        dump($general);
        $general->setNbFilms($general->getNbFilms + 1);
        dump($general);
        die();
        $em->flush();
        
    }
    // todo ajouter un PostDelete qui decremente
}
