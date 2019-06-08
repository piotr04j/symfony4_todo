<?php


namespace App\Tests\Functional;



use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TodoControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function formRenderingTest()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertEquals('To do app!', $crawler->filter('h1')->text());

    }
}