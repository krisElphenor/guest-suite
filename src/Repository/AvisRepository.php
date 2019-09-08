<?php
/**
 * Project: guest-suite-test
 * @author: kris
 * Date: 06/09/2019
 * Time: 14:07
 */
declare( strict_types = 1 );

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

final class AvisRepository extends EntityRepository
{
	public function getDailyOverviewByPlatform(int $plaftform_id)
	{
		return $this->createQueryBuilder('a')
			->select("a.dateDeCreation, count(a) as nombre_avis, avg(a.note) as note_moyenne")
			->innerJoin('a.plateforme', 'p')
			->where("p.id = :platform_id")
			->groupBy('a.dateDeCreation')
			->setParameter('platform_id', $plaftform_id)
			->getQuery()
			->getResult()
			;
	}
}