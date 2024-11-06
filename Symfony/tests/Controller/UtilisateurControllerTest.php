<?php

namespace App\Tests\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class UtilisateurControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/utilisateur/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Utilisateur::class);

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
            'utilisateur[id_utilisateur]' => 'Testing',
            'utilisateur[Nom_utilisateur]' => 'Testing',
            'utilisateur[Prenom_utilisateur]' => 'Testing',
            'utilisateur[email]' => 'Testing',
            'utilisateur[mdp]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Utilisateur();
        $fixture->setId_utilisateur('My Title');
        $fixture->setNom_utilisateur('My Title');
        $fixture->setPrenom_utilisateur('My Title');
        $fixture->setEmail('My Title');
        $fixture->setMdp('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Utilisateur');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Utilisateur();
        $fixture->setId_utilisateur('Value');
        $fixture->setNom_utilisateur('Value');
        $fixture->setPrenom_utilisateur('Value');
        $fixture->setEmail('Value');
        $fixture->setMdp('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'utilisateur[id_utilisateur]' => 'Something New',
            'utilisateur[Nom_utilisateur]' => 'Something New',
            'utilisateur[Prenom_utilisateur]' => 'Something New',
            'utilisateur[email]' => 'Something New',
            'utilisateur[mdp]' => 'Something New',
        ]);

        self::assertResponseRedirects('/utilisateur/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getId_utilisateur());
        self::assertSame('Something New', $fixture[0]->getNom_utilisateur());
        self::assertSame('Something New', $fixture[0]->getPrenom_utilisateur());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getMdp());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Utilisateur();
        $fixture->setId_utilisateur('Value');
        $fixture->setNom_utilisateur('Value');
        $fixture->setPrenom_utilisateur('Value');
        $fixture->setEmail('Value');
        $fixture->setMdp('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/utilisateur/');
        self::assertSame(0, $this->repository->count([]));
    }
}
