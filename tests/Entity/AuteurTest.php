<?php
/**
 * Project: guest-suite-test
 * @author: kris
 * Date: 07/09/2019
 * Time: 16:16
 */

namespace Tests\Entity;

use App\Entity\Auteur;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class AuteurTest extends TestCase
{
	public function test__construct__NomEtEmailPeuventEtrePasserEnParametre()
	{
		$auteur_stub = new Auteur('Paul', 'paul@example.fr');

		$this->assertEquals('Paul', $auteur_stub->getNom() );
		$this->assertEquals('paul@example.fr', $auteur_stub->getEmail());
	}

	public function test__construct__NomEstObligatoireMaisEmailEstOptionnel()
	{
		$auteur_stub = new Auteur('Paul', null);

		$this->assertEquals('Paul', $auteur_stub->getNom() );
		$this->assertNull($auteur_stub->getEmail());

		$this->expectException(\Exception::class);
		new Auteur('', null);
	}

	public function testSetNom__UnNomNePeutPasEtreVide()
	{
		$auteur_stub = new Auteur('Paul', null);

		$this->expectException(\Exception::class);
		$auteur_stub->setNom('');
	}

	public function testGetAvis__DoitToujoursRenvoyerUnObjetDeTypeCollection()
	{
		$auteur_stub = new Auteur('Paul');
		$this->assertInstanceOf(Collection::class, $auteur_stub->getAvis());
	}

	public function testSetEmail__PeutRenvoyerStringOuNull()
	{
		$auteur_stub = new Auteur('Paul');

		$this->assertNull( $auteur_stub->getEmail() );

		$auteur_stub->setEmail('paul@example.com');

		$this->assertEquals('paul@example.com', $auteur_stub->getEmail());
	}
}
