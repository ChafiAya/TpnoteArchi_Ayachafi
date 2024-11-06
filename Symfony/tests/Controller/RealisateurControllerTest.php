<?php

namespace App\Tests\Controller;

use App\Entity\Realisateur;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class RealisateurControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/realisateur/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Realisateur::class);

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
            'realisateur[id_realisateur]' => 'Testing',
            'realisateur[nom]' => 'Testing',
            'realisateur[prenom]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Realisateur();
        $fixture->setId_realisateur('My Title');
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Realisateur');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Realisateur();
        $fixture->setId_realisateur('Value');
        $fixture->setNom('Value');
        $fixture->setPrenom('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'realisateur[id_realisateur]' => 'Something New',
            'realisateur[nom]' => 'Something New',
            'realisateur[prenom]' => 'Something New',
        ]);

        self::assertResponseRedirects('/realisateur/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getId_realisateur());
        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPrenom());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Realisateur();
        $fixture->setId_realisateur('Value');
        $fixture->setNom('Value');
        $fixture->setPrenom('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/realisateur/');
        self::assertSame(0, $this->repository->count([]));
    }
}
