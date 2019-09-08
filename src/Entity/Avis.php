<?php
/**
 * Project: guest-suite-test
 * @author: kris
 * Date: 06/09/2019
 * Time: 11:02
 */
declare( strict_types = 1 );

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvisRepository")
 * @ApiResource
 */
class Avis
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
	 * @var  Auteur $auteur
	 * @ORM\ManyToOne(targetEntity="App\Entity\Auteur", inversedBy="avis")
	 */
	private $auteur;

	/**
	 * @var Plateforme $plateforme
	 * @ORM\ManyToOne(targetEntity="App\Entity\Plateforme", inversedBy="avis")
	 */
	private $plateforme;

	/**
	 * @var int $note - Notée sur 5
	 * @ORM\Column(type="integer")
	 */
	private $note;

	/**
	 * @var string $commentaire
	 * @ORM\Column(type="text")
	 */
	private $commentaire = "";

	/**
	 * @var \DateTimeImmutable $dateDeCreation
	 * @ORM\Column(type="date_immutable")
	 */
	private $dateDeCreation;

	public function __construct(Auteur $auteur, Plateforme $plateforme, int $note, ?string $commentaire = null, ?\DateTimeImmutable $dateDeCreation = null)
	{
		$this->setAuteur($auteur);
		$this->setPlateforme($plateforme);
		$this->setNote($note);
		$this->setCommentaire($commentaire);
		$this->setDateDeCreation( $dateDeCreation ?? new \DateTimeImmutable("now") );
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
	 * @return Auteur
	 */
	public function getAuteur(): Auteur
	{
		return $this->auteur;
	}

	/**
	 * @param Auteur $auteur
	 */
	public function setAuteur( Auteur $auteur ): void
	{
		$this->auteur = $auteur;
	}

	/**
	 * @return Plateforme
	 */
	public function getPlateforme(): Plateforme
	{
		return $this->plateforme;
	}

	/**
	 * @param Plateforme $plateforme
	 */
	public function setPlateforme( Plateforme $plateforme ): void
	{
		$this->plateforme = $plateforme;
	}

	/**
	 * @return int
	 */
	public function getNote(): int
	{
		return $this->note;
	}

	/**
	 * @param int $note
	 */
	public function setNote( int $note ): void
	{
		$note = $note > 5 ? 5 : $note;
		$note = $note < 0 ? 0 : $note;

		$this->note = $note;
	}

	/**
	 * @return string
	 */
	public function getCommentaire(): string
	{
		return $this->commentaire;
	}

	/**
	 * @param string $commentaire
	 */
	public function setCommentaire( ?string $commentaire ): void
	{
		$this->commentaire = $commentaire ?? '';
	}

	/**
	 * @return \DateTimeImmutable
	 */
	public function getDateDeCreation(): \DateTimeImmutable
	{
		return $this->dateDeCreation;
	}

	/**
	 * @param \DateTimeImmutable $dateDeCreation
	 */
	public function setDateDeCreation( \DateTimeImmutable $dateDeCreation ): void
	{
		$this->dateDeCreation = $dateDeCreation;
	}
}