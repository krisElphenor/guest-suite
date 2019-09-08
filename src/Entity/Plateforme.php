<?php
/**
 * Project: guest-suite-test
 * @author: kris
 * Date: 06/09/2019
 * Time: 11:01
 */
declare( strict_types = 1 );

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use App\Controller\GetPlatformRanking;
use App\Controller\GetAvisOverview;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlateformeRepository")
 * @ApiResource(collectionOperations={
 *     "get",
 *     "post",
 *     "get_ranking"={
 *         "method"="GET",
 *         "path"="/plateformes/ranking",
 *         "controller"=GetPlatformRanking::class,
 *     }
 * }, itemOperations={
 *     "get",
 *     "put",
 *     "delete",
 *     "get_avis_overview"={
 *         "method"="GET",
 *         "path"="/plateformes/{id}/avis-overview",
 *         "controller"=GetAvisOverview::class
 *     }
 * })
 */
class Plateforme
{
	/**
	 * @var int $id
	 *
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @var string $nom
	 * @ORM\Column(type="string", length=255)
	 */
	private $nom;

	/**
	 * @var string $url
	 * @ORM\Column(type="string", length=255)
	 */
	private $url = "";

	/**
	 * @var ArrayCollection|Avis[] $avis - Liste des avis laissés pour cette plateforme, tout auteur confondus
	 * @ORM\OneToMany(targetEntity="App\Entity\Avis", mappedBy="plateforme")
	 */
	private $avis;

	public function __construct(string $nom, ?string $url = null)
	{
		$this->setNom($nom);
		$this->setUrl($url);
		$this->avis = new ArrayCollection();
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId( int $id ): void
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getNom(): string
	{
		return $this->nom;
	}

	/**
	 * @param string $nom
	 */
	public function setNom( string $nom ): void
	{
		$this->nom = $nom;
	}

	/**
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}

	/**
	 * @param string $url
	 */
	public function setUrl( ?string $url ): void
	{
		$this->url = $url ?? '';
	}

	/**
	 * @return Avis[]|Collection
	 */
	public function getAvis(): Collection
	{
		return $this->avis;
	}

	/**
	 * @param Avis[]|Collection $avis
	 */
	public function setAvis( Collection $avis ): void
	{
		$this->avis = $avis;
	}

	/**
	 * @param Avis $avis
	 */
	public function addAvis( Avis $avis): void
	{
		if( !$this->avis->contains($avis) )
			$this->avis->add( $avis );
	}

	/**
	 * @param Avis $avis
	 */
	public function removeAvis( Avis $avis ): void
	{
		$this->avis->removeElement( $avis );
	}
}