<?php


namespace App\Tests\Functional;



use App\DataFixtures\TaskFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @property \Symfony\Bundle\FrameworkBundle\Client client
 */
class TodoControllerTest extends WebTestCase
{

    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();

        $this->entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');

        $this->entityManager->beginTransaction();
        $this->entityManager->getConnection()->setAutoCommit(false);
    }

    protected function tearDown(): void
    {
        $this->entityManager->rollBack();
        $this->entityManager->close();
        $this->entityManager = null;
    }

    /**
     * @test
     */
    public function formRenderingTest()
    {

        $crawler = $this->client->request('POST', '/');

        $this->assertSame(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            'To do app!',
            $crawler->filter('h1')->text()
        );

        $this->assertEquals(
            0,
            $crawler->filter('li')->count()
        );


        $form = $crawler->selectButton('Submit')->form();
        $form['add_task[task]'] = 'sss';

        $crawler = $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        $this->assertEquals(3, $crawler->filter('li')->count());
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