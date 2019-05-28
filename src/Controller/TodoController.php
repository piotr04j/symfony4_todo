<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\AddTask;
use App\Service\TaskHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class TodoController extends AbstractController
{

    public function index()
    {

        $form = $this->createForm(AddTask::class);
        $tasks= $this->getDoctrine()
            ->getRepository(Task::class)
            ->findAll();

        return $this->render('todo/list.html.twig', [
            'form' => $form->createView(),
            'tasks' => $tasks
        ]);

    }

    public function formHandler (Request $request, TaskHandler $taskHandler)
    {
        $newTask = $request->request->get('task');
        return $taskHandler->addTask($newTask);
    }
}