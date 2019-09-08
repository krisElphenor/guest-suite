<?php
/**
 * Project: guest-suite-test
 * @author: kris
 * Date: 07/09/2019
 * Time: 16:33
 */

namespace Tests\Entity;

use App\Entity\Avis;
use App\Entity\Plateforme;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class PlateformeTest extends TestCase
{
	public function test__construct__NomEtUrlPasserEnParametre()
	{
		$platforme_stub = new Plateforme('google', 'google.fr');

		$this->assertEquals('google', $platforme_stub->getNom());
		$this->assertEquals('google.fr', $platforme_stub->getUrl());
	}

	public function test__construct__NomEstObligatoireEtUrlEstOptionnel()
	{
		$this->expectException(\ArgumentCountError::class);
		new Plateforme();

		$platforme_stub = new Plateforme('google');

		$this->assertEquals('google', $platforme_stub->getNom());
		$this->assertEquals('', $platforme_stub->getUrl());
	}

	public function testSetUrl__RetourneToujoursUnString()
	{
		$platforme_stub = new Plateforme('google');

		$this->assertEquals('', $platforme_stub->getUrl());

		$platforme_stub->setUrl(null);
		$this->assertInternalType('string', $platforme_stub->getUrl());
		$this->assertEquals('', $platforme_stub->getUrl());
	}

	public function testGetAvis__RetourneToujoursUnTypeCollectionMemeVide()
	{
		$platforme_stub = new Plateforme('google');

		$this->assertInstanceOf(Collection::class, $platforme_stub->getAvis());
		$this->assertCount(0, $platforme_stub->getAvis());
	}

	public function testRemoveAvis__NeGenerePasErreurSiAvisNExistePas()
	{
		$platforme_stub = new Plateforme('google');
		$avis_mock = $this->createMock(Avis::class);
		$avis_mock_2 = $this->createMock(Avis::class);

		$platforme_stub->removeAvis($avis_mock); //on supprime un avis non ajouté à la collection
		$this->assertCount(0, $platforme_stub->getAvis());

		$platforme_stub->addAvis($avis_mock);
		$platforme_stub->removeAvis($avis_mock); //on supprime tout juste apres avoir ajouté
		$this->assertCount(0, $platforme_stub->getAvis());

		$platforme_stub->addAvis($avis_mock_2);
		$platforme_stub->removeAvis($avis_mock); //on supprime un avis autre que celui présent dans la collection
		$this->assertCount(1, $platforme_stub->getAvis());

		$platforme_stub->addAvis($avis_mock);
		$platforme_stub->removeAvis($avis_mock);
		$this->assertCount(1, $platforme_stub->getAvis());
	}

	public function testAddAvis__AjouterUnAvisSIlNExistePasDeja()
	{
		$platforme_stub = new Plateforme('google');
		$avis_mock = $this->createMock(Avis::class);
		$avis_mock_2 = $this->createMock(Avis::class);

		$platforme_stub->addAvis($avis_mock);
		$this->assertCount(1, $platforme_stub->getAvis());

		$platforme_stub->addAvis($avis_mock); //on ajoute un doublon
		$platforme_stub->addAvis($avis_mock_2);
		$this->assertCount(2, $platforme_stub->getAvis());
	}
}
