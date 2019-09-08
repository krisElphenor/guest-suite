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

final class PlateformeRepository extends EntityRepository
{
	public function getPlatformRanking()
	{
		return $this->createQueryBuilder('p')
			->select("p.nom, count(a) as nombre_avis, avg(a.note) as note_globale")
			->innerJoin('p.avis', 'a')
			->groupBy('p.id')
			->addOrderBy('note_globale', 'DESC')
			->addOrderBy('nombre_avis', 'DESC')
			->getQuery()
			->getResult()
		;
	}
}