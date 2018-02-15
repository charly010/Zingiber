<?php
namespace AppBundle\Listener;

use AppBundle\Entity\Film;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class FilmListener
 */
class FilmListener
{
    public function postPersist(LifecycleEventArgs $args)
    {
        /** @var Film $film */
        $film = $args->getObject();

        if ($film instanceof Film) {
            $em  = $args->getObjectManager();
            $general = $em->getRepository('AppBundle:general')->findAll()[0];
            dump($general);
            $general->setNbFilms($general->getNbFilms + 1);
            dump($general);
            die();
            $em->flush();
        }
    }
    // todo ajouter un PostDelete qui decremente
}
