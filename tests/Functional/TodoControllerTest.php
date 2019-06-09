<?php


namespace App\Tests\Functional;



use App\DataFixtures\TaskFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
    public function pageRenderedCorrectly()
    {

        $crawler = $this->client->request('GET', '/');

        $this->assertSame(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            'To do app!',
            $crawler->filter('h1')->text()
        );

        $this->assertEquals(
            1,
            $crawler->filter('form')->count()
        );
    }

    /**
     * @test
     */
    public function addedTaskProperly()
    {
        $crawler = $this->client->request('GET', '/');
        $form = $crawler
            ->selectButton('Submit')
            ->form([
                'add_task[task]' => 'new task'
            ]);


        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        $this->assertEquals(4, $crawler->filter('li')->count());
        $this->assertEquals(1, $crawler->filterXPath('//li[contains(text(),\'new task\')]')->count());

    }

    /**
     * @test
     */
    public function deleteTasks()
    {
        $crawler = $this->client->request('GET', '/');
        $task = $crawler
            ->filterXPath('//li[contains(text(),\''. TaskFixtures::CONTENT_TODO .'\')]//a[contains(text(),\'DELETE\')]')
            ->link();

        $this->client->click($task);
        $crawler = $this->client->followRedirect();

        $this->assertEquals(2, $crawler->filter('li')->count());
        $this->assertEquals(0, $crawler->filterXPath('//li[contains(text(),\''. TaskFixtures::CONTENT_TODO  .'\')]')->count());

        $task = $crawler
            ->filterXPath('//li[contains(text(),\''. TaskFixtures::CONTENT_WIP .'\')]//a[contains(text(),\'DELETE\')]')
            ->link();

        $this->client->click($task);
        $crawler = $this->client->followRedirect();

        $this->assertEquals(1, $crawler->filter('li')->count());
        $this->assertEquals(0, $crawler->filterXPath('//li[contains(text(),\''. TaskFixtures::CONTENT_WIP  .'\')]')->count());


        $task = $crawler
            ->filterXPath('//li[contains(text(),\''. TaskFixtures::CONTENT_DONE .'\')]//a[contains(text(),\'DELETE\')]')
            ->link();

        $this->client->click($task);
        $crawler = $this->client->followRedirect();

        $this->assertEquals(0, $crawler->filter('li')->count());

    }
}
