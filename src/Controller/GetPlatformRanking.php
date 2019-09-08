<?php
/**
 * Project: guest-suite-test
 * @author: kris
 * Date: 06/09/2019
 * Time: 15:15
 */
declare( strict_types = 1 );

namespace App\Controller;

use App\Entity\Plateforme;
use App\Repository\PlateformeRepository;
use Doctrine\ORM\EntityManagerInterface;

final class GetPlatformRanking
{
	/**
	 * @var PlateformeRepository $plateforme_repository
	 */
	private $plateforme_repository;

	public function __construct(EntityManagerInterface $entity_manager)
	{
		$this->plateforme_repository = $entity_manager->getRepository(Plateforme::class);
	}

	public function __invoke()
	{
		return $this->plateforme_repository->getPlatformRanking();
	}
}