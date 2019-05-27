<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\AddTask;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TodoController extends AbstractController
{
    public function index(Request $request)
    {



        $form = $this->createForm(AddTask::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $userData = $form->getData();
            $task = new Task();
            $task->setContent($userData['task']);
            $task->setTodo(true);
            $task->setWip(false);
            $task->setDone(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
        }

        $tasks= $this->getDoctrine()
            ->getRepository(Task::class)
            ->findAll();

        return $this->render('todo/list.html.twig', [
            'form' => $form->createView(),
            'tasks' => $tasks
        ]);

    }
}