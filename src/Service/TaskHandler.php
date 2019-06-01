<?php


namespace App\Service;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TaskHandler extends AbstractController
{

    public function addTask(string $newTask)
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

    public function deleteTask(string $id)
    {
            $em = $this->getDoctrine()->getManager();
            $task = $em->getRepository(Task::class)
                ->findBy(["id" => $id]);
            $em->remove($task[0]);
            $em->flush();
    }
}