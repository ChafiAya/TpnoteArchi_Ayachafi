<?php

namespace App\Tests\Controller;

use App\Entity\Acteur;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ActeurControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/acteur/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Acteur::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

  

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'acteur[id_acteur]' => 'Testing',
            'acteur[Nom]' => 'Testing',
            'acteur[Prenom]' => 'Testing',
            'acteur[roleA]' => 'Testing',
            'acteur[datenaissance]' => 'Testing',
            'acteur[id_film]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Acteur();
        $fixture->setId_acteur('My Title');
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setRoleA('My Title');
        $fixture->setDatenaissance('My Title');
        $fixture->setId_film('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Acteur');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Acteur();
        $fixture->setId_acteur('Value');
        $fixture->setNom('Value');
        $fixture->setPrenom('Value');
        $fixture->setRoleA('Value');
        $fixture->setDatenaissance('Value');
        $fixture->setId_film('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'acteur[id_acteur]' => 'Something New',
            'acteur[Nom]' => 'Something New',
            'acteur[Prenom]' => 'Something New',
            'acteur[roleA]' => 'Something New',
            'acteur[datenaissance]' => 'Something New',
            'acteur[id_film]' => 'Something New',
        ]);

        self::assertResponseRedirects('/acteur/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getId_acteur());
        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getRoleA());
        self::assertSame('Something New', $fixture[0]->getDatenaissance());
        self::assertSame('Something New', $fixture[0]->getId_film());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Acteur();
        $fixture->setId_acteur('Value');
        $fixture->setNom('Value');
        $fixture->setPrenom('Value');
        $fixture->setRoleA('Value');
        $fixture->setDatenaissance('Value');
        $fixture->setId_film('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/acteur/');
        self::assertSame(0, $this->repository->count([]));
    }
}
