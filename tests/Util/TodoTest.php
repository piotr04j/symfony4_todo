<?php


namespace App\Tests;


use App\Controller\TodoController;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class TodoTest extends WebTestCase
{
    /**
     * @test
     */
    public function createFormTest()
    {
        $instanceTodo = new TodoController();

        $this->assertInstanceOf(TodoController::class,$instanceTodo);
    }
}