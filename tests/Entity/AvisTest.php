<?php
/**
 * Project: guest-suite-test
 * @author: kris
 * Date: 07/09/2019
 * Time: 16:25
 */

namespace Tests\Entity;

use App\Entity\Auteur;
use App\Entity\Avis;
use App\Entity\Plateforme;
use PHPUnit\Framework\TestCase;

class AvisTest extends TestCase
{
	public function test__construct__AuteurEtPlateformeEtNoteEtCommentairesEtDateCreationPeutEtrePasseEnParametre()
	{
		$auteur_mock = $this->createMock(Auteur::class);
		$plateforme_mock = $this->createMock(Plateforme::class);
		$date_du_jour = new \DateTimeImmutable();

		$avis_stub = new Avis($auteur_mock, $plateforme_mock, 3, 'hello world', $date_du_jour);

		$this->assertInstanceOf(Auteur::class, $avis_stub->getAuteur());
		$this->assertInstanceOf(Plateforme::class, $avis_stub->getPlateforme());
		$this->assertEquals(3, $avis_stub->getNote());
		$this->assertEquals('hello world', $avis_stub->getCommentaire());
		$this->assertEquals($date_du_jour, $avis_stub->getDateDeCreation());
	}

	public function test__construct__AuteurEtPlateformeEtNoteSontObligatoires()
	{
		$auteur_mock = $this->createMock(Auteur::class);
		$plateforme_mock = $this->createMock(Plateforme::class);

		$this->expectException(\ArgumentCountError::class);
		new Avis();

		$this->expectException(\ArgumentCountError::class);
		new Avis($auteur_mock);

		$this->expectException(\ArgumentCountError::class);
		new Avis($auteur_mock, $plateforme_mock);
	}

	public function test__construct__SiNonDefiniDateCreationEstDateDuJourActuel()
	{
		$auteur_mock = $this->createMock(Auteur::class);
		$plateforme_mock = $this->createMock(Plateforme::class);
		$date_du_jour = new \DateTimeImmutable();

		$avis_stub = new Avis($auteur_mock, $plateforme_mock, 3, 'hello world');

		$this->assertInstanceOf(\DateTimeImmutable::class, $avis_stub->getDateDeCreation());
		$this->assertEquals($date_du_jour->format('d-m-y'), $avis_stub->getDateDeCreation()->format('d-m-y'));
	}

	public function testSetNote__UneNoteNonCompriseEntre0Et5DoitEtreAjusteSansGenererErreur()
	{
		$auteur_mock = $this->createMock(Auteur::class);
		$plateforme_mock = $this->createMock(Plateforme::class);

		$avis_stub = new Avis($auteur_mock, $plateforme_mock, -3 );
		$this->assertEquals(0, $avis_stub->getNote());

		$avis_stub->setNote(10);
		$this->assertEquals( 5, $avis_stub->getNote());
	}

	public function testSetCommentaire__DoitToujourEtreDeTypeString()
	{
		$auteur_mock = $this->createMock(Auteur::class);
		$plateforme_mock = $this->createMock(Plateforme::class);

		$avis_stub = new Avis($auteur_mock, $plateforme_mock, 3 );

		$this->assertInternalType('string', $avis_stub->getCommentaire());
		$this->assertEquals('', $avis_stub->getCommentaire());
	}
}
