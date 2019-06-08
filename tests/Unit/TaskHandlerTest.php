<?php


namespace App\Tests\Unit;


use App\Service\TaskHandler;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\app\AppKernel;
use PHPUnit\Framework\TestCase;



class TaskHandlerTest extends TestCase
{

    /**
     * @test
     */
    public function addTaskTest()
    {

        $taskHandler = new TaskHandler();
        $kernel = new AppKernel;
        $kernel->boot();
        $container = $kernel->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $em->expects($this->once())
            ->method('persist');

        $val = $taskHandler->addTask('test');

        $this->assertEquals('test', $val->getContent());

    }
}