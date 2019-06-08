<?php


namespace App\DataFixtures;


use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TaskFixtures extends Fixture
{
    const CONTENT_TODO = 'example task which you should do';
    const CONTENT_WIP = 'example task is being worked';
    const CONTENT_DONE = 'example task done';

    public function load(ObjectManager $manager)
    {
        $taskTodo = new Task();
        $taskTodo->setContent(Self::CONTENT_TODO);
        $taskTodo->setTodo(true);
        $taskTodo->setWip(false);
        $taskTodo->setDone(false);
        $manager->persist($taskTodo);

        $taskWorkInProgress = new Task();
        $taskWorkInProgress->setContent(Self::CONTENT_WIP);
        $taskWorkInProgress->setTodo(false);
        $taskWorkInProgress->setWip(true);
        $taskWorkInProgress->setDone(false);
        $manager->persist($taskWorkInProgress);

        $taskDone = new Task();
        $taskDone->setContent(Self::CONTENT_DONE);
        $taskDone->setTodo(false);
        $taskDone->setWip(false);
        $taskDone->setDone(true);
        $manager->persist($taskDone);

        $manager->flush();
    }
}