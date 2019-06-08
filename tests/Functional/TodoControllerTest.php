<?php


namespace App\Tests\Functional;



use App\DataFixtures\TaskFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @property \Symfony\Bundle\FrameworkBundle\Client client
 */
class TodoControllerTest extends WebTestCase
{


    protected function setUp(): void
    {
        $this->client = static::createClient();
        $doctrine= $this->client ->getContainer()->get('doctrine');
        $entityManager = $doctrine->getManager();

        $fixtures = new TaskFixtures();
        $fixtures->load($entityManager);
    }

    protected function tearDown(): void
    {
        $doctrine= $this->client ->getContainer()->get('doctrine');
        $entityManager = $doctrine->getManager();
        $fixtures = new TaskFixtures();
        $fixtures->clearDB($entityManager);
    }

    /**
     * @test
     */
    public function formRenderingTest()
    {

        $crawler = $this->client->request('POST', '/');

        $this->assertSame(200, $this->client->getResponse()->getStatusCode());

//        $this->assertEquals(
//            'To do app!',
//            $crawler->filter('h1')->text()
//        );
//
        $this->assertEquals(
            3,
            $crawler->filter('li')->count()
        );
//
//
//        $form = $crawler->selectButton('Submit')->form();
//        $form['add_task[task]'] = 'sss';
//
//        $crawler = $this->client->submit($form);
//        $crawler = $this->client->followRedirect();
//
//        $this->assertEquals(3, $crawler->filter('li')->count());
//        $this->assertEquals(
//            TaskFixtures::CONTENT_WIP,
//            $crawler->filter('h1')->text()
//        );
//
//        $this->assertEquals(
//            TaskFixtures::CONTENT_DONE,
//            $crawler->filter('h1')->text()
//        );




    }
}