<?php

namespace AppBundle\Repository;

/**
 * CollectionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CollectionRepository extends \Doctrine\ORM\EntityRepository
{
	public function findAllQB()
    {
        $queryBuilder = $this->createQueryBuilder('s');
        return $queryBuilder;
    }
}
