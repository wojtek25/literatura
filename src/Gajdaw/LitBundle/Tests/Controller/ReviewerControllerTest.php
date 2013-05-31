<?php

namespace Gajdaw\LitBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReviewerControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/reviewer/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /position/");


        /*
        $this->assertEquals(1, $crawler->filter('td:contains("Profesor")')->count(), 'Missing element td:contains("Profesor")');
        $this->assertEquals(1, $crawler->filter('td:contains("Asystent")')->count(), 'Missing element td:contains("Asystent")');
        $this->assertEquals(1, $crawler->filter('td:contains("Adiunkt")')->count(), 'Missing element td:contains("Adiunkt")');
    */
        $rekordy = array();
        $crawler = $crawler->filter('table.records_list > tbody > tr > td:nth-child(2)');
        foreach ($crawler as $domElement) {
            $rekordy[] = $domElement->nodeValue;
        }
        $expected = array(
            'Michał',
            'Piotr',
            'Bogdan'


        );
        $this->assertEquals($expected, $rekordy, 'Rekordy: course');


    }


    /*
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/reviewer/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /reviewer/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'gajdaw_litbundle_reviewertype[field_name]'  => 'Test',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Edit')->form(array(
            'gajdaw_litbundle_reviewertype[field_name]'  => 'Foo',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }

    */
}