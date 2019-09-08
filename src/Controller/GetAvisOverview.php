<?php
/**
 * Project: guest-suite-test
 * @author: kris
 * Date: 06/09/2019
 * Time: 15:15
 */
declare( strict_types = 1 );

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Plateforme;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;

final class GetAvisOverview
{
	/**
	 * @var AvisRepository $avis_repository
	 */
	private $avis_repository;

	public function __construct(EntityManagerInterface $entity_manager)
	{
		$this->avis_repository = $entity_manager->getRepository(Avis::class);
	}

	public function __invoke(Plateforme $data)
	{
		return $this->avis_repository->getDailyOverviewByPlatform($data->getId());
	}
}