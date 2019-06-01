<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\AddTask;
use App\Service\TaskHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TodoController extends AbstractController
{

    public function index(Request $request, TaskHandler $taskHandler)
    {

        $form = $this->createForm(AddTask::class);
        $tasks= $this->getDoctrine()
            ->getRepository(Task::class)
            ->findAll();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $newTask = $request->request->get($form->getName())['task'];
            $taskHandler->addTask($newTask);
            return $this->redirectToRoute('index');
        }

        return $this->render('todo/list.html.twig', [
            'form' => $form->createView(),
            'tasks' => $tasks
        ]);

    }

    public function formHandler (Request $request )
    {


    }

    public function deleteTask (Request $request, TaskHandler $taskHandler)
    {
        $id =$request->query->get('id');
        $taskHandler->deleteTask($id);
        return $this->redirectToRoute('index');
    }
}