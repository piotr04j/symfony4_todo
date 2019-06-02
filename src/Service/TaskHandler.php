<?php


namespace App\Service;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TaskHandler extends AbstractController
{

    public function addTask(string $newTask): void
    {
            $task = new Task();
            $task->setContent($newTask);
            $task->setTodo(true);
            $task->setWip(false);
            $task->setDone(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
    }

    public function deleteTask(string $id): void
    {
            $em = $this->getDoctrine()->getManager();
            $task = $em->getRepository(Task::class)
                ->findBy(["id" => $id]);
            $em->remove($task[0]);
            $em->flush();
    }

    public function  moveToWIP(string $id): void
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository(Task::class)
            ->findBy(["id" => $id])[0];
        $newTask = new Task();
        $newTask->setContent($task->getContent());
        $newTask->setTodo(false);
        $newTask->setWip(true);
        $newTask->setDone(false);
        $em->persist($newTask);
        $em->remove($task);
        $em->flush();
    }

    public function moveToTodO(string $id): void
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository(Task::class)
            ->findBy(["id" => $id])[0];
        $newTask = new Task();
        $newTask->setContent($task->getContent());
        $newTask->setTodo(true);
        $newTask->setWip(false);
        $newTask->setDone(false);
        $em->persist($newTask);
        $em->remove($task);
        $em->flush();
    }

    public function moveToTDone(string $id): void
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository(Task::class)
            ->findBy(["id" => $id])[0];
        $newTask = new Task();
        $newTask->setContent($task->getContent());
        $newTask->setTodo(false);
        $newTask->setWip(false);
        $newTask->setDone(true);
        $em->persist($newTask);
        $em->remove($task);
        $em->flush();
    }
}