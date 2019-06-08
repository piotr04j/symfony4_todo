<?php


namespace App\Tests;


use App\Controller\TodoController;
use PHPUnit\Framework\TestCase;


class TodoTest extends TestCase
{
    /**
     * @test
     */
    public function indexTest()
    {
        $instanceTodo = new TodoController();

        $this->assertInstanceOf(TodoController::class,$instanceTodo);
    }
}