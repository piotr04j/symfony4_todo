<?php


namespace App\Service;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


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
            $response = new Response();
            $response->setContent('dodano: '.$newTask);
            $response->setStatusCode(Response::HTTP_OK);
            $response->headers->set('Content-Type', 'text/plain');
            return $response;
    }
}