<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Serie;

/**
 * SketchRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SketchRepository extends \Doctrine\ORM\EntityRepository
{
	public function findPageFromSerie(Serie $serie, $page)
    {
        $queryBuilder = $this->createQueryBuilder('s')
        ->where("s.serie = :serie")
        ->setParameter("serie", $serie)
        ->andWhere("s.page = :page")
        ->setParameter("page", $page);

        return $queryBuilder->getQuery()->getResult()[0];
    }
}