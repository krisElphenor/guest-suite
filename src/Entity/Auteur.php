<?php
/**
 * Project: guest-suite-test
 * @author: kris
 * Date: 06/09/2019
 * Time: 10:59
 */
declare( strict_types = 1 );

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuteurRepository")
 * @ApiResource()
 */
class Auteur
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
	 * @var string $email
	 * @ORM\Column(type="string", length=255)
	 */
	private $email;

	/**
	 * @var ArrayCollection|Avis[] $avis - Liste des avis laissés par cet auteur, toute plateforme confondues
	 * @ORM\OneToMany(targetEntity="App\Entity\Avis", mappedBy="auteur")
	 */
	private $avis;

	public function __construct(string $nom, ?string $email = null)
	{
		$this->avis = new ArrayCollection();
		$this->setNom($nom);
		$this->setEmail($email);
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
		if( trim($nom) == '' )
			throw new \Exception("L'argument 'nom' ne peut pas etre vide");

		$this->nom = $nom;
	}

	/**
	 * @return string
	 */
	public function getEmail(): ?string
	{
		return $this->email;
	}

	/**
	 * @param string|null $email
	 */
	public function setEmail( ?string $email ): void
	{
		$this->email = $email;
	}

	/**
	 * @return Avis[]|Collection
	 */
	public function getAvis(): Collection
	{
		return $this->avis;
	}
}