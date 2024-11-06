<?php

namespace App\Tests\Controller;

use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FilmControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/film/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Film::class);

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
            'film[id_film]' => 'Testing',
            'film[titre]' => 'Testing',
            'film[duree]' => 'Testing',
            'film[annee_sortie]' => 'Testing',
            'film[id_realisateur]' => 'Testing',
            'film[utilisateur]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Film();
        $fixture->setId_film('My Title');
        $fixture->setTitre('My Title');
        $fixture->setDuree('My Title');
        $fixture->setAnnee_sortie('My Title');
        $fixture->setId_realisateur('My Title');
        $fixture->setUtilisateur('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Film');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Film();
        $fixture->setId_film('Value');
        $fixture->setTitre('Value');
        $fixture->setDuree('Value');
        $fixture->setAnnee_sortie('Value');
        $fixture->setId_realisateur('Value');
        $fixture->setUtilisateur('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'film[id_film]' => 'Something New',
            'film[titre]' => 'Something New',
            'film[duree]' => 'Something New',
            'film[annee_sortie]' => 'Something New',
            'film[id_realisateur]' => 'Something New',
            'film[utilisateur]' => 'Something New',
        ]);

        self::assertResponseRedirects('/film/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getId_film());
        self::assertSame('Something New', $fixture[0]->getTitre());
        self::assertSame('Something New', $fixture[0]->getDuree());
        self::assertSame('Something New', $fixture[0]->getAnnee_sortie());
        self::assertSame('Something New', $fixture[0]->getId_realisateur());
        self::assertSame('Something New', $fixture[0]->getUtilisateur());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Film();
        $fixture->setId_film('Value');
        $fixture->setTitre('Value');
        $fixture->setDuree('Value');
        $fixture->setAnnee_sortie('Value');
        $fixture->setId_realisateur('Value');
        $fixture->setUtilisateur('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/film/');
        self::assertSame(0, $this->repository->count([]));
    }
}
