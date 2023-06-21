<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Etablissement;

class EtablissementsTests extends WebTestCase
{
    public function testListEtablissementsAxios()
    {
        $client = static::createClient();

        $etablissement = new Etablissement();
        $etablissement->setNom('Établissement de test');
        $etablissement->setVille('Ville de test');
        $etablissement->setAdresse('Adresse de test');
        $etablissement->setCodePostal('test');

        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $entityManager->persist($etablissement);
        $entityManager->flush();

        $client->request('GET', '/api/liste-etablissements-axios');
        $response = $client->getResponse();

        $this->assertTrue($response->isSuccessful());

        $responseData = json_decode($response->getContent(), true);

        $this->assertIsArray($responseData);

        foreach ($responseData as $etablissementData) {
            $this->assertArrayHasKey('id', $etablissementData);
            $this->assertArrayHasKey('nom', $etablissementData);
            $this->assertArrayHasKey('ville', $etablissementData);
            $this->assertArrayHasKey('adresse', $etablissementData);
            $this->assertArrayHasKey('code_postal', $etablissementData);
            $this->assertArrayHasKey('description', $etablissementData);
            $this->assertArrayHasKey('titre', $etablissementData);
            $this->assertArrayHasKey('image', $etablissementData);
        }

        // Supprimer l'établissement de test
        $entityManager->remove($etablissement);
        $entityManager->flush();

    }

    public function testGetNonExistentEtablissement()
    {
        // Test si un établissement n'existe pas
        $client = static::createClient();

        $client->request('GET', '/etablissement-axios/0');

        $response = $client->getResponse();

        $this->assertEquals(404, $response->getStatusCode());

        $responseData = json_decode($response->getContent(), true);

        $this->assertIsArray($responseData);

        $this->assertArrayHasKey('error', $responseData);

        $this->assertEquals('Etablissement non trouvé', $responseData['error']);
    }

    public function testGetExistentEtablissement() {
        $client = static::createClient();

        $etablissement = new Etablissement();
        $etablissement->setNom('Établissement de test');
        $etablissement->setVille('Ville de test');
        $etablissement->setAdresse('Adresse de test');
        $etablissement->setCodePostal('test');

        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $entityManager->persist($etablissement);
        $entityManager->flush();

        $client->request('GET', '/etablissement-axios/' . $etablissement->getId());
        $response = $client->getResponse();

        $this->assertTrue($response->isSuccessful());

        $responseData = json_decode($response->getContent(), true);

        $this->assertIsArray($responseData);

        $this->assertArrayHasKey('id', $responseData);

        $this->assertEquals($etablissement->getId(), $responseData['id']);

        // Supprimer l'établissement de test
        $entityManager->remove($etablissement);
        $entityManager->flush();
    }

}


?>